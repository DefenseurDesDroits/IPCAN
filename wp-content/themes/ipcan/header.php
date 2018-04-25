<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

    <?php
        
        if(pll_current_language() == 'fr'){
	        $cookieText    = "Ce site utilise des cookies à des fins statistiques.";
					$cookieDismiss = "Accepter";
					$cookieDeny    = "Refuser";
					$cookieLink    = "En savoir plus.";
					$cookieURL     = "/mentions-legales";
        }else{
					$cookieText    = "This website uses cookies for statistical perspectives.";
	        $cookieDismiss = "Accept";
	        $cookieDeny    = "Refuse";
	        $cookieLink    = "Read more.";
	        $cookieURL     = "/legal";
				}

    ?>

	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
	<script>
	window.addEventListener("load", function(){
	window.cookieconsent.initialise({
	  "palette": {
	    "popup": {
	      "background": "#edeff5",
	      "text": "#838391"
	    },
	    "button": {
	      "background": "#4b81e8"
	    }
	  },
	  "theme": "classic",
	  "position": "top",
	  "type": "opt-out",
	  "content": {
	    "message": "<?php echo($cookieText); ?>",
	    "dismiss": "<?php echo($cookieDismiss); ?>",
	    "deny": "<?php echo($cookieDeny); ?>",
	    "link": "<?php echo($cookieLink); ?>",
        "href": '<?php echo($cookieURL); ?>'
	  },
        onInitialise: function(status) {
            if(status == 'dismiss') {
                dismissCookies();
            }
        },
      onStatusChange: function(status, chosenBefore) {
        if(status == 'dismiss') {
            dismissCookies();
        }
      }
	})});
	</script>

</head>

<body data-<?php language_attributes(); ?> <?php body_class(); ?>>


<!--
	<?php if ( get_header_image() ) : ?>
	<div id="site-header">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
	</div>
	<?php endif; ?>
-->

<!--<section id="cookies_banner" class="cookies-banner">
<span class="banner-txt"> En poursuivant votre navigation sur ce site, vous acceptez l'utilisation de cookies pour vous proposer des services et offres adaptés à vos centres d'intérêts. </span>
<span id="cookies_banner_close" class="icon icon-cancel"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/cross.png" alt=""></span>
</section>//-->

	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">

			<nav id="primary-navigation" class="site-navigation primary-navigation  navbar navbar-inverse" role="navigation" role="navigation">

				<div class="container">
					
					<div class="site-title">
						<?php
                        $isHome = false;
                        if(in_array(get_the_ID(), array(6, 135))) $isHome=true;

                        if ($isHome) {?><h1><?php }?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="desktop" alt="IPCAN - Independent police complaints authoritie's network" src="<?php header_image(); ?>"></a>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="mobile" alt="IPCAN - Independent police complaints authoritie's network" width="104" height="70" src="<?php header_image(); ?>"></a>
							<span class="hidden">IPCAN - Independent police complaints authoritie's network</span>
							<?php if ($isHome) {?></h1><?php }?>
					</div>

					<div class="navbar-header">
						<div class="search-toggle">
							<a href="#search-container" class="screen-reader-text" aria-expanded="false" aria-controls="search-container">
								<img class="desktop" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/icon_search_off.png" alt="">
								<img class="mobile" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/icon_search@2x.png" wisth="23" height="23" alt="">
							</a>
						</div>
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
									<span class="sr-only"></span>
									<!--span class="close"><img src="images/icon_close@2x.png" width="18" height="18"></span-->
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
							</button>
					</div>


						<div class="collapse navbar-collapse" id="navbar-collapse-1">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
						</div>
					</div>
					</nav>

					<div id="search-container" class="search-box-wrapper clearfix hide">
					<div class="container">
						<div class="search-box">
							<?php get_search_form(); ?>
					</div>
				</div>
				</div>

			</div>

		</header><!-- #masthead -->


<div id="wrapper" class="hfeed site">

<main id="main" class="site-main main-container clearfix">
