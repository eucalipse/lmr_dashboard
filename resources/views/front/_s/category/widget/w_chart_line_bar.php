<a href="<?php print $url; ?>">
    <div class="col-sm-6 col-md-4 col-lg-4 inline inline2">
        <div class="widget-first WD">
            <strong class="title"><?php print $item->title; ?></strong>
            <div class="widgetContent lineBar">
                <strong class="number number_widget"><?php print $item->_value; ?></strong>
                <div class="progressLine">
                    <?php
                        $w=($item->_value*100/5)
                    ?>
                    <div class="bgGradient" style="width: <?php print $w; ?>%!important">
                    </div>
                    <span class="progress-line"></span>
                    <span class="progress-line"></span>
                    <span class="progress-line"></span>
                    <span class="progress-line"></span>
                    <span class="progress-line"></span>
                </div>
            </div>
            <br/>
            <div class="decorLine"></div>
            <div class="widgetBottom">
                <span class="info-text-year"><?php if (isset($item->_year)) print ' '.$item->_year; ?> <?php print \App\Http\Controllers\Index::getContent('stat_label_6'); ?></span>
                <div class="btn_widget"><?php print \App\Http\Controllers\Index::getContent('stat_label_5'); ?></div>
            </div>
        </div>
    </div>
</a>
