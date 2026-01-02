<div class="header navbar navbar-inverse "> 

  <div class="navbar-inner">
	
	<div class="header-seperation"> 
		<ul class="nav pull-left notifcation-center visible-xs visible-sm">	
		 <li class="dropdown"> 
		 	<a href="#main-menu" data-webarch="toggle-left-side"> 
		 		<div class="iconset top-menu-toggle-white"></div> 
		 	</a> 
		 </li>		 
		</ul>
      
      <a href="<?php print url('/'.$p->panel_url); ?>" class="logoWR">
      	<img src="<?php  print URL::to('/lmr/assets/images/logo_open.svg'); ?>"  data-src="<?php  print URL::to('/lmr/assets/images/logo_open.svg'); ?>" data-src-retina="<?php  print URL::to('/lmr/assets/images/logo_open.svg'); ?>" width="130" height="70" />
      </a>
   </div>
      
      <!-- END RESPONSIVE MENU TOGGLER --> 
      <div class="header-quick-nav" > 
      <!-- BEGIN TOP NAVIGATION MENU -->
	  <div class="pull-left"> 
        <ul class="nav quick-section">
          <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
            <div class="iconset top-menu-toggle-dark"></div>
            </a> </li>
        </ul>
        
	  </div>
	 <!-- END TOP NAVIGATION MENU -->
	 
	 
	 <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right"> 
		 <ul class="nav quick-section ">
			<li class="quicklinks"> 
				<a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
					<div class="iconset top-settings-dark "></div> 	
				</a>
				<ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
				  <li>
                  	<a href="<?php print url('/'); ?>" target="_blank"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp;На головну</a>
                  </li>
                  
                  <li class="divider"></li>                
                  <li>
                  	<a href="<?php print url('/'.$p->panel_url.'/logout'); ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Вихід</a>
                  </li>
               </ul>
			</li> 
			<li class="quicklinks"> <span class="h-seperate"></span></li>
		</ul>
		
      </div>

      </div> 
   
  </div>

</div>
