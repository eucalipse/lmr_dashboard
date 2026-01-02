<a href="<?php print $url; ?>">
<div class="col-sm-6 col-md-4 col-lg-4 inline inline1">
	<div class="widget-first WD">
            <strong class="title"><?php print $item->title; ?></strong>
        <div class="widgetContent">
            <strong class="number number_widget">
                <?php print $item->_value; ?>
            </strong><span class="info-text"><?php print $item->measurement; ?></span>
        </div>
       <br/>
        <div class="decorLine"></div>
        <div class="widgetBottom">
            <span class="info-text">
                <span class="info-text-year"><?php if (isset($item->_year)) print ' '.$item->_year; ?></span>
                <span class="info-text-yearLabel"><?php print \App\Http\Controllers\Index::getContent('stat_label_6'); ?></span>
            </span>
            <div class="btn_widget"><?php print \App\Http\Controllers\Index::getContent('stat_label_5'); ?></div>
        </div>
	</div>
</div>
</a>
