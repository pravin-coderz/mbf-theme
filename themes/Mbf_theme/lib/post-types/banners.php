<?php
add_action('init', 'create_banners', 0);

function create_banners() {
    $labels = array(
        'name' => _x('Banner', 'post type general name'),
        'singular_name' => _x('Banner', 'post type singular name'),
        'add_new' => _x('Add Banner', 'Banners'),
        'add_new_item' => __('Add Banner'),
        'edit_item' => __('Edit Banner'),
        'new_item' => __('New Banner'),
        'view_item' => __('View Banners'),
        'search_items' => __('Search Banners'),
        'not_found' => __('No Banners found'),
        'not_found_in_trash' => __('No Banners found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'banners','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 2,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );
    register_post_type('banners', $args);
    register_taxonomy("banners_cat", "banners", array("hierarchical" => true,
        "label" => "Banner Categories",
        "singular_label" => "Banner",
        'rewrite' => array('slug' => 'banner','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}