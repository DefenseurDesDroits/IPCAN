<?php
if(0) {
	while ( have_posts() ) : the_post();

		echo('<pre>');
		print_r($post);
		echo('</pre>');
	endwhile;
	exit();
}

$read_label = 'LIRE LA SUITE';
$noResult = "Il n'y a pas de r&eacute;sultat &agrave; votre recherche.";
$title = 'R&eacute;sultat de recherche';
$breadcrumb = 'Résultats de recherche pour ';
if(pll_current_language() == 'en'){
	$read_label = "READ MORE";
	$noResult = "There is no result for your search.";
	$title = 'Search result';
	$breadcrumb = 'Search results for ';
}

/*
Template Name: Search Result
*/
get_header();


?>

<div class="breadcrumb">
    <div class="container">
        <!-- Breadcrumb NavXT 5.7.0 -->
        <span property="itemListElement" typeof="ListItem">
            <a property="item" typeof="WebPage" title="Go to IPCAN." href="http://ipcan.isobar.aeaws.com" class="home">
                <span property="name">IPCAN</span>
            </a>
            <meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name"><?php echo $breadcrumb;?> '<?php echo $s;?>'</span><meta property="position" content="2">
        </span>
		<?php
/*		if(function_exists('bcn_display'))
		{
			bcn_display();
		}*/
		?>
    </div>
</div>


<section class="section clearfix">
    <h1 class="color--blue centered"><?php echo $title; ?></h1>
</section>

<section class="section searchresult clearfix">
    <div class="container">
        <div class="results">
			<?php
			if (have_posts()) :

                $catHtml = array();
				$categories = get_categories();
				foreach($categories AS $k => $v) {
					$catHtml[$v->term_id] = '<a href="/'.$v->slug.'">'.$v->name.'</a>';
                }
				while ( have_posts() ) : the_post();

                    $cat = array();
					$categories = wp_get_post_categories( $post->ID);
					foreach($categories AS $k => $v) {
					    if(isset($catHtml[$v])) {
						    $cat[] = $catHtml[$v];
                        }
                    }
					?>
                    <div class="result">

                        <span class="date"><?php the_time('D j M Y'); ?></span><br />
                        <span class="title"><?php the_title(); ?></span><br />
						<?php the_excerpt(); ?>
                        <?php if(count($catHtml) > 0) : ?>
                        <div class="categories"><?php echo(join(', ', $cat));?></div>
	                    <?php endif; ?>
                        <a href="<?php the_permalink() ?>" class="cta--secondary"><?php echo $read_label; ?></a>

                    </div>
					<?php
				endwhile;
			else :
				?>
                <div class="noresults">
					<?php echo $noResult; ?>
                </div>
				<?php
			endif;
			?>
        </div>
    </div>
</section>


<?php
get_footer();
?>
