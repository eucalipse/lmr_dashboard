<div class="content">
    <div class="page-title">
        <h3>Редагування публікації <a href="<?php print \App\AE\C\AE_Router::link('article', $p->item->id); ?>" target="_blank"><i class="fa fa-eye"></i></a></h3>
    </div>
</div>
      
<div class="row-fluid">
<div class="span12">
  <div class="grid simple">
  
    <div class="grid-body">

        <ul class="nav nav-tabs" role="tablist">
            <li class="active"> <a href="#tab1" role="tab" data-toggle="tab">Налаштування показника</a> </li>
            <li><a href="#tab3" role="tab" data-toggle="tab">Налаштування сторінки/СЕО</a></li>
        </ul>


        <div class="tab-content">

            <div class="tab-pane active" id="tab1">
                <div class="row">
                    <form method="post">
                        <?php print $p->form->out; ?>
                        <input class="btn btn-primary saveSubForm" data-f="<?php print $p->form->model; ?>"  data-id="<?php print $p->id; ?>" value=" Зберегти">
                    </form>
                 </div>
            </div>

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

