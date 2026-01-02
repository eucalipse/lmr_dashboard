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
    		<?php  print $p->form->out; ?>
    		<input class="btn btn-primary saveSubForm" data-f="<?php print $p->form->model; ?>" data-id="<?php if (empty($p->id)) print '-1'; else print $p->id; ?>" value=" Зберегти">	
		</form>
	
    </div>
    
  </div>
</div>
</div>

<script>
function refreshWidgetParameters(widget_type){
    if (widget_type==2 || widget_type==3){

    	if (widget_type==2){
			$('#p_icon').parent('.form-group').show();
			$('#p_text').parent('.form-group').hide();
    	}

    	if (widget_type==3){
			$('#p_icon').parent('.form-group').show();
			$('#p_text').parent('.form-group').show();
    	}

    } else {
		$('#p_icon').parent('.form-group').hide();
    	$('#p_text').parent('.form-group').hide();
    }


}

$(function() {
	var widget_type=$('#widget_type').val();
	refreshWidgetParameters(widget_type);

	$('#widget_type').on('change', function() {
		var widget_type=$(this).val();
		refreshWidgetParameters(widget_type)
	});
});
</script>