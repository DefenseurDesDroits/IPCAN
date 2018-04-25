<?php
/*
Template Name: Template actualité
*/
get_header();

?>

<div class="breadcrumb">
  <div class="container">
    <?php
    if(function_exists('md_bcn_display'))
    {
	    md_bcn_display();
    }
    ?>
    </div>
</div>
<?php
$read_label = 'LIRE LA SUITE';
$when_label = 'à';
$title = 'Actualités';

if(pll_current_language() == 'en'){
	$read_label = "READ MORE";
	$when_label = 'at';
	$title = 'News';
}

?>
<!-- actualites -->
<section class="section actualites clearfix">
	<h1 class="color--blue centered"><?php echo($title); ?></h1>
	<div class="container">

		<div class="list-news">

			<?php

                $catName = 'actualites';
                if(pll_current_language() == 'en'){
	                $catName = 'news';
                }

				$recentPosts = new WP_Query(array('category_name'=>$catName));
				foreach($recentPosts->posts as $post){

				//Temps de lecture
				$temps_lecture = '03';
				if(get_post_custom_values('temps_lecture')[0]){
					$temps_lecture = get_post_custom_values('temps_lecture')[0];
				}



			?>
				<div class="item g--half g--half-last g--third g--last">
					<a href="<?php the_permalink() ?>">
						<?php echo the_post_thumbnail( array(300, 200), array( 'class' => 'visuel mini_pic' ) ); ?>
						<span class="overlay"></span>
					</a>
						<div class="txt clearfix">
							<div class="pull-left g-wide--3 g-medium--2 g-medium--last g--last">
									<p class="date"><?php the_time('D j M Y'); ?></p>
							</div>
							<div class="pull-right g-wide--1 g-medium--1 g-medium--last g--last">
									<p class="time">
										<img class="pull-left" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/icon_time.png" alt="">
										<span class="pull-left"><strong><?php echo $temps_lecture; ?></strong> min</span>
									</p>
							</div>
						</div>
						<h2 class="text"><a href="<?php the_permalink() ?>" class="cta--primary"><?php echo $post->post_title; ?> </a></h2>
						<a href="<?php the_permalink() ?>" class="cta--secondary"><?php echo $read_label; ?></a>
				</div>

			<?php } ?>

		</div><!-- /. news -->

	</div>
</section><!-- /.actualites-->


<?php
get_footer();
?>
