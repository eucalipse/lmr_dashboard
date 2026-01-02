<?php $lng = request()->get('lang', 'ua'); $isEn = $lng == 'en'; ?>
<div class="container articles">
    <div id="content">
        <div class="row">
<?php
    $list=\App\Model\Article::All();
        foreach ($list as $item){
            $url=\App\AE\C\AE_Router::link('article', $item->id, $isEn);
            $itemTitle = ($lng == 'en' && $item->title_en) ? $item->title_en : $item->title;
?>
    <article class="col-sm-6 col-md-4 content-text article">
        <a href="<?php print $url; ?>">
        <div class="image-placeholder">
            <img src="<?php print $item->img ?>" height="265" width="300" alt="">
        </div>
            <div class="desc">
                    <h4><?php print $itemTitle; ?></h4>
            </div>
            <div class="bottomTitle">
                <b><span class="info-text-year"><?php print date('Y-m-d', strtotime($item->date)); ?></span></b>
                <a href="<?php print $url; ?>"><div class="btn_widget"><?php print \App\Http\Controllers\Index::getContent('article_3'); ?></div></a>
            </div>
        </a>
    </article>
<?php
        }
?>
    </div>
</div>

