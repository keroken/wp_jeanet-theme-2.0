<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8" />
		<title><?php apt_simple_title(); ?></title>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
		
        <?php wp_enqueue_script('jquery'); ?>

    <!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);
mixpanel.init("b54d47f382f255e86d643eb2beaa7c5c");</script><!-- end Mixpanel -->

    <?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
        <script type="text/javascript">mixpanel.track("view page");</script>
            
			<div id="header" role="banner">
			<div id="fixed-box">
				<div class="inner clearfix">
					<p id="site_description"><?php bloginfo('description'); ?></p>
					<<?php apt_site_id(); ?> class="site-id">
						<a href="<?php echo home_url('/'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/site_id.png" width="560" height="45" alt="<?php bloginfo('description'); ?>" /></a>
					</<?php apt_site_id(); ?>>

					<div class="utility">
                            <?php
                                wp_nav_menu(array(
                                    'container' => false,
                                    'theme_location' => 'place_pc_utility',
                                ));
                            ?>
						<div id="search" role="search">
                            <?php echo get_search_form(); ?>
                        </div><!-- #search end -->
                    </div><!-- .utility end -->
                </div><!-- .inner end -->

                    <?php
                        add_filter('nav_menu_css_class', 'apt_slug_nav', 10, 2);
                        wp_nav_menu(array(
                            'container' => 'div',
                            'container_id' => 'global_nav',
                            'theme_location' => 'place_pc_global',
                            'depth' => 3,
                        ));
                        remove_filter('nav_menu_css_class', 'apt_slug_nav');
                    ?>

                    <?php /*
                        if (!is_front_page()) :
                        if (class_exists ( 'WP_SiteManager_bread_crumb')) :
                            WP_SiteManager_bread_crumb::bread_crumb('navi_element=div&elm_id=bread_crumb');
                        endif;
                        endif; */
                    ?>

                </div><!-- #fixed-box end -->

			</div><!-- #header end -->
    <div id="wrap">
                    <div id="slider">
                    <?php
                        echo( do_shortcode("[metaslider id=865]"));
                    ?>
                    </div><!-- #slider end -->
