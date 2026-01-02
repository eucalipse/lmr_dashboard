<?php 

    function buildTree(array $elements, $parentId = 0) {
        $branch = array();
         
        foreach ($elements as $element) {
            if ($element->parent == $parentId) {
                $children = buildTree($elements, $element->id);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
         
        return $branch;
    }
    
    function subelements($list){
        $o='';
        foreach ($list as $item){
            
            $url_edit=url('lmr_access/category/edit/'.$item->id);
            $url_view=\App\AE\C\AE_Router::link('category', $item->id);
            $url_del='<a href="#" class="ae_delete_item" data-m="category" data-id="'.$item->id.'" data-toggle="tooltip" title="Видалити"><i class="fa fa-times-circle"></i></a>';
            
            
            if (isset($item->children) && count($item->children)>0){
                $o.='<li class="'.$item->id.' dd-item" data-id="'.$item->id.'">
                           <div class="dd-handle">['.$item->code.'] '.$item->title.'
                              
                               '.$url_del.'
                              <a href="'.$url_edit.'"><i class="fa fa-edit"></i></a>
                              <a href="'.$url_view.'" target="_blank"><i class="fa fa-eye"></i></a>
                                  
                            </div>
                                  
                            <ol class="dd-list">
                            '.subelements($item->children).'
                            </ol>
                        </li>';
            } else {
                $s='';
                
                if ($item->type==1) $s='[Внутрішня категорія]';
                
                $o.='<li class="row'.$item->id.' dd-item" data-id="'.$item->id.'">
                        <div class="dd-handle">['.$item->code.'] '.$item->title.' '.$s.'
                            '.$url_del.'
                            <a href="'.$url_edit.'"><i class="fa fa-edit"></i></a>
                            <a href="'.$url_view.'" target="_blank"><i class="fa fa-eye"></i></a>
                         </div>
    		         </li>';
            }
        }
        
        return $o;
    }

    $items=\DB::select('SELECT * FROM `category` order by id');
    $tree = buildTree($items, 0);

?>

<div class="content">  
		<div class="page-title">	
			<h3><?php print $p->v->title; ?></h3>		
		</div>
</div>
      
<div class="row-fluid">
<div class="span12">
  <div class="grid simple ">
  
  <div class="grid-title">
      <a href="<?php print url('/'); ?>/lmr_access/category/add"><h4><i class="fa fa-plus fa fa-3x custom-icon-space" id="icon-resize"></i>Додати</h4></a>
  </div>
    
		<div class="col-md-12 pull-center">

         	 <div class="dd" id="nestable2">
    		       <ol class="dd-list ">
    		           <?php print subelements($tree); ?>
    		       </ol>
    		 </div>
		
		</div>
     
    </div>
  </div>
</div>
