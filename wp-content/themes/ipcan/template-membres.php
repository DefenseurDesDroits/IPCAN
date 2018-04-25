<?php
/*
Template Name: Template membres
*/
get_header();

?>
<?php
$title = 'Membres';

if(pll_current_language() == 'en'){
	$title = 'Members';
}

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

    <section class="section clearfix">

      <h1 class="color--blue centered"><?php echo($title); ?></h1>

      <!--
      <div class="search-filter">
        <div class="container">


        <div class="searchandfilter">
            <?php echo '', do_shortcode('[searchandfilter fields="search" order_by="name" submit_label="Filtrer"]'); ?>
        </div>

        </div>
      </div>
      -->

      <div class="list-members">
        <div class="container">
            <?php
            $catIn = (pll_current_language() == 'en') ? 60 : 51;
            $recentPosts = new WP_Query(array('category__in'=>$catIn, 'orderby' => 'title', 'order'   => 'DESC'));
              foreach($recentPosts->posts as $post){

              $read_label = 'LIRE LA SUITE';
              $when_label = 'à';

              if(pll_current_language() == 'en'){
                $read_label = "READ MORE";
                $when_label = 'at';
              }

              $posttags = get_the_tags();
              $country = "";
              if ($posttags) {
                foreach($posttags as $tag) {
                  $country .= $tag->name . ' '; 
                }
              }

            ?>


            <div class="item item col-md-3 col-sm-4 col-xs-6">
              <a href="<?php the_permalink() ?>">
                <?php echo the_post_thumbnail( array(200, 200), array( 'class' => 'visuel' ) ); ?>
              </a>
              <p class="country"><?php echo $country; ?></p>
              <h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?> </a></h2>
            </div>
            <?php } ?>
        </div>
      </div>

  </section>


<?php
get_footer();
?>
