

</main><!-- #main -->

</div><!-- #wrapper -->

<footer id="footer" class="site-footer" role="contentinfo">

		<div class="container">

			<div class="pull-left">

				<?php wp_nav_menu( array( 'theme_location' => 'Bottom' ) ); ?>

			</div>
			<div class="pull-right">
				<ul>
					<li class="copyright">
						<em><?php echo(date('Y')); ?> IPCAN</em>
					</li>
				</ul>
			</div>
		</div>

</footer>






<?php wp_footer(); ?>
<?php
$gaCode = 'UA-36515097-9';
if($_SERVER['HTTP_HOST'] == 'ipcan.isobar.aeaws.com')$gaCode = 'UA-00000000-1';
?>
<script>
    var gaIsCreated = false;
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    function dismissCookies() {
        if(gaIsCreated == false) {
            gaIsCreated = true;
            ga('create', '<?php echo($gaCode); ?>', 'auto');
            ga('send', 'pageview');
        }
    }
</script>

</body>
</html>
