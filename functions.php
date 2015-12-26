<?php

// カスタムメニュー
register_nav_menus(
  array(
    'place_pc_global' => 'PCグローバル',
    'place_sp_global' => 'SPグローバル',
    'place_pc_utility' => 'PCユーティリティ',
    'place_sp_utility' => 'SPユーティリティ',
    'place_pc_side' => 'PCサイド',
  )   
);

// wp_nav_menuにslugのクラス属性を追加する。
function apt_slug_nav($css, $item) {
  if ($item->object == 'page') {
    $page = get_post($item->object_id);
    $css[] = 'menu-item-slug-' . esc_attr($page->post_name);
  }
  return $css;
}

// 最上位の固定ページ情報を取得する。
function apt_page_ancestor() {
  global $post;
  $anc = array_pop(get_post_ancestors($post));
  $obj = new stdClass;
  if ($anc) {
    $obj->ID = $anc;
    $obj->post_title = get_post($anc)->post_title;
  } else {
    $obj->ID = $post->ID;
    $obj->post_title = $post->post_title;
  }
  return $obj;
}

// カテゴリIDを取得する。
function apt_category_id($tax='category') {
  global $post;
  $cat_id = 0;
  if (is_single()) {
    $cat_info = get_the_terms($post->ID, $tax);
    if ($cat_info) {
      $cat_id = array_shift($cat_info)->term_id;
    }
  }
  return $cat_id;  
}

// カテゴリ情報を取得する。
function apt_category_info($tax='category') {
  global $post;
  $cat = get_the_terms($post->ID, $tax);
  $obj = new stdClass;
  if ($cat) {
    $cat = array_shift($cat);
    $obj->name = $cat->name;
    $obj->slug = $cat->slug;
  } else {
    $obj->name = '';
    $obj->slug = '';
  }
  return $obj;
}

// wp_list_pagesのクラス属性を変更する。
function apt_add_current($output) {
  global $post;
  $oid = "page-item-{$post->ID}";
  $cid = "$oid current_page_item";
  $output = preg_replace("/$oid/", $cid, $output);
  return $output;
}

// アイキャッチ画像を利用できるようにします。
add_theme_support('post-thumbnails');
set_post_thumbnail_size(208, 138, true);

// メディアのサイズを追加します。
add_image_size('main_image', 370);
add_image_size('tour-archive', 280);
add_image_size('sub_image', 150);

// タイトルタグのテキストを出力します。
function apt_simple_title() {
  if (!is_front_page()) {
    echo trim(wp_title('', false)) . " | ";
  } 
  bloginfo('name');
}

// サイトIDのタグをトップページとそれ以外で切り替えます。
function apt_site_id() {
  if (is_front_page()) {
    echo "h1";
  } else {
    echo "div";
  }
}

// 検索ワードが未入力または0の場合にsearch.phpをテンプレートとして使用する
function apt_search_redirect() {
  global $wp_query;
  $wp_query->is_search = true;
  $wp_query->is_home = false;
  if (file_exists(TEMPLATEPATH . '/search.php')) {
    include(TEMPLATEPATH . '/search.php');
  }
  exit;
}

if (isset($_GET['s']) && $_GET['s'] == false) {             
  add_action('template_redirect', 'apt_search_redirect');                                     
}

// サイドバーにwidgetを追加
register_sidebar(array(
     'name' => 'Sidebar_1' ,
     'id' => 'sidebar_1' ,
     'before_widget' => '<div class="widget">',
     'after_widget' => '</div>',
     'before_title' => '<h3>',
     'after_title' => '</h3>'
));

register_sidebar(array(
     'name' => 'Sidebar_2' ,
     'id' => 'sidebar_2' ,
     'before_widget' => '<div class="widget">',
     'after_widget' => '</div>',
     'before_title' => '<h3>',
     'after_title' => '</h3>'
));

register_sidebar(array(
     'name' => 'Sidebar_3' ,
     'id' => 'sidebar_3' ,
     'before_widget' => '<div class="widget">',
     'after_widget' => '</div>',
     'before_title' => '<h3>',
     'after_title' => '</h3>'
));

//set excertp length
function new_excerpt_mblength($length) {
		return 160;
}  
add_filter('excerpt_mblength', 'new_excerpt_mblength');


//「続きを読む」リンクを追加
function new_excerpt_more($post) {
return '<a href="'. get_permalink($post->ID) . '">' . '　...続きを読む' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');



//Custom CSS Widget
add_action('admin_menu', 'custom_css_hooks');
add_action('save_post', 'save_custom_css');
add_action('wp_head','insert_custom_css');
function custom_css_hooks() {
    add_meta_box('custom_css', '個別CSS', 'custom_css_input', 'post', 'normal', 'high');
    add_meta_box('custom_css', '個別CSS', 'custom_css_input', 'page', 'normal', 'high');
}
function custom_css_input() {
    global $post;
    echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
    echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}
function save_custom_css($post_id) {
    if (!wp_verify_nonce($_POST['custom_css_noncename'], 'custom-css')) return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    $custom_css = $_POST['custom_css'];
    update_post_meta($post_id, '_custom_css', $custom_css);
}
function insert_custom_css() {
    if (is_page() || is_single()) {
        if (have_posts()) : while (have_posts()) : the_post();
            if (get_post_meta(get_the_ID(), '_custom_css', true) !='') {
                echo "<style type=\"text/css\" media=\"all\">\n".get_post_meta(get_the_ID(), '_custom_css', true)."\n</style>\n";
        }
        endwhile; endif;
        rewind_posts();
    }
}

//Custom JavaScript Widget
add_action('admin_menu', 'custom_js_hooks');
add_action('save_post', 'save_custom_js');
add_action('wp_head','insert_custom_js');
function custom_js_hooks() {
    add_meta_box('custom_js', '個別JavaScript', 'custom_js_input', 'post', 'normal', 'high');
    add_meta_box('custom_js', '個別JavaScript', 'custom_js_input', 'page', 'normal', 'high');
}
function custom_js_input() {
    global $post;
    echo '<input type="hidden" name="custom_js_noncename" id="custom_js_noncename" value="'.wp_create_nonce('custom-js').'" />';
    echo '<textarea name="custom_js" id="custom_js" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_js',true).'</textarea>';
}
function save_custom_js($post_id) {
    if (!wp_verify_nonce($_POST['custom_js_noncename'], 'custom-js')) return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    $custom_js = $_POST['custom_js'];
    update_post_meta($post_id, '_custom_js', $custom_js);
}
function insert_custom_js() {
    if (is_page() || is_single()) {
        if (have_posts()) : while (have_posts()) : the_post();
            if (get_post_meta(get_the_ID(), '_custom_js', true) !='') {
                echo "<script type=\"text/javascript\">\n".get_post_meta(get_the_ID(), '_custom_js', true)."\n</script>\n";
            }
        endwhile; endif;
        rewind_posts();
    }
}

