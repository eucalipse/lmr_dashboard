<?php
    if (!$p->category) return;

    $lng = request()->get('lang', 'ua');

    $subCategories=\App\Model\Category::where('parent', $p->category->id)->where(function ($query) {$query->where('type', '=', 1)->orWhere('type', '=', 2);})->get();

    if (count($subCategories)>0){
        $category_sub_first=$subCategories[0];
    } else {
        $category_sub_first=$p->category;
    }

    $breadCrums=\App\Http\Controllers\VH::categoryTree($p->category->id);
    $breadCrums=join('<span class="arrowRight"> > </span>',$breadCrums);
?>

<div id="twocolumns">
    <?php require __DIR__.'./../_aside.php'; ?>
	<main class="<?php print 'color'.$p->mainCategory; ?>">
        <div class="navPage">
            <?php print $breadCrums; ?>
        </div>
        <?php if (count($subCategories)>0) require 'dropMenu.php';?>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content tab-content-area">
                    <div role="tabpanel" class="tab active">
                        <?php
                        if ($p->category->type==2){
                            print ($lng == 'en' && $p->category->content_en) ? $p->category->content_en : $p->category->content;
                        } else {
                            if (count($subCategories)>0){
                                if (!isset($_GET['subCategory'])){
                                    $category=$category_sub_first;
                                    print '<div class="row" id="subCategory'.$category->id.'">';
                                    require 'content.php';
                                    print '</div>';
                                } else {
                                    $category=\App\Model\Category::where('id', $_GET['subCategory'])->where(function ($query) {$query->where('type', '=', 1)->orWhere('type', '=', 2);})->first();
                                    if ($category->type==2) {
                                        print ($lng == 'en' && $category->content_en) ? $category->content_en : $category->content;
                                    } else {
                                        print '<div class="row" id="subCategory' . $category->id . '">';
                                        require 'content.php';
                                        print '</div>';
                                    }
                                    }
                                } else{
                                    $category=$p->category;
                                    require 'content.php';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
	</main>
</div>
						
					