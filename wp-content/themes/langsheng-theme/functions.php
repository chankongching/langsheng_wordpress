<?php

/*
  =-=-=-=
    LangSheng Base Functions
  =-=-=-=
*/

// Add Theme Support For Featured Images
add_theme_support('post-thumbnails');

// Add Theme Support For Menus
add_theme_support('menus');

// No More Wordpress Version On The Header
function wp_remove_version(){
	return '<!--This is LangSheng-->';
}
add_filter('the_generator', 'wp_remove_version');

// Remove Admin Bar At Front-End
show_admin_bar(false);

// Register Wordpress Menus
if (function_exists('register_nav_menus')){
	register_nav_menus(
		array(
			'header-menu' => 'Header Menu',
		)
	);
}

// Include Scripts and CSS on the wp_head and wp_footer hooks.
function frontend_enqueue_scripts() {

	wp_enqueue_style('bootstrap-css-min', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style('ion-icons', get_template_directory_uri() . '/css/ionicons.min.css');
	wp_enqueue_style('open-sans-google-font', get_template_directory_uri() . '/css/opensans-font.css');
	wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/custom-style.css');
	wp_enqueue_style('theme-style', get_stylesheet_uri());
	
	wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/html5shiv.js');
	wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
	wp_enqueue_script('respond-min', get_template_directory_uri() . '/js/respond.min.js');
	wp_script_add_data('respond-min', 'conditional', 'lt IE 9');

	wp_enqueue_script('bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array("jquery"), '3.6.6', true);
	wp_enqueue_script('jquery-easing-min', get_template_directory_uri() . '/js/jquery.easing.min.js', array("jquery"), '1.3', true);
	wp_enqueue_script('theme-custom-js', get_template_directory_uri() . '/js/custom.js', array("jquery"), '1.0.0', true);
	
}
add_action('wp_enqueue_scripts', 'frontend_enqueue_scripts');

// Admin CSS
function backend_enqueue_scripts() {
  wp_enqueue_style('admin-style', get_template_directory_uri().'/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'backend_enqueue_scripts');

// Add Theme Support For Using Bloginfo As Shotcode In Editor
function bloginfo_shortcode( $atts ) {
	extract( shortcode_atts( array("info" => ""), $atts ) );
	return get_bloginfo($info);
}
add_shortcode('blog', 'bloginfo_shortcode');

// Custom WPML Language Menu
function langsheng_custom_language_switcher() {
    $languages = apply_filters( 'wpml_active_languages', NULL, 'skip_missing=0&orderby=id&order=desc' );
    $finalHtml = "";
    if ( !empty( $languages ) ) {
        foreach( $languages as $lang ) {
        	switch($lang['language_code']){
				case "en"      : $languageDisplay = "EN"; break;
				case "zh-hans" : $languageDisplay = "中文"; break;
				default        : $languageDisplay = $lang['language_code'];
        	}
        	$finalHtml .= "<li>";
        	$finalHtml .= ( !$lang['active'] ) ? '<a href="' . $lang['url'] . '" class="langSwitcherLink">' : '<a href="javascript:;">' ;
        	$finalHtml .= $languageDisplay . "</a>";
        	$finalHtml .= "</li>" ;
        }
    }
    return $finalHtml;
}

// Make Sure To Always Return The Right Post ID
function langsheng_current_language_post_id ($id, $type = "post") {
	// Will return the right ID in the current language for object type (post, category, custom_post etc...)
	// If the translation is missing it will return the original ID
	return apply_filters('wpml_object_id', $id, $type, TRUE);
}

// Custom Read More for News
function custom_field_excerpt($text) {
	if ($text != "") {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$excerpt_length = 10; // 20 words
		$excerpt_more = apply_filters('excerpt_more', ' ' . '...');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', $text);
}

// Pagination Links
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

	if (empty($pagerange)) {
		$pagerange = 2;
	}

	global $paged;
	
	if (empty($paged)) {
		$paged = 1;
	}

	if ($numpages == '') {
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if(!$numpages) {
		    $numpages = 1;
		}
	}

	if(isset($_GET["lang"]) && $_GET["lang"]!=""){
		$originalLink = get_pagenum_link(1);
		$originalLink = str_replace ("?lang=".$_GET["lang"] , "" , $originalLink);
		$baseLink =  $originalLink . '%_%' . "?lang=".$_GET["lang"];
	} else {
		$baseLink = get_pagenum_link(1) . '%_%';
	}

	$pagination_args = array(
		'base'         => $baseLink,
		'format'       => 'page/%#%/',
		'total'        => $numpages,
		'current'      => $paged,
		'show_all'     => false,
		'end_size'     => 1,
		'mid_size'     => $pagerange,
		'prev_next'    => True,
		'prev_text'    => __(''),
		'next_text'    => __(''),
		'type'         => 'array',
		'add_args'     => false,
		'add_fragment' => '',
	);

	$paginate_links = paginate_links($pagination_args);

	if ($paginate_links) {
		echo '<div class="next-pages"><ul class="list-unstyled">';
			foreach($paginate_links as $link) {
				if(strpos($link, "prev") !== false || strpos($link, "next") !== false){
					echo '<li>' . $link . '</li>';
				}
			}
		echo '</ul></div>';
	}

}

?>