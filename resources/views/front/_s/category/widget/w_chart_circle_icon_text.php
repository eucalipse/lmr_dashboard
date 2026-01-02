<?php $lng = request()->get('lang', 'ua'); ?>
<a href="<?php print $url; ?>">
<div class="column-holder">
	<?php require 'w_chart_line_bar.php'; ?>
	<article class="col-sm-8 col-md-8 col-lg-8 content-text inline">
		<?php print ($lng == 'en' && $item->p_text_en) ? $item->p_text_en : $item->p_text; ?>
	</article>
</div>
</a>

<script>
	var opts = { lines: 50, angle: 0.02, lineWidth: 0.12, pointer: {length: 0.9, strokeWidth: 0.035, color: '#e3e3e3' }, limitMax: 'false', colorStart: '#ffcc00',colorStop: '#ffcc00', strokeColor: '#e3e3e3', generateGradient: false};
    var target = document.getElementById('diagram_<?php print $item->id; ?>'); 
    var gauge = new Donut(target).setOptions(opts); 
	gauge.maxValue = 5; 	
	gauge.set(<?php print $item->_value; ?>);
</script>						
