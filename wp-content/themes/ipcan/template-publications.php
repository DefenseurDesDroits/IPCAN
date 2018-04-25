<?php



$url = mdGetPublicationURL($_SERVER['REQUEST_URI']);
if($url) {
    header("Status: 301 Moved Permanently", false, 301);
	header("Location: ".$url);
	exit();
}


$searchKeyword = '';
$searchCategory = '';
$searchDate = '';
//$modSearch = (isset($_POST['submitted']) && ($_POST['submitted'] == 1)) ? true : false;
$modSearch = (isset($_GET['search']) && isset($_GET['category']) && isset($_GET['date'])) ? true : false;
if($modSearch) {
	$searchKeyword= (isset($_GET['search'])) ?  $_GET['search'] : '';
	$searchCategory= (isset($_GET['category'])) ?  $_GET['category'] : '';
	if($searchCategory == '0')$searchCategory='';
	$searchDate= (isset($_GET['date'])) ?  $_GET['date'] : '';
	if(trim($searchDate) != '') {
	    if(preg_match('#^(\d{2})/(\d{2})/(\d{4})$#', $searchDate, $match)) {
		    $searchDate = $match[3].'-'.$match[2].'-'.$match[1];
        }
		if(!preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $searchDate, $match)) {
			$searchDate = '';
		}
    }
}

/*
Template Name: template publications
*/
get_header();

?>
<script src="<?php echo get_site_url(); ?>/wp-content/themes/ipcan/scripts/vendor/polyfiller.js"></script>

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

    <?php

    $title_label = 'Titres';
    $title_placeholder = 'Mots-clés';
    $type_label = 'Type de publication';
    $date_label = 'Date de publication';
    $search_btn = 'Rechercher';
    $all        = 'Toutes';
    $date_placeholder = 'aaaa-mm-jj';
    $title = 'Publications';

    if(pll_current_language() == 'en'){
	    $title_label = 'Titles';
	    $title_placeholder = 'Keywords';
	    $type_label = 'Type of publication';
	    $date_label = 'Publication date';
	    $search_btn = 'Search';
	    $all = 'All';
	    $date_placeholder = 'yyyy-mm-dd';
	    $title = 'Publications';
    }

    ?>

		<h1 class="color--blue centered"><?php echo($title); ?></h1>


		<div class="search-filter">
			<div class="container">
				<?php
                // MD Supprimer car impossible à paramètrer comme demandé par le client
                if(0) {
                $headings = "$title_label,$type_label,$date_label";
                echo do_shortcode('[searchandfilter fields="search,category,post_date" types=",select,date" hierarchical=",1" headings="'.$headings.'" search_placeholder="'.$title_placeholder.'" submit_label="'.$search_btn.'"]');
                }


				$searchKeyword = preg_replace('#\\\"#', '"', $searchKeyword);
				$searchKeyword = preg_replace("#\\\'#", "'", $searchKeyword);
                ?>
                <form action="" method="get" class="searchandfilter">
                    <div>
                        <ul><li class="form-group  col-md-2 col-sm-6 col-xs-12"><label class="control-label"><?php echo($title_label); ?></label><input class="form-control" type="text" name="search" placeholder="Keywords" value="<?php echo(htmlentities($searchKeyword)); ?>"></li><li class="form-group  col-md-2 col-sm-6 col-xs-12"><label class="control-label"><?php echo($type_label); ?></label><select name="category" id="ofcategory" class="postform">
                                    <option value="0" selected="selected"><?php echo($all); ?></option>
                                    <?php
                                    $parentCategorie = (pll_current_language() == 'en') ? 62 : 31;
                                    $categories = get_categories( array(
	                                    'orderby' => 'name',
	                                    'order'   => 'ASC',
	                                    'child_of' => $parentCategorie
                                    ) );

                                    foreach($categories AS $k => $v) {
                                    ?>
                                    <option class="level-0" value="<?php echo($v->cat_ID); ?>"<?php if($searchCategory == $v->cat_ID)echo(' selected="selected"'); ?>><?php echo($v->cat_name); ?></option>
	                                <?php
                                    }
                                    ?>
                                </select>
                                </li><li class="form-group  col-md-2 col-sm-6 col-xs-12"><label class="control-label"><?php echo($date_label); ?></label><input class="postform form-control" type="date" name="date" value="<?php echo($searchDate); ?>" placeholder="<?php echo($date_placeholder); ?>" ></li><li class="form-group  col-md-2 col-sm-6 col-xs-12">
                                <input type="submit" class="search-submit button button--submit" value="<?php echo($search_btn); ?>">
                            </li></ul></div>
                </form>
			</div>
		</div>

</section>


<section class="section actualites clearfix">

		<div class="container">

			<div class="list-news">

		<?php
		    $catSlug = (pll_current_language() == 'en') ? 'publications' : 'publications-fr';
            $args = array('category_name'=>$catSlug);
            if(trim($searchKeyword) != '')$args['s'] = $searchKeyword;
            if(trim($searchCategory) != '') {
	            $cat = get_the_category_by_ID(trim($searchCategory));
	            if($cat != '') {
		            $args['category_name'] = $cat;
                }
            }
            if(trim($searchDate) != '') {
                $dateInfo = preg_split('/-/', $searchDate);
                $args['date_query'] = array(
                    array(
                        'year'  => $dateInfo[0],
                        'month' => $dateInfo[1],
                        'day'   => $dateInfo[2],
                    )
                );
            }


            $recentPosts = new WP_Query($args);
            foreach($recentPosts->posts as $post){

            $read_label = 'LIRE LA SUITE';
            $when_label = 'à';

            if(pll_current_language() == 'en'){
            	$read_label = "READ MORE";
            	$when_label = 'at';
             }

        ?>

		<div class="item g--half g--half-last g--third g--last">
				<p class="date"><?php the_time('D j M Y'); ?></p>


				<a href="<?php the_permalink() ?>">
				<h2 class="theme"><?php the_title(); ?></h2>
					<?php echo the_post_thumbnail( array(300, 200), array( 'class' => 'visuel' ) ); ?>
					<span class="overlay"></span>
				</a>
				<h3 class="text">
					<a href="<?php the_permalink() ?>" class="cta--primary"><?php the_excerpt(); ?></a>
				</h3>
				<a href="<?php the_permalink() ?>" class="cta--secondary"><?php echo $read_label; ?></a>
		</div>
	<?php } ?>

</div>
</div>
</section>


<?php
get_footer();
?>
