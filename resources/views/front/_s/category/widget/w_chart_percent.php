
<a href="<?php print $url; ?>">
  <div class="col-sm-6 col-md-4 col-lg-4 inline inline2 ">
		<div class="widget-third inline col WD">
            <strong class="title same-height-left"><?php print $item->title; ?></strong>
            <div class="widgetContent circleWidget">
               <div>
                   <canvas id='<?php print $item->id; ?>'  width="150" height="150"></canvas>
                   <span class="velueCircle"><?php print $item->_value; ?>%</span>
               </div>
            </div>
            <br>
            <div class="decorLine"></div>
            <div class="widgetBottom">
                <span class="info-text-year"><?php if (isset($item->_year)) print ' '.$item->_year ?> <?php print \App\Http\Controllers\Index::getContent('stat_label_6'); ?></span>
                <div class="btn_widget"><?php print \App\Http\Controllers\Index::getContent('stat_label_5'); ?></div>
            </div>
	    </div>
	</div>
</a>

<?php

if ($item->_value>=100){
    $donatValue=100;
} else {
    $donatValue=(100-$item->_value);
}

$gradient1='"#b662df"';
$gradient2='"#e0454f"';

if ($p->mainCategory==1){
    $gradient1='"#12c2e9"';
    $gradient2='"#8f79e1"';
    $gradient3='"#b662df"';
}

if ($p->mainCategory==2){
    $gradient1='"#b662df"';
    $gradient2='"#d15085"';
    $gradient3='"#e0454f"';
}

if ($p->mainCategory==3){
    $gradient1='"#e0454f"';
    $gradient2='"#7089a3"';
    $gradient3='"#12c2e9"';
}

if ($p->mainCategory==4){
    $gradient1='"#76DC7A"';
    $gradient2='"#67d0a8"';
    $gradient3='"#5dc5ce"';
}

?>

<script>
    var ctx = document.getElementById(<?php print $item->id; ?>).getContext('2d');
    var cl= (<?php print $donatValue; ?>);

    var gradientStroke = ctx.createLinearGradient(150, 0, 0, 100);
    gradientStroke.addColorStop(0,<?php print $gradient1; ?>);
    gradientStroke.addColorStop(0.5,<?php print $gradient2; ?>);
    gradientStroke.addColorStop(1,<?php print $gradient3; ?>);

    var chart = new Chart(ctx, {
        type: 'doughnut',

        data: {
            labels: ["1", "2"],
            datasets: [{
                backgroundColor: [gradientStroke,"#e3e6e9"],
                // hoverBackgroundColor: gradientStroke ,
                borderColor: '#e3e6e9',
                borderWidth:[0 ,0],
                hoverBorderWidth:[0 ,0],

                <?php
                    if ($donatValue==100) print 'data: [100]'; else print 'data: ['.$item->_value.','.$donatValue.']'
                ?>


            }]
        },


        options: {
            tooltips:false,
            legend: {
                display: false,
            },
            cutoutPercentage:70
        }
    });

</script>