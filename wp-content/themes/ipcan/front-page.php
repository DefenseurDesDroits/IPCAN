<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

	<section class="main-slider single-item">

		<?php

		$catName = (pll_current_language() == 'en') ? 'slider' : 'presentations';
		$slider = new WP_Query(array('category_name'=>$catName));
		while ( $slider->have_posts() ) : $slider->the_post();

		?>

		<div class="item" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 ">
						<p class="color--white"><?php the_title(); ?></p>
					</div>
				</div>
			</div>
		</div>

		<?php
		endwhile;
		wp_reset_query();
		?>
	</section>

	<?php
	$catName = (pll_current_language() == 'en') ? 'about' : 'apropos';
	$about = new WP_Query(array('category_name'=>$catName));
	while ( $about->have_posts() ) : $about->the_post();
	?>
	<section class="section whoareyou">

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<h2 class="color--blue centered"><?php the_title(); ?></h2>
					<?php the_content(); ?>

				</div>
			</div>
		</div>

	</section>

	<?php endwhile; wp_reset_query(); ?>


	<?php
	$catSlug = (pll_current_language() == 'en') ? 'map' : 'carte';
	$about = new WP_Query(array('category_name'=>$catSlug));
	while ( $about->have_posts() ) : $about->the_post();
	?>

	<section class="section reseau">

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">

					<h2 class="color--blue"><?php the_title(); ?></h2>
					<p><?php the_content(); ?></p>

				</div>
				<div class="col-md-6 col-sm-6 rightbanner desktop">
					<?php echo the_post_thumbnail( array(522, 426), array( 'class' => 'desktop' ) ); ?>
				</div>
			</div>
		</div>

		<div class="full">
			<?php echo the_post_thumbnail( array(759, 674), array( 'class' => 'mobile' ) ); ?>
		</div>

	</section>

	<?php endwhile; wp_reset_query(); ?>


<section class="section actualites clearfix">

	<?php
	$catSlug = (pll_current_language() == 'en') ? 'news' : 'actualites';
	$news = new WP_Query(array('category_name'=>$catSlug));


	$titleSection = get_category_by_slug($catSlug);
	
	?>

	<h2 class="color--blue centered"><?php echo $titleSection->name;?></h2>
	<div class="container">
		<div class="slider-news list-news">

			<?php 
			while ( $news->have_posts() ) : $news->the_post();

			$temps_lecture = '03';
			if(get_post_custom_values('temps_lecture')[0]){
				$temps_lecture = get_post_custom_values('temps_lecture')[0];
			}

			$read_label = 'LIRE LA SUITE';

			if(pll_current_language() == 'en'){
				$read_label = "READ MORE";
			}

			?>
			<div class="item">

				<a href="<?php the_permalink() ?>">
					<?php echo the_post_thumbnail( array(300, 200), array( 'class' => 'visuel' ) ); ?>
				</a>

				<div class="txt clearfix">

					<div class="pull-left g-wide--3 g-medium--half g--last">
						<p class="date"><?php the_time('D j M Y'); ?></p>
					</div>

					<div class="pull-right g-wide--1 g-wide--last g-medium--half g--last">

						<p class="time">
							<img class="pull-left" src="/wp-content/themes/ipcan/images/icon_time.png" alt="" />
							<span class="pull-left"><strong><?php echo $temps_lecture; ?></strong> min</span>
						</p>

					</div>

				</div>

				<h3 class="text">
				<a class="cta--primary" href="<?php the_permalink() ?>"><?php the_title(); ?> </a>
				</h3>

				<a class="cta--secondary" href="<?php the_permalink() ?>"><?php echo $read_label; ?></a>

			</div>

			<?php endwhile; wp_reset_query(); ?>

		</div>
	</div>
</section>

<p>&nbsp;</p>

</div>

<?php get_footer(); ?>