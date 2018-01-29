
<?php //blog post type
add_action('init', 'create_blog', 0);

function create_blog() {
    $labels = array(
        'name' => _x('Blogs', 'post type general name'),
        'singular_name' => _x('Blog', 'post type singular name'),
        'add_new' => _x('Add Blog', 'Event'),
        'add_new_item' => __('Add Blog'),
        'edit_item' => __('Edit Blog'),
        'new_item' => __('New Blog'),
        'view_item' => __('View Blog'),
        'search_items' => __('Search Blog'),
        'not_found' => __('No Blog found'),
        'not_found_in_trash' => __('No Blog found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'blog','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
    );

    //Register the blog post type.
    register_post_type('blog', $args);
    register_taxonomy("blogs_cat", "blog", array("hierarchical" => true,
        "label" => "Blog Categories",
        "singular_label" => "Blog",
        'rewrite' => array('slug' => 'blog','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}