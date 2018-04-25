<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 *
 * @package WordPress
 * @subpackage ipcan
 */
get_header();
?>
<?php
if ( is_search() ) : get_template_part( 'search', 'result' );
else : ?>
    <div id="main-content" class="main-content">

        <div id="primary" class="content-area">

            <div id="content" class="site-content content-type_<?php echo get_post_type(); ?>" role="main">


				<?php
				if( ( is_home() || is_front_page() ) && have_posts() ){

					//var_dump(have_posts());
					while ( have_posts() ) : the_post();
						get_template_part( 'front', 'page' );
					endwhile;

				}

				else if ( have_posts() ) {
					while ( have_posts() ) : the_post();

						get_template_part( 'single', get_post_type() );

					endwhile;
				}

				else{
					get_template_part( '', '404' );
				}
				?>

            </div><!-- #content -->

        </div>

    </div><!-- #main-content -->

<?php endif; ?>

<?php get_footer(); ?>
