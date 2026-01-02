<?php use App\Http\Controllers\Index; ?>

<div class="container ">
	<div id="content" class="about">
		<div class="row">
			<article class="col-sm-12">
				<h4 class="aboutTitle"><?php print Index::getContent('about4'); ?></h4>
			</article>
		</div>
		<div class="row">

			<article class="col-sm-6">
			<div class="heading asideTitleBg1">
			<a href="<?php print url(\App\Http\Controllers\Index::getContent('landing_url_1')); ?>"><h4><img src="<?php print url('/'); ?>/lmr/assets/images/statustuka_icon.svg" alt=""><?php print \App\Http\Controllers\Index::getContent('about_title_1'); ?></h4></a>
			</div>
				<p class="whiteBox"><?php print Index::getContent('about5'); ?></p>
			</article>

			<article class="col-sm-6">
			<div class="heading asideTitleBg2">
			<a href="<?php print url(\App\Http\Controllers\Index::getContent('landing_url_2')); ?>"><h4><img src="<?php print url('/'); ?>/lmr/assets/images/statustuka_icon.svg" alt=""><?php print \App\Http\Controllers\Index::getContent('about_title_2'); ?></h4></a>
			</div>
				<p class="whiteBox">
					<?php print Index::getContent('about6'); ?>
				</p>
			</article>

			<article class="col-sm-6">
			<div class="heading asideTitleBg3">
				<a href="<?php print url(\App\Http\Controllers\Index::getContent('landing_url_3')); ?>"><h4><img src="<?php print url('/'); ?>/lmr/assets/images/statustuka_icon.svg" alt=""><?php print \App\Http\Controllers\Index::getContent('about_title_3'); ?></h4></a>
			</div>
				<p class="whiteBox">
					<?php print Index::getContent('about7'); ?>
				</p>
			</article>

			<article class="col-sm-6">
			<div class="heading asideTitleBg4">
				<a href="<?php print url(\App\Http\Controllers\Index::getContent('landing_url_4')); ?>"><h4><img src="<?php print url('/'); ?>/lmr/assets/images/IKR_icon.png" alt=""><?php print \App\Http\Controllers\Index::getContent('about_title_4'); ?></h4></a>
			</div>
				<p class="whiteBox">
					<?php print Index::getContent('about8'); ?>
				</p>
			</article>

		</div>

		<div class="row">

			<article class="col-sm-4 ">
				<div class="image-placeholder">
					<img src="<?php print url('/'); ?>/lmr/assets/images/about_1.jpg" height="265" width="300" alt="">
				</div>
				<div class="whiteBox whiteBox2"><?php print Index::getContent('about1'); ?></div>
			</article>

			<article class="col-sm-4">
				<div class="image-placeholder">
					<img src="<?php print url('/'); ?>/lmr/assets/images/about_2.jpg" height="265" width="300" alt="">
				</div>
				<div class="whiteBox whiteBox2"><?php print Index::getContent('about2'); ?> </div>
			</article>

			<article class="col-sm-4">
				<div class="image-placeholder">
					<img src="<?php print url('/'); ?>/lmr/assets/images/about_3.jpg" height="265" width="300" alt="">
				</div>
				<div class="whiteBox whiteBox2"><?php print Index::getContent('about3'); ?></div>
			</article>

		</div>
	</div>
</div>
						
						
						