<div class="content">  
	<div class="page-title"> <h3>Імпорт показників</h3>	</div>
</div>
      
<div class="row-fluid">
	<div class="span12">
  		<div class="grid simple">
  			<div class="grid-title"></div>
		    <div class="grid-body">
	
			   <form method="post" action="<?php print url('/lmr_access/import'); ?>" enctype="multipart/form-data">
        			Виберіть файл <input type="file" name="file"> <br/><br/>
        			<input class="isubmit btn btn-primary" type="submit" value="Завантажити">
        		</form>
        		
        		
        		<hr>
        		
        		<?php if (isset($result)) print $result; ?>
      
    		</div>
  		</div>
	</div>
</div>
