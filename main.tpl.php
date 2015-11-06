<?php
    $config = cmsConfig::getInstance();
    $core = cmsCore::getInstance();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php $this->title(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-text.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-layout.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-gui.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-widgets.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-content.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-modal.css"); ?>
	<?php $this->addMainCSS("templates/{$this->name}/css/add.css"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/jquery.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/jquery-modal.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/core.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/modal.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/messages.js"); ?>
    <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <?php $this->head(); ?>
    <style><?php include('options.css.php'); ?></style>
</head>
<body>

    <div id="layout">

        <?php if (!$config->is_site_on){ ?>
            <div id="site_off_notice"><?php printf(ERR_SITE_OFFLINE_FULL, href_to('admin', 'settings', 'siteon')); ?></div>
        <?php } ?>

        <header>
		    <div class="header_nav">
			    <?php $this->widgets('header', false, 'wrapper_plain'); ?>
				<div class="header_search normal">
				    <?php $this->widgets('header-right', false, 'wrapper_plain'); ?>
				</div>
				<div class="header_search mobile">
				    <a class="header_search_link" href="/search">Поиск</a>
				</div>
			</div>
			
			<div class="header_cont">
                <div id="logo"><a href="<?php echo href_to_home(); ?>"></a></div>
				<div class="header_banner"><?php $this->widgets('header_banner', false, 'wrapper_plain'); ?></div>
			</div>
        </header>

        <?php if($this->hasWidgetsOn('top')) { ?>
            <nav>
                <?php $this->widgets('top', false, 'wrapper_plain'); ?>
            </nav>
        <?php } ?>
        <div class="clear"></div>
        <div id="body">

            <?php
                $is_sidebar = $this->hasWidgetsOn('right-top', 'right-center', 'right-bottom');
                $section_width = $is_sidebar ? '730px' : '100%';
            ?>

            <?php
                $messages = cmsUser::getSessionMessages();
                if ($messages){
                    ?>
                    <div class="sess_messages">
                        <?php
                            foreach($messages as $message){
                                echo $message;
                            }
                        ?>
                    </div>
                    <?php
                }
            ?>
			
			<?php if($this->hasWidgetsOn('wide-top')) { ?>
			    <div id="wide-top">
			        <?php $this->widgets('wide-top'); ?>
			    </div>
			<?php } ?>
			
            <section style="width:<?php echo $section_width; ?>">

                <?php $this->widgets('left-top'); ?>
				
			    <?php
					$top_banners_two = $this->hasWidgetsOn('top-banner-left') && $this->hasWidgetsOn('top-banner-right');
                    $top_banner_width = $top_banners_two ? '49.45%' : '100%';					
                ?>
				
				<?php if($this->hasWidgetsOn('top-banner-left') && $this->hasWidgetsOn('top-banner-right')) { ?>
				<div id="top-banners">
				    <div class="top-banner-left" style="width:<?php echo $top_banner_width; ?>">
                        <?php $this->widgets('top-banner-left'); ?>
					</div>
					<div class="top-banner-right" style="width:<?php echo $top_banner_width; ?>">
					    <?php $this->widgets('top-banner-right'); ?>
					</div>
                </div>
				<?php } elseif ($this->hasWidgetsOn('top-banner-left')){ ?>
				<div id="top-banners">
				    <div class="top-banner-left" style="width:<?php echo $top_banner_width; ?>">
                        <?php $this->widgets('top-banner-left'); ?>
					</div>
                </div>
				<?php } elseif ($this->hasWidgetsOn('top-banner-right')){ ?>
				<div id="top-banners">
				    <div class="top-banner-right" style="width:<?php echo $top_banner_width; ?>">
                        <?php $this->widgets('top-banner-right'); ?>
					</div>
                </div>
                <?php } ?>
				
                <?php if ($this->isBody()){ ?>
                    <article>					
                        <?php if ($this->isBreadcrumbs()){ ?>
                            <div id="breadcrumbs">
                                <?php $this->breadcrumbs(array('strip_last'=>false)); ?>
                            </div>
                        <?php } ?>
					<?php
					     $action_disp['action'] = $this->hasWidgetsOn('action');					
                    ?>
						<?php if ($action_disp['action']){ ?>
				              <?php $this->widgets('action'); ?>
                        <?php } ?>
						
                        <?php $this->body(); ?>
                    </article>
                <?php } ?>

                <?php $this->widgets('left-bottom'); ?>

            </section>

			<aside>
                <?php $this->widgets('right-top'); ?>

                <?php $this->widgets('right-center'); ?>

                <?php $this->widgets('right-bottom'); ?>
            </aside>
			
			<?php if($this->hasWidgetsOn('three-left')) { ?>
			    <div id="three">			  
			        <?php $this->widgets('three-left'); ?>
						
			        <?php $this->widgets('three-center'); ?>
						
					<?php $this->widgets('three-right'); ?>						
			    </div>
			<?php } ?>
			
			<?php if($this->hasWidgetsOn('wide-bottom')) { ?>
			    <div id="wide-bottom">			  
			        <?php $this->widgets('wide-bottom'); ?>			
			    </div>
			<?php } ?>

        </div>

        <?php if ($config->debug && cmsUser::isAdmin()){ ?>
            <div id="sql_debug" style="display:none">
                <div id="sql_queries">
                    <?php foreach($core->db->query_list as $sql) { ?>
                        <div class="query">
                            <div class="src"><?php echo $sql['src']; ?></div>
                            <?php echo nl2br($sql['sql']); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <footer class="parent">
            <ul>
                <li id="copyright">
                    <a href="<?php echo $this->options['owner_url'] ? $this->options['owner_url'] : href_to_home(); ?>">
                        <?php html($this->options['owner_name'] ? $this->options['owner_name'] : cmsConfig::get('sitename')); ?></a>
                    &copy;
                    <?php echo $this->options['owner_year'] ? $this->options['owner_year'] : date('Y'); ?>
                </li>
                <li id="info">
                    <span class="item">
                        <?php echo LANG_POWERED_BY_INSTANTCMS; ?>
                    </span>
                    <span class="item">
                        <?php echo LANG_ICONS_BY_FATCOW; ?>
                    </span>
                    <?php if ($config->debug && cmsUser::isAdmin()){ ?>
                        <span class="item">
                            SQL: <a href="#sql_debug" class="ajax-modal"><?php echo $core->db->query_count; ?></a>
                        </span>
                        <span class="item">
                            Cache: <?php echo cmsCache::getInstance()->query_count; ?></a>
                        </span>
                        <span class="item">
                            Mem: <?php echo round(memory_get_usage()/1024/1024, 2); ?> Mb
                        </span>
                    <?php } ?>
                </li>
                <li id="nav">
                    <?php $this->widgets('footer', false, 'wrapper_plain'); ?>
                </li>
            </ul>
        </footer>

    </div>

</body>
</html>
