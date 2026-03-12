        <?php $lurl = function($path) { return \App\Http\Controllers\Index::lurl($path); }; ?>
        <nav class="navbar navbar-default navbar-fixed-top <?php print $p->changeHeader; ?> ">
            <div class="">
                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php print $lurl('/'); ?>"><img src="<?php print url('/'); ?>/lmr/assets/images/logo_open.svg" width="150px" alt="Панель міста"></a>
                </div>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <ul class="links-info nav navbar-nav navbar-right">
                            <li <?php if (isset($p->mainCategory) && $p->mainCategory==1) print 'class="activeMainCategory"'; ?>><a href="<?php print $lurl('/statystyka/details'); ?>"><?php print \App\Http\Controllers\Index::getContent('header_1'); ?></a></li>
                            <li <?php if (isset($p->mainCategory) && $p->mainCategory==2) print 'class="activeMainCategory"'; ?>><a href="<?php print $lurl('/jakist-zyttia/details'); ?>"><?php print \App\Http\Controllers\Index::getContent('header_2'); ?></a></li>
                            <li <?php if (isset($p->mainCategory) && $p->mainCategory==3) print 'class="activeMainCategory"'; ?>><a href="<?php print $lurl('/strategia/details'); ?>"><?php print \App\Http\Controllers\Index::getContent('header_3'); ?></a></li>
                            <li <?php if (isset($p->mainCategory) && $p->mainCategory==4) print 'class="activeMainCategory"'; ?>><a href="<?php print $lurl('/concepcia/zhytlo'); ?>"><?php print \App\Http\Controllers\Index::getContent('header_4'); ?></a></li>
                            <?php if ($p->lng=='ua'){ ?>
                                <li><a href="<?php print $lurl('/articles'); ?>"><?php print \App\Http\Controllers\Index::getContent('header_5'); ?></a></li>
                            <?php } ?>
                            <li><a href="<?php print $lurl('/about'); ?>"><?php print \App\Http\Controllers\Index::getContent('header_6'); ?></a></li>
                            <li>
                                <div class="lngBar">
                                    <span lng="ua">UA</span>
                                    <span lng="en">EN</span>
                                </div>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
