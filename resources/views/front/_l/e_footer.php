
			<footer class="<?php print $p->change_footer; ?>">
				<div class="footer_container">
					<div class="">
						<article class="col-sm-4 footer_content">
							<div class="logo_wrapper">
								<img src="<?php print url('/'); ?>/lmr/assets/images/Logo_LVIV.svg" class="invertImg greyImg" height="50" width="auto" alt="">
							</div>
                            <div>
                                <?php print \App\Http\Controllers\Index::getContent('footer_1'); ?>
						</article>
						<article class="col-sm-4 footer_content">
							<div class="logo_wrapper">
								<img src="<?php print url('/'); ?>/lmr/assets/images/logo_mcit.png" class=" greyImg" height="50" width="auto"
									alt="">
							</div>
                            <div>
                                <?php print \App\Http\Controllers\Index::getContent('footer_2'); ?>
                            </div>
						</article>
						<article class="col-sm-4 footer_content">
							<div class="logo_wrapper">
								<img src="<?php print url('/'); ?>/lmr/assets/images/Logo_CI.svg" class="invertImg greyImg" height="45" width="auto" alt="">
							</div>
                            <div>
                                <?php print \App\Http\Controllers\Index::getContent('footer_3'); ?>
                            </div>
						</article>
					</div>
                    <div class="col-xs-12"><hr></div>


		            <div>
                        <article class="col-xs-12 bottom_content">
                            <p>
                                <?php 
                                     $content=\App\Http\Controllers\Index::getContent('footer'); 
                                     $content=str_replace('YEAR',date("Y"),$content);
                                     print $content;
                                 ?>
                            </p>
                        </article>

                       <article class="col-xs-3 footer_content">
					   		<?php 
								$eucalipseLogo=($p->subpage==='front._s.index.index'?'https://res.cloudinary.com/dkrx3lffc/image/upload/v1699450846/EUCALIPSE/eucalipse_white_vzpzxg.png':'https://res.cloudinary.com/dkrx3lffc/image/upload/v1699450846/EUCALIPSE/eucalipse_black_qbcmie.png');
							?>
						   <p class="md:my-1 my-3 flex items-center gap-2">Розробка та підтримка <a href="https://eucalipse.com" target="_blank"><img src="<?php print $eucalipseLogo; ?>" alt={'Developed by Eucalipse Software Agency'} style="height: 30px" className="w-auto h-[30px]" /></a></p>
              	     	</article> 

		            </div>
	            </div>
			</footer>
		</div>
	</div>