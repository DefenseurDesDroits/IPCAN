<?php
/**
Post template : Template d'un publication
*
*/
get_header();
?>

<div class="breadcrumb news-article">
  <div class="container">
    <?php
    if(function_exists('bcn_display'))
    {
        bcn_display();
    }
    ?>
    </div>
</div>


      <!-- actualite detail-->
      <section class="section news-article clearfix">

          <div class="container">
            <div class="row">

							<?php

								while ( have_posts() ) : the_post();?>

							<h1 id="title" class="color--blue centered">
								 <?php the_title(); ?>
							</h1>

							<p class="date"><?php the_time('D j M Y'); ?></p>

							<div class="post-content col-md-12">
								<?php echo the_post_thumbnail( array(800, 450), array('id' => 'pic_post' ) ); ?>
								<?php the_content(); ?>								
							</div>

	            <?php
	            $shareTitle = the_title('', '', false);
	            $shareUrl = urlencode(getCurrentURL());
	            ?>

							<div class="social-links">
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareUrl;?>&t=<?php echo $shareTitle;?>&v=3" target="_blank"><img class="pull-left" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/picto-facebook.png" alt="Facebook"></a>
								<a href="https://twitter.com/intent/tweet?text=<?php echo $shareTitle;?> <?php echo $shareUrl;?>" target="_blank"><img class="pull-left" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/picto-tw.png" alt="Twitter"></a>
								<a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url=<?php echo $shareUrl;?>&title=<?php echo $shareTitle;?>" target="_blank"><img class="pull-left" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/picto-lnk.png" alt="Linkedin"></a>
								<a href="mailto: ?subject=<?php echo $shareTitle;?>&body=<?php echo $shareUrl;?>"><img class="pull-left" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/picto-mail.png" alt="Mail"></a>
								<!--<a href="https://plus.google.com/share?url=" target="_blank"><img class="pull-left" src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/images/picto-gplus.png" alt="Google plus"></a>//-->
							</div>
						</div>
					</div>
			</section><!-- /.actualite detail-->

			<section class="section similar-articles actualites clearfix">

				<h2 class="color--blue centered">
                    <?php
                    $sameArticle = 'Articles similaires';

                    if(pll_current_language() == 'en'){
	                    $sameArticle = "Similars  articles";
                    }
                    echo($sameArticle);
                    ?>
				</h2>

				<div class="container">

					<div class="list-news">

						<?php
							$post_id = get_the_ID();

							$recentPosts = new WP_Query(array('category_name'=>'actualites', 'orderby' => 'date', 'order'   => 'DESC', 'post__not_in' => array($post_id)));
							foreach($recentPosts->posts as $post){

							//Temps de lecture
							$temps_lecture = '03';
							if(get_post_custom_values('temps_lecture')[0]){
								$temps_lecture = get_post_custom_values('temps_lecture')[0];
							}

							$read_label = 'LIRE LA SUITE';

							if(pll_current_language() == 'en'){
								$read_label = "READ MORE";
							}

						?>
							<div class="item g--half g--half-last g--third g--last">
								<a href="<?php the_permalink() ?>">
									<?php echo the_post_thumbnail( array(300, 150), array( 'class' => 'visuel mini_pic' ) ); ?>
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
									<h3 class="text">

<?php
$categories = get_the_category( $post->ID );
$caregorie = '';
if(count($categories) > 0) {
    $categorie = $categories[0];
	$categorie = $categorie->name . '<br />';
}
echo($categorie);
?>
                    <a href="<?php the_permalink() ?>" class="cta--primary"><?php echo $post->post_title; ?> </a>
                  </h3>
									<a href="<?php the_permalink() ?>" class="cta--secondary"><?php echo $read_label; ?></a>
							</div>

						<?php } ?>

					</div>

				</div>

			</section>

			<?php
			endwhile;
		?>







<?php
get_footer();
?>
