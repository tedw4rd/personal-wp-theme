<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foolish.computer
 */

get_header();
?>
	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );


		endwhile; // End of the loop.
		?>

        <?php
        $allPosts = get_posts(array(
                'post_type'=>'post',
            'orderby'=>'rand',
            'fields'=>array('post_category', 'post_title', 'post_id')));

        $postsByCategory = array();
        foreach ($allPosts as $post){
            foreach ($post->post_category as $cat){
                if (!array_key_exists($cat, $postsByCategory)){
                    $postsByCategory[$cat] = array();
                }
                $postsByCategory[$cat][] = $post;
            }
        }
        ?>
        <hr class="wp-block-separator has-alpha-channel-opacity">
<div class="grid-container">
<div class="grid-x small-up-2 medium-up-4 large-up-6">

<?php
foreach ($postsByCategory as $cat => $postList){
    $category = get_category($cat);
    ?>
    <div class="cell">
        <a href="/category/<? echo $category->slug?>">
        <div class="grid-card category-card" style="<? the_category_color($category); ?>">
        <h3><?php echo($category->name); ?></h3>
        </div>
        </a>
    </div>
    <?php
    foreach ($postList as $post){
        $postThumbnail = get_the_post_thumbnail_url($post);
        ?>
            <div class="cell">
                <a href="<? echo get_permalink($post->id);?>">
                <div class="grid-card post-card" style="background-image:url('<? echo $postThumbnail ?>'); <? the_category_color($category);?>">
                <h4><?php echo($post->post_title); ?></h4>
                </div>
                </a>
            </div>
        <?php
    }
    }
?>
</div>
</div>

	</main><!-- #main -->

<?php
get_footer();
