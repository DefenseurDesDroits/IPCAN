<?php
//heritage du css du thème
function wpm_enqueue_styles(){
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
//Création d'un menu au bas du site
add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles' );

register_nav_menus( array(
        'Bottom' => 'menu_bottom',
    ) );


show_admin_bar(false);


// Création d'un filtre pour enlever le blocs commentaire
add_filter('comments_open', 'wpc_comments_closed', 10, 2);

function wpc_comments_closed( $open, $post_id ) {
	$post = get_post( $post_id );
	if ('post' == $post->post_type)
		$open = false;
	return $open;
}

// add css body
add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {

		if ( is_page_template('template-membres.php')) {
				$classes[] = 'members';
		}
		if ( is_page_template('template-actualites.php') ) {
				$classes[] = 'news';
		}
		if ( is_page_template( 'template-publications.php' ) ) {
				$classes[] = 'news publish';
		}
		if ( is_page_template( 'page.php' ) ) {
				$classes[] = 'global news';
		}
    return $classes;
}

function pn_body_class_add_categories( $classes ) {

	// Only proceed if we're on a single post page
	if ( !is_single() )
		return $classes;

	// Get the categories that are assigned to this post
	$post_categories = get_the_category();

	// Loop over each category in the $categories array
	foreach( $post_categories as $current_category ) {

		// Add the current category's slug to the $body_classes array
		$classes[] = 'category-' . $current_category->slug;

	}

	// Finally, return the $body_classes array
	return $classes;
}
add_filter( 'body_class', 'pn_body_class_add_categories' );

// enqueue javascript
function theme_js(){
wp_enqueue_script( 'main-min',
get_template_directory_uri() . '/scripts/main.min.js',
array() );
wp_enqueue_script( 'jquery-ui',
get_template_directory_uri() . '/scripts/vendor/jquery-ui.js',
array() );
}
add_action( 'wp_footer', 'theme_js' );

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function mdGetPublicationURL($url) {
	$uri   = $url;
	$uri   = preg_replace('#^/#', '', $uri);
	$uri   = preg_replace('#/$#', '', $uri);
	$uris  = preg_split('#/#', $uri);
	$uris2 = preg_split('#/#', $uri);
	if($uris[0] == 'fr')array_shift ($uris);
	if(count($uris) == 2) {
		$slug = $uris[1];

		$cat = get_category_by_slug( $slug );
		$catId = $cat->cat_ID;

		array_pop($uris2);

		$url = '/'.join('/', $uris2).'?search=&category='.$catId.'&date=';
		return $url;
	}
	return false;
}

function md_bcn_display($publication=false) {
	$fr = (pll_current_language() == 'en') ? false : true;
	$tmp = bcn_display(true);
	if(preg_match_all('/href="([^"]+)"/', $tmp, $match)) {
		foreach($match[0] AS $idx => $href) {
			$goodUrl = $href;
			$goodUrl = preg_replace('#/./#', '/', $goodUrl);
			if(($idx == 0) && ($fr)) {
				$goodUrl = preg_replace('#"$#', '/fr/"', $goodUrl);
			}
			$tmp = preg_replace('#'.$href.'#', $goodUrl, $tmp);
		}
	}
	if($publication) {
		if(preg_match_all('/href="([^"]+)"/', $tmp, $match)) {
			$href = array_pop( $match[0] );
			$url  = array_pop( $match[1] );
			$url  = preg_split( '#' . $_SERVER['HTTP_HOST'] . '#', $url );
			$url  = $url[0] . $_SERVER['HTTP_HOST'] . mdGetPublicationURL( $url[1] );
			$tmp  = preg_replace( '#' . $href . '#', 'href="' . $url . '""', $tmp );
		}
	}

	echo($tmp);
}
