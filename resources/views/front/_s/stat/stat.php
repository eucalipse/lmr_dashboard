<?php 

    use App\Http\Controllers\VH;
    use App\Http\Controllers\Index;

    $lng=request()->get('lang','ua');
    
    if ($lng=='en'){
        $p->object->title=$p->object->title_en;
        $p->object->measurement=$p->object->measurement_en;
        $p->object->vendor_name=$p->object->vendor_name_en;
        if ($p->object->content_en) $p->object->content=$p->object->content_en;
    }

    $p->category=\App\Model\Category::where('id', $p->object->category_id)->first();
    $p->mainCategory=Index::getMainCategory($p->category);
    
    if ($p->category->type==1){
        $url_back_to_category=\App\AE\C\AE_Router::link('category', $p->category->parent);
    } else {
        $url_back_to_category=\App\AE\C\AE_Router::link('category', $p->category->id);
    }

    $url_download='https://opendata.city-adm.lviv.ua/dataset/'.$p->object->key1.'/resource/'.$p->object->key2;

    $min=0;
    $max=100;
    $values=[];

    $list=\App\Model\StatDetails::where('stat_id', $p->object->id)->orderBy('year','asc')->get();
    $isYear=true;

    
        $datas=[];
        $years=[];
        foreach($list as $item){
            $value=VH::format($item->value);
            if (strlen($item->year)>4) $isYear=false;

            if ((!empty($value) || $value==0) && is_numeric($value)){
                
                $value=round($value, 3);

                $values[]=$value;
                if ($item->type==1) {
                    $datas[]='{x:2025, y: '.$value.'}';
                    $years[]='2025';
                } else{
                    if (!empty($item->year)){
                        if ($isYear==true){
                            $datas[]='{x:'.$item->year.', y: '.$value.'}';
                            $years[]=''.$item->year.'';
                        } else {
                            $datas[]='{x:"'.$item->year.'", y: '.$value.'}';
                            $years[]='"'.$item->year.'"';
                        }
                    }
                }
            }  else {

                // $two=explode('/',$value);
                // if (count($two)==2){
                //     $datas[]='{x:"'.$item->year.'", y: '.$two[0].'}, {x:"'.$item->year.'", y: '.$two[1].'}';
                //     $years[]='"'.$item->year.'","'.$item->year.'"';
                // }

            }
        }

    if ($isYear==false) {
        rsort($years);
    }

    if ($p->mainCategory==3){
        if (count($years)>0)
        $barColors=array_fill(0, count($years)-1, 'barColor');
        $barColors[]='"#717379"';
        $barColors=join(',',$barColors);
    }

    if ($p->mainCategory==4){
        $barColors=[];
        foreach ($years as $y){
            $barColors[]=$y==2030?'"#717379"':'barColor';
        }
        $barColors=join(',',$barColors);
    }


    $barAmount=count($years);
    $years=join(',',$years);
    $datas=join(', ', $datas);
    function filtered($var){ return is_numeric($var); }
    $filtered_values=array_filter($values, "filtered");

    if (count($filtered_values)>0){
        $min=min($filtered_values);
        $max=max($filtered_values);

        $min=round($min);
        $max=ceil($max);

        if ($max>1) $pow=strlen((string)$max)-1; else $pow=0;
        $max= ceil($max/pow(10,$pow))*pow(10, $pow);
    }


    if (isset($p->object->min)){
        $min=$p->object->min;
    }

    if (isset($p->object->max)){
        $max=$p->object->max;
    }

    $chartMinMax='"min":'.$min.',"max":'.$max.',';
    $barMinMax='"min":'.$min.',"max":'.$max.',';

    // if ($p->object->min>=0 && ($p->object->max>0)){
    //     $chartMinMax='"min":'.$p->object->min.',"max":'.$p->object->max.',"stepSize":'.$p->object->step;
    //     $barMinMax='"min":'.$p->object->min.',"max":'.$p->object->max;
    // }

    $breadCrums=\App\Http\Controllers\VH::categoryTree($p->category->id);
    $breadCrums=join('<span class="arrowRight"> > </span>',$breadCrums);

    $gradients=config('_.gradients');
    $gradient1='"'.$gradients[$p->mainCategory][1].'"';
    $gradient2='"'.$gradients[$p->mainCategory][2].'"';
    $gradient3='"'.$gradients[$p->mainCategory][3].'"';

    ?>

<?php

$isArrow=true;

if ($p->mainCategory==4){
    $item_details_recent=\App\Model\StatDetails::where('stat_id', $p->object->id)->where('type', 0)->orderBy('year', 'desc')->first();

    $imgSrc='';
    $value_number='';
    $value=$item_details_recent->value;
    $valueText='';
    $addSpace=false;

    $split=explode('зменшеннядо',$value);
    if (count($split)==2){
        $value_number=$split[1];  
        $valueText='зменшення до '.$value_number;
        $imgSrc=env('PUBLIC_URL').'lmr/down.png';

        $addSpace=true;
    }

    $split=explode('абобільше',$value);
    if (count($split)==2){
        $value_number=$split[0];  
        $valueText=$value_number.' або більше';
        $imgSrc=env('PUBLIC_URL').'lmr/up.png';

        $addSpace=true;
    }

    if ($value=='зменшення'){
        $imgSrc=env('PUBLIC_URL').'lmr/down.png';
        $valueText='зменшення';

        $addSpace=true;
    } 

    if ($value=='збільшення'){
        $imgSrc=env('PUBLIC_URL').'lmr/up.png';
        $valueText='збільшення';

        $addSpace=true;
    } 

    if ($value=='null'){
        $isArrow=false;
        $imgSrc=env('PUBLIC_URL').'lmr/eye.png';
        $valueText='обсервація';

        $addSpace=true;
    }

    if ($addSpace){
        $years.=",'".$valueText."'";
        $datas.=",{x:'".$valueText."', y: ''}";
    }

    
}          

?>

<div id="twocolumns">
    <?php require __DIR__.'./../_aside.php'; ?>
    <main>
        <div class="navPage"> <?php print $breadCrums; ?> </div>
            <div class="row contentWr">
                <div class="col-md-12">
                    <div class="tab-content tab-content-area">
                        <div>
                            <div id="content">
                                <div class="heading">
                                    <h2><?php print $p->object->title ?></h2>
                                </div>
                                <div class="row">
                                    <article class="col-lg-12">
                                        <canvas id="myChart" width="500" height="150"></canvas>
                                        <div id ="row-content"></div>
                                    </article>

                                    <article class="col-lg-12">
                                        <div class="vendor_name">
                                            <span><?php print \App\Http\Controllers\Index::getContent('stat_label_1'); ?></span> 
                                            <i class="chartValue chartValue<?php print $p->mainCategory; ?>" data-value="<?php print ($p->mainCategory==4)?$valueText:$value ?>">
                                                <?php print ($p->mainCategory==4)?$valueText:$value ?>
                                            </i> 
                                            <?php print $p->object->measurement; ?>
                                        </div>
                                        <?php if ($p->object->vendor_name) { ?>
                                            <div class="vendor_name"><span><?php print \App\Http\Controllers\Index::getContent('stat_label_2'); ?></span><?php print $p->object->vendor_name; ?></div>
                                        <?php } ?>
                                        <br/>
                                        <p class="statContent"><?php print strip_tags($p->object->content); ?></p>
                                        <br/>

                                        <a href="<?php print $url_back_to_category; ?>"><button class="btn btn-back btnBack"><?php print \App\Http\Controllers\Index::getContent('stat_label_3'); ?></button></a>

                                        <?php if (!empty($p->object->key1) && !empty($p->object->key2)) {?>
                                            <a href="<?php print $url_download; ?>"><button class="btn btn-back btnDownload"><?php print \App\Http\Controllers\Index::getContent('stat_label_4'); ?></button></a>
                                        <?php }?>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </main>
</div>

<?php
    if ($p->mainCategory==3 || $p->mainCategory==4) $chartType='bar'; else $chartType='line';
    require '_chart.php';
?>