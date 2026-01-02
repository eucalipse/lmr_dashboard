<div class="c_element_row ae_elements_0">
		<div class="row">
			<div class="col-md-2">
        		<div class="form-group">
        		      <input type="hidden" name="task_detail" value="" class="c_0" />
                      <label for="">Показник </label>
                      <?php print $p->task_stat; ?>
                </div>
            </div>
            
              <div class="col-md-2">
            		<div class="form-group">
                          <label for="">Рік</label>
                          <input type="text" value="" class="c_2" />
                    </div>
                </div>
                
              <div class="col-md-2">
            		<div class="form-group">
                          <label for="">Подане значення </label>
                        
                    </div>
                </div> 
                
                <div class="col-md-2">
            		<div class="form-group">
                          <label for="">Статус </label>
                          <?php print $p->task_state; ?>
                    </div>
            </div>
            
            <div class="col-md-3">
            	<label for=""></label>
            	<a href="#" class="c_delete_element"><i class="fa fa-minus-square-o"></i>  Усунути</a>
            </div>
        </div>
</div>

<div class="content">  
		<div class="page-title">	
			<h3><?php print $p->title; ?></h3>		
		</div>
</div>
      
<div class="row-fluid">
<div class="span12">
  <div class="grid simple ">
  
    <div class="grid-body ">
	
		<form method="post">
    		<?php print $p->form->out; ?>
    		
    		<div class="box-body">
	    		<a class="btn btn-primary c_add_element"> <i class="fa fa-plus-square-o"></i> Додати показники</a><br/><br/>
	    		<div class="c_element_rows">
	    		<?php 
	    		  foreach ($p->task_stats as $item){
	    		      
	    		    print '<div class="c_element_row">
                            		<div class="row">
                            			<div class="col-md-2">
                                    		<div class="form-group">
			                                      <input type="hidden" name="task_detail" value="'.$item->item->id.'" class="c_0" />
                                                  <label for="">Показник </label>
                                                  '.$item->stat.'</br>
                                                   <a href="'.url('/').'/lmr_access/stat/edit/'.$item->item->stat.'" target="_blank">Перейти до показника</a><br/>
                                                  <label for="">Статистичні дані </label>
                                                  '.$item->stat_details_out.'
                                            </div>
                                        </div>
            	
                                        <div class="col-md-2">
                                    		<div class="form-group">
                                                  <label for="">Рік</label>
            	                                  <input type="text" value="'.$item->item->year.'" class="c_2" />
                                            </div>
                                        </div>
			                         
			                            <div class="col-md-2">
                                    		<div class="form-group">
                                                  <label for="">Подане значення </label>
                                                  '.$item->item->value.'<br/><br/>
                                                   <a href="#" class="addtoStat" data-id="'.$item->item->id.'"><label class="btn btn-success btn-cons">Додати до показника</label></a>
                                            </div>
                                        </div> 
			    
			                            <div class="col-md-2">
                                    		<div class="form-group">
                                                  <label for="">Статус </label>
                                                  '.$item->state.'
                                            </div>
                                        </div> 
			    
                                        <div class="col-md-3">
                                        	<label for=""></label>
                                        	<a href="#" class="c_delete_element"><i class="fa fa-minus-square-o"></i>  Усунути</a>
                                        </div>
                                    </div>
                            </div>';
	    		      
	    		  }
                 ?>
                    		   
	    		</div>	
	    	</div>
	    		
    		<input class="btn btn-primary saveSubForm saveCompose" data-f="<?php print $p->form->model; ?>" data-id="<?php if (empty($p->id)) print '-1'; else print $p->id; ?>" value=" Зберегти">	
		</form>
	
    </div>
    
  </div>
</div>
</div>
