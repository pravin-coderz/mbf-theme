<?php
if (!defined('TMPL_URL'))
{
	define('TMPL_URL', get_template_directory_uri());
}
add_action('init', 'init_custom_load');

function init_custom_load(){
	if(is_admin()) {
		wp_enqueue_style('admin_css', TMPL_URL.'/lib/css/admin_css.css', false, '1.0', 'all');
		wp_enqueue_style('font-awesome.min', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
		wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		wp_enqueue_script('admin_js', TMPL_URL.'/js/lib/admin.js', false, '1.0', 'all');
    }
}
show_admin_bar(false);
/******
For post type:admin-config
******/
require_once(TEMPLATEPATH . "/lib/admin-config.php");

	/*******
Menu Backend
*******/
add_theme_support( 'menus' );

/********
Featured Image
********/
add_theme_support('post-thumbnails');

/*	Multipost Thumbnail Image */
if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(array(
		'label' => 'Secondary Image',
		'id' => 'imageBanner',
		'post_type' => 'banners'
		)
	);
}

/*For Excerpt*/
add_post_type_support('page', 'excerpt');

/*******
For empty paragraph
*******/
function shortcode_empty_paragraph_fix_tag($content) {
	$array = array(
		'<p>[' => '[',
		']</p>' => ']',
		'<p></p>' => '',
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
/*****
 For short codes
*****/
function figure( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<figure class="content-image">'.do_shortcode($content).'</figure>';
}
add_shortcode('figure', 'figure');

function figcaption( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<figcaption>'.do_shortcode($content).'</figcaption>';
}
add_shortcode('figcaption', 'figcaption');

function eleven_column( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-11 intro-content">'.do_shortcode($content).'</div>';
}
add_shortcode('eleven_column', 'eleven_column');

function image_container( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<figure class="content-image">'.do_shortcode($content).'</figure>';
}
add_shortcode('image_container', 'image_container');

function span( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<span class="infotag">'.do_shortcode($content).'</span>';
}
add_shortcode('span', 'span');

function buttons( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="dbl-button">'.do_shortcode($content).'</div>';
}
add_shortcode('buttons', 'buttons');

/* end shortcode */


add_theme_support('widgets');

?>