<div class="c_element_row  ae_elements_0">
    <div class="row m-t-15">
        <div class="col-md-3 col-sm-3 col-xs-3"> <label for="">Рік </label>
             <input type="text" value="" class="c_1" />
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3"> <label for="">Значення </label>
            <input type="text" value="" class="c_2" />
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3"> <label for="">Тип </label>
            <select class="c_3">
                <option value="0">Звичайний</option>
                <option value="1">План</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for=""></label>
            <a href="#" class="c_delete_element"><i class="fa fa-minus-square-o"></i>  Усунути</a>
        </div>
    </div>
</div>

<div class="content">  
    <div class="page-title">
        <h3>Редагування показника <a href="<?php print \App\AE\C\AE_Router::link('stat', $p->form_stat->item->id); ?>" target="_blank"><i class="fa fa-eye"></i></a></h3>
    </div>
</div>
      
<div class="row-fluid">
<div class="span12">
  <div class="grid simple">
  
    <div class="grid-body">

        <ul class="nav nav-tabs" role="tablist">
            <li class="active"> <a href="#tab1" role="tab" data-toggle="tab">Налаштування показника</a> </li>
            <li><a href="#tab2" role="tab" data-toggle="tab">Дані в динаміці</a></li>
            <li><a href="#tab3" role="tab" data-toggle="tab">Налаштування сторінки/СЕО</a></li>
        </ul>


        <div class="tab-content">

            <div class="tab-pane active" id="tab1">
                <div class="row">
                    <form method="post">
                        <?php print $p->form_stat->out; ?>
                        <input class="btn btn-primary saveSubForm" data-f="<?php print $p->form_stat->model; ?>"  data-id="<?php print $p->id; ?>" value=" Зберегти">
                    </form>
                 </div>
            </div>

            <?php require('_details.php'); ?>

            <div class="tab-pane" id="tab3">
                <div class="row">
                    <?php  print view('admin._p._route')->with('p', $p); ?>
                </div>
            </div>
        </div>

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
