<a href="<?php print $url; ?>">
<div class="col-xs-12 col-md-6 col-lg-4 inline1">
		<div class="widget-fourth WD">
			<strong class="title same-height-left">
				<?php print $item->title; ?>
			</strong>
            <div class="widgetContent row">
				<div class="col-xs-6">
					<strong class="number number_widget ">	<?php print $item->_value; ?></strong><span class="info-text"><?php print $item->measurement; ?></span>
				</div>
				<div class="col-xs-6">
					<strong class="number number_widget "><?php print $item->_value_plan; ?></strong><span class="info-text"><?php print $item->measurement; ?></span>
				</div>
			</div>
            <br/>
            <div class="decorLine"></div>
            <div class="widgetBottom">
                <span class="info-text-year"><?php if (isset($item->year)) print ' '.$item->year; ?> <?php print \App\Http\Controllers\Index::getContent('stat_label_6'); ?></span>
                <div class="btn_widget"><?php print \App\Http\Controllers\Index::getContent('stat_label_5'); ?></div>
            </div>
		</div>
	</div>
</a>	
