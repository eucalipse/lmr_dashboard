<div class="box">
	<div class="box-header">
		<h3><?php print $p->title; ?></h3>
	</div>

	<?php 
		$v=config('bb.v')['route'];
		
		$v['q']=[
		
		    [
		    'p1'=>'type',
		    'p2'=>'<>',
		    'p3'=>-1
		    ]    
		        
		];
		
		print \App\Http\Controllers\AE\V\VTable::create($v);		
	?>

</div>
