<div class="content">  
		<div class="page-title">	
			<h3>Показники з АПІ</h3>
            <a class="btn btn-primary" href="?apiDo">Стягнути</a>
		</div>
</div>



<div class="row-fluid">
<div class="span12">
  <div class="grid simple ">

      <div class="grid-body">

          <table class="table table-hover table-condensed ae_dt" id="table">
              <thead>
              <tr>
                  <td>Набір</td> <td>Показик</td>  <td>Код</td>
              </tr>
              </thead>
              <tbody>
                <?php if (isset($_GET['apiDo'])) \App\Http\Controllers\AdminC::statAPI(); ?>
              </tbody>
          </table>

      </div>

  </div>
</div>
</div>