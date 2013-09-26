<?php
/*
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . DIRECTORY_SEPARATOR . 'library' );
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();*/

if( !is_admin()){
    wp_deregister_script('jquery');
    // wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"), false, '1.3.2');
    wp_register_script('jquery', '', false);
    wp_enqueue_script('jquery');
}

// Add options (customFields) menu
if(function_exists("register_options_page"))
{
    register_options_page('Banner');
    register_options_page('Compra VIP');
    register_options_page('Seguradoras');
 }

function setContactToken () {
    $token = md5(uniqid(microtime(), true));

    $_SESSION['contact_token'] = $token;

    return $token;
}

function is_array_empty ($arr) {
	if (is_array($arr)) {
		foreach ($arr AS $key => $value){
			if (!empty($value) || $value != NULL || $value != ""){
				return true;
				break;//stop the process we have seen that at least 1 of the array has value so its not empty
			}
		}
		return false;
	}
}


function get_ids_from_slugs ($slugs) {

  $slugs = preg_split("/,s?/", $slugs);
  $ids = array();

  foreach ($slugs as $page_slug) {
    $page = get_page_by_path($page_slug);
    array_push($ids, $page->ID);
  }

  return implode(",", $ids);

}

function cExcerpt ($post_or_id, $sizeExcerpt = 25 , $excerpt_more = ' [...]') {
        if ( is_object( $post_or_id ) ) $postObj = $post_or_id;
        else $postObj = get_post($post_or_id);

        $raw_excerpt = $text = $postObj->post_excerpt;
        if ( '' == $text ) {
            $text = $postObj->post_content;

            $text = strip_shortcodes( $text );

            $text = apply_filters('the_content', $text);
            $text = str_replace(']]>', ']]&gt;', $text);
            $text = strip_tags($text);
            $excerpt_length = apply_filters('excerpt_length', $sizeExcerpt);

            // don't automatically assume we will be using the global "read more" link provided by the theme
            // $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
            $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
            if ( count($words) > $excerpt_length ) {
                array_pop($words);
                $text = implode(' ', $words);
                $text = $text . $excerpt_more;
            } else {
                $text = implode(' ', $words);
            }
        }
        return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
    }

function cExcerptPhrase ($phrase, $sizeExcerpt = 25 , $excerpt_more = ' [...]') {
    $text = $phrase;

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', $sizeExcerpt);

    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }
    return $text;
}


// Adicionar Excerpt no Page.php
add_post_type_support( 'page', 'excerpt' );

// Excerpt
function excerpt ($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','...',$excerpt);
	return $excerpt;
}

function getCurrentCatID($post='') {
    global $wp_query;
    
    if( is_category()  ) {
        $cat_ID = get_query_var('cat');
       
    } else {
        $dd = get_the_category(get_the_ID());
        $cat_ID = $dd[0]->term_id;
    }

    return $cat_ID;
}
function makeBreadcrumb() {
    global $wp_query;
    
    $id = 0;
    $tmp = '<a href="{URL}" title="{TITLE}">{NAME}</a>';
    $replaced = array();
    $replace = array(
                '{URL}',
                '{TITLE}',
                '{NAME}',
            );
    // Generate link for CATEGORY
    if (is_category()) {
        $id = getCurrentCatID();
        $category = get_the_category($id);
        $replaced = array(
                get_category_link($id),
                get_the_category_by_ID( $id ),
                get_the_category_by_ID( $id ),
            );
    
    // Generate link for POST/PAGE
    } else {
        $id = getCurrentID();
        $replaced = array(
                get_permalink($id),
                get_the_title(),
                get_the_title()
            );
    }

    // Replace the content in $tmp
    $tmp = str_replace($replace, $replaced, $tmp);

    return $tmp;
}
function getCurrentID($post='') {
    global $wp_query;

    return get_the_ID();
}

function getCategoryNiceName ( $cat_id ) {
    $cat = get_category($cat_id);
    $category_nicename = $cat->category_nicename;
    return $category_nicename;
}

/*
    This method return VIDEO URL, already for embed
    @param $data - Array with   /site -> youtube, vimeo ...
                                /url -> --
*/
function putVideo ($data) {
    if ($data['site'] == 'youtube') {
        preg_match('/(\?v=|\/\d\/|\/embed\/|\/v\/|\.be\/)([a-zA-Z0-9\-\_]+)/', $data['url'], $url);
        return "http://www.youtube.com/embed/".$url[2];
    }
    elseif ($data['site'] == 'vimeo') {
        preg_match('/(\d{4,10}+)/', $data['url'], $url);
        return "http://player.vimeo.com/video/".$url[0];
    }
}



function pagination_funtion($total = '') {

global $wp_query;
if ($total=='')
    $total = $wp_query->max_num_pages;
                    
if ( $total > 1 )  {
    if ( !$current_page = get_query_var('paged') )
        $current_page = 1;
                            
        $big = 999999999;

        $permalink_structure = get_option('permalink_structure');
        $format = empty( $permalink_structure ) ? '&page=%#%' : 'page/%#%/';
        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => $format,
            'current' => $current_page,
            'total' => $total,
            'mid_size' => 4,
            'type' => 'plain'
        ));
    }

}


// Arquivo Single
add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) return TEMPLATEPATH . "/single-{$cat->term_id}.php"; } return $t;' ));
add_theme_support('post-thumbnails');
// Imagem Destaque
add_theme_support('post-thumbnails');
// add_image_size('destac_monte', 557, 348, true);

// Menu
/*add_action( 'init', 'register_my_menus' );
function register_my_menus() {
		register_nav_menus(
		array(
		'nav' => __( 'Menu' )
		)
		);
}
*/
