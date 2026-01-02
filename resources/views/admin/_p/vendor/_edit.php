<div class="content">  
		<div class="page-title">	
			<h3><?php print $p->title; ?></h3>		
		</div>
</div>
      
<div class="row-fluid">
<div class="span12">
  <div class="grid simple ">
  
    <div class="grid-body ">
	
	<ul class="nav nav-tabs" role="tablist">
        <li class="active"> <a href="#tab1" role="tab" data-toggle="tab">Налаштування розпорядника</a> </li>
        <li><a href="#tab3" role="tab" data-toggle="tab">Логін/Пароль</a></li>
	</ul>


	<div class="tab-content">
		<div class="tab-pane active" id="tab1">
			<div class="row">
				<form method="post">
            		<?php  print $p->form_vendor->out; ?>
            		<input class="btn btn-primary saveSubForm" data-f="<?php print $p->form_vendor->model; ?>" data-id="<?php print $p->id; ?>" value="Зберегти">	
                </form>
			</div>
		</div>

		<div class="tab-pane" id="tab3">
			<div class="row ">
			
			<form method="post">
			    <?php print $p->form_vendor_password->out; ?>
    		    <input class="btn btn-primary saveSubForm" data-f="<?php print $p->form_vendor_password->model; ?>" data-id="<?php print $p->id; ?>" value=" Зберегти">	
		    </form>
		
			</div>
		</div>
					
	
		</div>
	</div>
					
	
    </div>
    
  </div>
</div>
