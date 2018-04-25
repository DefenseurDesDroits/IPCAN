<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</main><!-- #main -->

		<footer id="footer" class="site-footer" role="contentinfo">

				<div class="container">

					<div class="pull-left">


						<?php get_sidebar( 'footer' ); ?>

						<!--ul id="menu-bottom_menu" class="menu">
							<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
								<a class="cta--footer" href="sitemap.html">Plan du site</a>
							</li>
							<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a class="cta--footer" href="help.html">Aide</a>
							</li>
							<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a class="cta--footer" href="mentions.html">Mentions Légales</a>
							</li>
							<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a class="cta--footer" href="accessibility.html">Accessibilité</a>
							</li>
							<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a class="cta--footer" href="contact.html">Contact</a>
							</li>
							<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
									<a class="cta--footer" href="partners.html">Partenaires</a>
							</li>
							<li class="mobile copyright">
									<em>2016 IPCAN</em>
							</li>
						</ul-->

					</div>
					<div class="pull-right">
						<ul>
							<li class="copyright">
								<em>2016 IPCAN</em>
							</li>
						</ul>
					</div>
				</div>
				<div class="site-info">
					<?php do_action( 'twentyfourteen_credits' ); ?>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentyfourteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfourteen' ), 'WordPress' ); ?></a>
				</div><!-- .site-info -->
		</footer>


	</div><!-- #wrapper -->

	<?php wp_footer(); ?>
</body>
</html>
