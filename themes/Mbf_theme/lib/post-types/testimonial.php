<?php
 add_action('init', 'create_testimonial', 0);

function create_testimonial() {
    $labels = array(
        'name' => _x('Testimonials', 'post type general name'),
        'singular_name' => _x('testimonial', 'post type singular name'),
        'add_new' => _x('Add testimonial', 'testimonial'),
        'add_new_item' => __('Add testimonial'),
        'edit_item' => __('Edit testimonial'),
        'new_item' => __('New testimonial'),
        'view_item' => __('View testimonial'),
        'search_items' => __('Search testimonial'),
        'not_found' => __('No testimonial found'),
        'not_found_in_trash' => __('No testimonial found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'testimonial','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('testimonial', $args);
    register_taxonomy("testimonial_categories", "testimonial", array("hierarchical" => true,
        "label" => "Testimonial Categories",
        "singular_label" => "Blog",
        'rewrite' => array('slug' => 'Blog','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>