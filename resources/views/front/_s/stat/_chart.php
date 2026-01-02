


<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    
    var gradientStroke = ctx.createLinearGradient(0, 0, 0, 400);
    gradientStroke.addColorStop(0,<?php print $gradient1; ?>);
    gradientStroke.addColorStop(0.5,<?php print $gradient2; ?>);
    gradientStroke.addColorStop(1,<?php print $gradient3; ?>);

    var barColor = ctx.createLinearGradient(0, 0, 0, 500);
        barColor.addColorStop(0, <?php print $gradient2; ?>);
        barColor.addColorStop(1, <?php print $gradient1; ?>);

    var myChart = new Chart(ctx, {
            "type": "<?php print $chartType; ?>",
            "data": {
                "labels": [<?php print $years; ?>],
                "datasets": [
                    {
                        "label": "",
                        "data": [<?php print $datas; ?>],
                        "borderColor": <?php print ($chartType=='bar')?'"rgba(255,255,255,0.0)"':'gradientStroke'; ?>,
                        "pointBorderColor": gradientStroke,
                        "pointBackgroundColor": gradientStroke,
                        "pointHoverBackgroundColor": gradientStroke,
                        "pointHoverBorderColor": gradientStroke,
                        "pointBorderWidth": 10,
                        "pointHoverRadius": 10,
                        "pointHoverBorderWidth": 1,
                        "pointRadius": 3,
                        "borderWidth": 4,
                        "fillColor": "#b662df",
                        "strokeColor": "#b662df",
                        "fillColor": gradientStroke,
                       <?php print ($chartType=='bar')?'
                        "fill": true,
                        "backgroundColor":['.$barColors.']'
                        :
                        '"fill": false';
                       ?>
                    }
                ]
            },
            "options": {
                responsive: true,
                showTooltips: true,
                showAllTooltips: false,
                animation: {
                    onProgress: function (e) {
                        var ctx = this.chart.ctx;
                        <?php if ($p->mainCategory==4) {?>
                            var canvasHeight = ctx.canvas.clientHeight;
                            var canvasWidth = ctx.canvas.clientWidth;
                            var barAmount=<?php print $barAmount+1; ?>;
                            var objectHeight=<?php print $isArrow?140:80; ?>;
                            var objectTop=canvasHeight/2-objectHeight/2;     
                            var barWidth=(canvasWidth/barAmount);
                            var objectLeft=canvasWidth-barWidth+(barWidth/2-40);

                            var img = new Image;
                            img.src = "<?php print $imgSrc; ?>";
                            ctx.drawImage(img,  objectLeft, objectTop, 80, objectHeight);

                            <?php if (isset($value_number)) {?>
                                // ctx.fillText("<?php print $value_number; ?>", objectLeft+40, objectTop+140);
                            <?php } ?>

                        <?php } ?>            

                        ctx.textAlign = "center";
                        ctx.textBaseline = "top";
                        ctx.font = '14px fira_sans_bold';
                        ctx.fillStyle = <?php print $gradient1; ?>;
                        const meta = this.chart.getDatasetMeta(0)
                        const dataSet = this.chart.config.data.datasets[0].data;
                        meta.data.forEach((d, index) => {
                            ctx.fillText(dataSet[index].y, d._view.x, (d._view.y-<?php print ($chartType=='bar')?'15':'30'; ?>));
                        })
                        ctx.restore();
                    }
                },

                tooltips:{
                    mode: 'label',
                    axis: 'x',
                    intersect:false,
                    backgroundColor:"rgba(255, 255, 255, 0)",
                    bodyFontColor:"#b662df",
                    titleFontColor:"#e0454f",
                    titleFontFamily:"fira_sans_bold",
                    titleFontColor:"rgba(255, 255, 255, 0)",
                    titleFontSize: 14,
                    displayColors:false,
                    bodyFontSize: 14,
                    enabled: true,
                    callbacks: {
                        label: function (item, data) {
                            const value=Number.isInteger(Number(item.xLabel))?item.yLabel:$('.chartValue').data('value');
                            $('.chartValue').html(value);
                            return "";
                        }
                    }
                },
                hover: {mode: 'label'},
                elements: {line: {tension:0,}},
                legend: {display: false,},
                scales: {
                    yAxes: [{ticks: {<?php print ($chartType=='line')?$chartMinMax:$barMinMax; ?>},}],
                    xAxes: [{
                        ticks: {
                        }
                    }],
                },
            },

        }
    );
</script>
