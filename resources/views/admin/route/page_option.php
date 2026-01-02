<?php 
    use App\Http\Controllers\AE\FormC;
    
    $p->pageOption->lang=0;
    
    $f=config('bb.fv')['ae_route']['f'];
    $f=FormC::prepareFields($f, 'ae_route', $p->pageOption);
    
    $f['ae_page_lang']['v']=$p->pageOption->lang;
    $f['ae_page_url']['v']=$p->pageOption->url;
    $f['ae_seo_title']['v']=$p->pageOption->seo['title'];
    $f['ae_seo_keywords']['v']=$p->pageOption->seo['keywords'];
    $f['ae_seo_description']['v']=$p->pageOption->seo['description'];
    
    $f['ae_seo_og_title']['v']=$p->pageOption->seo['og_title'];
    $f['ae_seo_og_description']['v']=$p->pageOption->seo['og_description'];
    
    $f['ae_seo_og_img']['v']=$p->pageOption->seo['og_img'];
?>

<div class="form-group row">
	<div class="col-sm-12">
		<?php print FormC::fld($f['ae_page_lang']); ?>
	</div>
	
</div>

<div class="form-group row">

	<div class="col-sm-12">
		<?php print FormC::fld($f['ae_page_url']); ?>
	</div>
	
</div>
<br/>
SEO Meta Tags
<hr/>
<div class="form-group row">
	<div class="col-sm-12">
		<?php print FormC::fld($f['ae_seo_title']); ?>
	</div>
</div>


<div class="form-group row">
	<div class="col-sm-12">
		<?php print FormC::fld($f['ae_seo_keywords']); ?>
	</div>
	
</div>


<div class="form-group row">
	<div class="col-sm-12">
		<?php print FormC::fld($f['ae_seo_description']); ?>
	</div>
</div>
<br/>
Open Graph Tags
<hr/>
<div class="form-group row">
	
	<div class="col-sm-12">
		<?php print FormC::fld($f['ae_seo_og_title']); ?>
	</div>
	
</div>

<div class="form-group row">
	<div class="col-sm-12">
		<?php print FormC::fld($f['ae_seo_og_description']); ?>
	</div>
</div>

<div class="form-group row">
	<div class="col-sm-12">
		<?php print FormC::fld($f['ae_seo_og_img']); ?>
	</div>
</div>




