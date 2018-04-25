<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

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

<!-- actualite detail-->
<section class="section news-article clearfix">

    <div class="container">
        <div class="row">
            <h1 class="color--blue centered"><?php the_title();?></h1>

            <div class="post-content col-md-12">
		        <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
