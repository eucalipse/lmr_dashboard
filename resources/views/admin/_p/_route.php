<?php  use App\AE\C\AE_F; ?>

<div class="box">
	<div class="box-body">
		<form>
            <div class="form-group row">
            	<div class="col-sm-12">
            		<?php print AE_F::fld($p->route->fields->url); ?>
            	</div>
            </div>
            
            <br/> SEO Meta Теги <hr/>
            
            <div class="form-group row">
            	<div class="col-sm-12">
            		<?php print AE_F::fld($p->route->fields->title); ?>
            	</div>
            </div>

			<div class="form-group row">
            	<div class="col-sm-12">
            		<?php print AE_F::fld($p->route->fields->title_en); ?>
            	</div>
            </div>
            
            <div class="form-group row">
            	<div class="col-sm-12">
            		<?php print AE_F::fld($p->route->fields->keywords); ?>
            	</div>
            	
            </div>

			<div class="form-group row">
            	<div class="col-sm-12">
            		<?php print AE_F::fld($p->route->fields->keywords_en); ?>
            	</div>
            	
            </div>
            
            <div class="form-group row">
            	<div class="col-sm-12">
            		<?php print AE_F::fld($p->route->fields->description); ?>
            	</div>
            </div>

			<div class="form-group row">
            	<div class="col-sm-12">
            		<?php print AE_F::fld($p->route->fields->description_en); ?>
            	</div>
            </div>
            
		    <a class="btn btn-primary saveRoute" href="#" data-f="<?php print $p->route->model; ?>" data-id="<?php print $p->route->id; ?>">Зберегти налаштування</a>
		</form>
	</div>
</div>