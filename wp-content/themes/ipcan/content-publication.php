<?php
/**
Post template : Template d'un publication
*
*/
get_header();
echo get_page_template_slug();
?>

<div class="breadcrumb news-article">
  <div class="container">
    <?php
    if(function_exists('md_bcn_display'))
    {
	    md_bcn_display(true);
    }
    ?>
    </div>
</div>
			<!-- actualite detail-->
			<section class="section news-article clearfix">

					<div class="container">
						<div class="row">


							<?php while(have_posts() ): the_post(); ?>

								<h1 class="color--blue centered"><?php the_title();?></h1>

								<p class="date"><?php the_time('D j M Y'); ?></p>

								<div class="keywords"><?php the_tags('<em>MOTS CLEFS : </em> ',' , '); ?></div>

								<?php the_content(); ?>

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


								<!--<?php echo do_shortcode('[printfriendly]'); ?>-->

							<?php endwhile; ?>
									</div>
								</div>
						</section><!-- /.actualite detail-->



<?php get_footer() ?>
