<div class="content">  
		<div class="page-title">	
			<h3><?php print $p->v->title; ?></h3>		
		</div>
</div>



<div class="row-fluid">
<div class="span12">
  <div class="grid simple ">
  
  <?php if (!isset($p->v->addDisabled)) { ?>
  <div class="grid-title">
      <a href="<?php print url('/'); ?>/lmr_access/<?php print $p->model; ?>/add"><h4><i class="fa fa-plus fa fa-3x custom-icon-space" id="icon-resize"></i>Додати</h4></a>
  </div>
  <?php } ?>
  
    
   <div class="grid-body">
	
      <table class="table table-hover table-condensed ae_dt" id="table<?php print $p->model; ?>">
        <thead>
          <tr>
           <?php  foreach($p->v->head as $item){ print '<th>'.$item.'</th>'; } ?>
          </tr>
        </thead>
        <tbody>
		<?php 
    		$list=\App\AE\C\AE_D::getDataList($p->v);
    		foreach($list as $item){
    		    $cols='';
    		    foreach($p->v->content as $fieldName=>$column){
    		        $column=(object)$column;
    		        $value=\App\AE\C\AE_V::field($item, $fieldName, $column, $p);
    		        $cols.='<td class="v-align-middle">'.$value.'</td>';
    		    }
    		    
    		    print '<tr class="row'.$item->id.'">'.$cols.' </tr>';
    		}    
		?>
        </tbody>
      </table>
      
   </div>
   
  </div>
</div>
</div>