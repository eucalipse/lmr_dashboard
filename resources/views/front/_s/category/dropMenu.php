<?php $lng = request()->get('lang', 'ua'); ?>
<div class="dropdown dropdownMenu">
    <button class="dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
            if (isset($_GET['subCategory'])){
                $a=\App\Model\Category::where('id', $_GET['subCategory'])->first();
                if (isset($a)){
                    print ($lng == 'en' && $a->title_en) ? $a->title_en : $a->title;
                }
            } else {
                print \App\Http\Controllers\Index::getContent('select_category');
            }
        ?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu dropdownContent" aria-labelledby="about-us">
        <?php
            foreach ($subCategories as $c){
                $catTitle = ($lng == 'en' && $c->title_en) ? $c->title_en : $c->title;
                print '<li><a href="?subCategory='.$c->id.'">'.$catTitle.'</a></li>';
            }
        ?>
    </ul>
</div>