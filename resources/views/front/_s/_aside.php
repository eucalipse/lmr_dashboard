<?php
	$lng=request()->get('lang','ua');

	$mainCategoryImg='';
	if ($p->mainCategory==1) [$mainCategoryImg='statustuka_icon.svg'];
	if ($p->mainCategory==2) [$mainCategoryImg='yajist_zhutta_icon.svg'];
	if ($p->mainCategory==3) [$mainCategoryImg='strategia_icon.svg'];
	if ($p->mainCategory==4) [$mainCategoryImg='IKR_icon.png'];

	function getTopCategory($categoryId){
		// If this is already a main category, return it
		if ($categoryId==1 || $categoryId==2 || $categoryId==3 || $categoryId==4){
			return $categoryId;
		}
		$c=\App\Model\Category::where('id', $categoryId)->first();
		if (!$c) return $categoryId; // Safety check
		if ($c->parent==1 || $c->parent==2 || $c->parent==3 || $c->parent==4){
			return $c->id;
		} else {
			return getTopCategory($c->parent);
		}
	}
	$topCategory=getTopCategory($p->category->id);
?>

<aside id="sidebar">
    <p class="asideTitle asideTitleStat <?php print 'asideTitleBg'.$p->mainCategory; ?>"><img src="<?php print url('/'); ?>/lmr/assets/images/<?php print $mainCategoryImg; ?>" alt=""><?php  print \App\Http\Controllers\Index::getContent('about_title_'.$p->mainCategory);  ?></p>
	<nav>
		<ul class="panel-group nav-menu" id="accordion" role="tablist" aria-multiselectable="false">
			<?php
    			use App\Model\Category;
    			$isEn = $lng == 'en';
    			$items=Category::where('parent', $p->mainCategory)->get();

    			foreach ($items as $item){
    			    $url=\App\AE\C\AE_Router::link('category', $item->id, $isEn);

    			    $_items=Category::where('parent', $item->id)->where('type', null)->get();
    			    $hasSub=count($_items)>0;

    			    $sub='';
    			    if ($hasSub){
    			        $in='';
    			        $j=0;
    			        foreach ($_items as $i){
    			            if ($j==0) $url=\App\AE\C\AE_Router::link('category', $i->id, $isEn);
    			            if ($i->type<>1){
    			                $selected='';
    			                if ($i->id==$p->category->id) {$selected=' a_active'; $in='in';}
    			                $url_sub=\App\AE\C\AE_Router::link('category', $i->id, $isEn);
        			            $sub.='<li><a class="  collapsed" data-toggle="none" aria-expanded="none" role="button" href="'.$url_sub.'">'.(($lng=='ua')?$i->title:$i->title_en).'</a></li>';
    			            }
    			            $j++;
    			        }
    			        
    			        $sub='<div id="collapsibleContenttransport-menu" class="panel-collapse collapse '.$in.'" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="true">
        			             <div class="panel-body">
            			             <ul class="list-bottom">
                                        '.$sub.'
        			                 </ul>
        			            </div>
    			              </div>';

                        $selected1=($topCategory==$item->id?' a_active':'');
                        $selected2=($topCategory==$item->id?' a_active2':'');
    			        print '<li class="panel panel-default hover_bg '.$selected1.'">
    			               <div class="panel-heading  '.$selected2.'" role="tab">
            					   <strong class="panel-title">
        			                 <a class=" collapsed" data-toggle="none" aria-expanded="none" role="button" href="'.$url.'">'.(($lng=='ua')?$item->title:$item->title_en).'</a>
        			               </strong>
        			               <a class="caret caret-left collapsed" data-toggle="none" aria-expanded="none" role="button" href="'.$url.'"></a>
                				</div>
        			            '.$sub.'          
                		   </li>';
    			    } else {
                        $selected1=($topCategory==$item->id?' a_active':'');
                        $selected2=($topCategory==$item->id?' a_active2':'');
    			        print '<li class="panel panel-default '.$selected1.'">
    			               <div class="panel-heading  '.$selected2.'" role="tab">
            					   <strong class="panel-title">
        			                <a class=" collapsed" data-toggle="none" aria-expanded="none" role="button" href="'.$url.'">'.(($lng=='ua')?$item->title:$item->title_en).'</a>
        			               </strong>
                				</div>
                		   </li>';
    			    }
    			}
			?>
		</ul>
	</nav>
</aside>