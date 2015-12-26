<?php dynamic_sidebar(sidebar_1); ?>

<h3>サブメニュー</h3>
<?php
    add_filter('nav_menu_css_class', 'apt_slug_nav', 10, 2);

    wp_nav_menu(array(
        'container' => 'div',
        'container_class' => 'side_nav',
        'theme_location' => 'place_pc_side',
        'depth' => 3,
    ));

    remove_filter('nav_menu_css_class', 'apt_slug_nav');
?>


