<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage ipcan
 */
global $post;
$category = get_the_category();
$post_slug = $post->post_name;


//var_dump($category);exit();


get_header();

if(have_posts()){

	if(($category[0]->slug == 'actualites') || ($category[0]->slug == 'news')){
		get_template_part('content','article');
		exit();
	}
	if(($category[0]->slug == 'publications-fr') || ($category[0]->slug == 'publications') || ($category[0]->category_parent == 62) || ($category[0]->category_parent == 31)){

		get_template_part('content','publication');
		exit();
	}
	if(($category[0]->slug == 'membres') || ($category[0]->slug == 'members')){
		get_template_part('content','membre');
		exit();
	}

}

?>


	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<div class="breadcrumb news-article">
			  <div class="container">
			    <?php
			    if(function_exists('md_bcn_display'))
			    {
				    md_bcn_display();
			    }
			    ?>
			    </div>
			</div>

			<!-- template aticle-->
			<section class="section news-article clearfix">

					<div class="container">
						<?php
							// Start the Loop.

							while ( have_posts() ) : the_post();

								get_template_part( 'content', get_post_format() );


							endwhile;
						?>
		</div><!-- #content -->
	</div><!-- #primary -->


<?php
get_footer();
?>
