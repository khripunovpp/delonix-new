<?php

function hide_admin_bar(){ return false; }
add_filter( 'show_admin_bar', 'hide_admin_bar' );

add_theme_support('post-thumbnails');
add_theme_support( 'menus' );

add_action( 'wp_enqueue_scripts', 'first_part_scripts' );
function first_part_scripts(){
    wp_enqueue_style( 'lightgallery', get_template_directory_uri() . '/css/lightgallery.min.css', array(), hash_file('crc32',  get_template_directory_uri() . '/css/lightgallery.min.css'));
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.min.css', array(), hash_file('crc32',  get_template_directory_uri() . '/css/slick.min.css'));
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), hash_file('crc32',  get_stylesheet_uri()));

    wp_enqueue_script('maskedinput', get_template_directory_uri() . '/js/jquery.maskedinput.min.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/jquery.maskedinput.min.js'), true);
    wp_enqueue_script('masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/masonry.pkgd.min.js'), true);

    wp_enqueue_script('common-main', get_template_directory_uri() . '/js/common.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/common.js'), true);

	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
	wp_enqueue_script( 'jquery' );
};

add_action( 'init', 'second_part_scripts' );
function second_part_scripts(){
    wp_register_script('lightgallery', get_template_directory_uri() . '/js/lightgallery.min.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/lightgallery.min.js'), true);
    wp_register_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/slick.min.js'), true);
    wp_register_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js'), true);
    wp_register_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/isotope.pkgd.min.js'), true);

    wp_register_script('portfolio', get_template_directory_uri() . '/js/portfolio.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/portfolio.js'), true);
    wp_register_script('map', get_template_directory_uri() . '/js/map.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/map.js'), true);
};

add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
    global $post;
    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }
    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));
    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';
    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }
    if (empty($attachments)) return '';
    foreach ($attachments as $id => $attachment) {
        $img = wp_get_attachment_image_src($id, 'full');
        $output .= "{$img[0]}|";
    }
    return $output;
}

function get_the_user_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters('wpb_get_ip', $ip);
}

//this creates the shortcode you can use in posts, pages and widgets
add_shortcode('show_user_ip', 'get_the_user_ip');

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
    foreach( $items as &$item ) {
        $bage = get_field('bage', $item);
        $class = get_field('class', $item);
        $classes = $item->classes;
        array_push($classes, $class);
        $item->classes = $classes;
        if( $bage ) $item->title .= ' <small class="fileType">.'.$bage.'</small>';
    }
    return $items;
}

add_action( 'init', 'true_register_post_type_init' );
 
function true_register_post_type_init() {
    $labels = array(
        'name' => 'Статьи',
        'singular_name' => 'Статья',
        'add_new' => 'Добавить статью',
        'add_new_item' => 'Добавить новую статью',
        'edit_item' => 'Редактировать статью',
        'new_item' => 'Новая статья',
        'all_items' => 'Все статьи',
        'view_item' => 'Просмотр статьи на сайте',
        'search_items' => 'Искать статьи',
        'not_found' =>  'Cтатей не найдено.',
        'not_found_in_trash' => 'В корзине нет статей.',
        'menu_name' => 'Статьи',
        'name_admin_bar' => 'Статьи'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true, 
        'menu_icon' => 'dashicons-admin-post', // иконка в меню
        'menu_position' => 5, // порядок в меню
        'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'taxonomies' => array('post_tag', 'category')
    );
    register_post_type('articles', $args);
}


add_action( 'init', 'cp_change_post_object' );
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = 'Услуги';
        $labels->singular_name = 'Услуга';
        $labels->add_new = 'Добавить услугу';
        $labels->add_new_item = 'Добавить новую услугу';
        $labels->edit_item = 'Редактировать услугу';
        $labels->new_item = 'Новая услуга';
        $labels->view_item = 'Просмотр услуги на сайте';
        $labels->search_items = 'Искать услугу';
        $labels->not_found = 'Услуг не найдено';
        $labels->not_found_in_trash = 'В корзине нет услуг';
        $labels->all_items = 'Все услуги';
        $labels->menu_name = 'Услуги';
        $labels->name_admin_bar = 'Услуги';
}
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
 
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'article' ) );
    return $query;
}

?>