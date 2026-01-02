<?php
    $lng = request()->get('lang', 'ua');
    $isEn = $lng == 'en';
    $next =\App\Model\Article::where('id', '>', $p->item->id)->min('id');
    if (!isset($next)) $next=1;
    $url=\App\AE\C\AE_Router::link('article', $next, $isEn);
    $articleTitle = ($lng == 'en' && $p->item->title_en) ? $p->item->title_en : $p->item->title;
    $articleContent = ($lng == 'en' && $p->item->content_en) ? $p->item->content_en : $p->item->content;
?>
<div id="twocolumns">
    <div class="container-post">
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content tab-content-area">
                <h2 class="postTitle"><?php print $articleTitle ?></h2>
                    <div id="content">
                            <p><?php print $articleContent ?></p>
                    </div>
                <div class="btnBottom">
                    <a class="btn" href="<?php print \App\Http\Controllers\Index::lurl('/articles'); ?>"><?php print \App\Http\Controllers\Index::getContent('article_1'); ?></a>
                    <a class="btn" href="<?php print $url; ?>"><?php print \App\Http\Controllers\Index::getContent('article_2'); ?></a>
                </div>
            </div>
    </div>
</div>
</div>






