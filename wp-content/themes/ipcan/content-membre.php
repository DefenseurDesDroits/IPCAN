<?php
/**
* Post Template: Template page d'un membre
*/
get_header();
?>

<div class="breadcrumb member-article">
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
      <section class="section member-article clearfix">

          <div class="container">
              <div class="row">

                <div class="post-content col-md-12">
                <?php
                  while ( have_posts() ) : the_post();?>

                    <?php echo the_post_thumbnail( array(800, 450), array( 'id' => 'membre-pic' ) ); ?>

                    <p class="country"><?php the_tags('',' , '); ?></p>
                    <h1 class="title centered">
                      <?php the_title(); ?>
                    </h1>

                   <?php the_content(); ?>

                  <?php
                  endwhile;
                ?>


              </div>
            </div>
        </section><!-- /.member detail-->


              <?php

              $repId = get_post_custom_values('representant_id');

              if($repId){

              $args = array(
                  'post_type' => array( 'post' ),
                  'orderby' => 'ASC',
                  'post__in' => $repId
              );

              $loop = new WP_Query( $args );


              // Display connected pages
              if ( $loop->have_posts() ) :
              ?>

          <section class="section representants clearfix">

          <div class="container">

              <h2 class="sstitle">Les représentants</h2>
                <ul>
                  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                      <li class="inline-block">
                        <span class="clearfix team-image">
                          <?php echo the_post_thumbnail( array(165, 165) ); ?>
                        </span>
                        <h5><?php the_title(); ?></h5>

                          <?php the_content()?>

                      </li>

                  <?php endwhile; ?>
                </ul>

                <?php
                wp_reset_postdata();

              endif;

              ?>
                </div>
            </section>

              <?php
              }
              ?>




<?php
get_footer();
?>
