<?php
 add_action('init', 'create_careers', 0);

function create_careers() {
    $labels = array(
        'name' => _x('Careers', 'post type general name'),
        'singular_name' => _x('career', 'post type singular name'),
        'add_new' => _x('Add career', 'careers'),
        'add_new_item' => __('Add career'),
        'edit_item' => __('Edit career'),
        'new_item' => __('New career'),
        'view_item' => __('View careers'),
        'search_items' => __('Search career'),
        'not_found' => __('No careers found'),
        'not_found_in_trash' => __('No career found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'careers','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('careers', $args);
    register_taxonomy("careers_categories", "careers", array("hierarchical" => true,
        "label" => "career Categories",
        "singular_label" => "careers",
        'rewrite' => array('slug' => 'careers','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>