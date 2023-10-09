<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foolish.computer
 */

?>

	<footer id="colophon" class="site-footer">
        <hr class="wp-block-separator has-alpha-channel-opacity">
        <div class="grid-x">
            <div class="cell small-4 small-offset-4">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
<script type="application/javascript">
    jQuery(document).foundation();
</script>
</html>
