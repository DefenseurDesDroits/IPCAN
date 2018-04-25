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
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>



<div id="wrapper" class="hfeed site">

	<?php if ( get_header_image() ) : ?>
	<div id="site-header">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
	</div>
	<?php endif; ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">

			<nav id="primary-navigation" class="site-navigation primary-navigation  navbar navbar-inverse" role="navigation" role="navigation">

				<div class="container">

					<div class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="desktop" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/logo.png"></a>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="mobile" width="104" height="70" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/logo@2x.png"></a>
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
									<!--ul id="primary-menu" class="nav-menu">
										<li id="" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-6 current_page_item menu-item-7">
											<a class="cta--nav active"  href="#">Acceuil</a>
										</li>
										<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
											<a class="cta--nav"  href="presentation.html">Présentation</a>
										</li>
										<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
											<a class="cta--nav" href="members.html">Membres</a>
										</li>
										<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
											<a class="cta--nav" href="events.html">Evènements</a>
										</li>
										<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
											<a class="cta--nav" href="publications.html">Publications</a>
										</li>
										<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
											<a class="cta--nav" href="news.html">actualités</a>
										</li>
								</ul-->

						</div><!-- /.navbar-collapse -->
					</div>
					</nav>

					<div id="search-container" class="search-box-wrapper clearfix hide">
					<div class="container">
						<div class="search-box">

							<?php get_search_form(); ?>

							<!--form role="search" method="get" class="search-form" action="#">
							<label class="control-label">
								<span class="screen-reader-text">Rechercher&nbsp;:</span>
								<input type="search" class="search-field" placeholder="Mots clés" value="" name="s" />
							</label>
							<input type="submit" class="search-submit button button--submit" value="OK" />
						</form-->

					</div>
				</div>
				</div>

			</div>

		</header><!-- #masthead -->




<main id="main" class="site-main main-container clearfix">
