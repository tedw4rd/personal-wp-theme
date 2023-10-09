<?php
/**
 * The template for displaying category archives
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
$category = get_category( get_query_var( 'cat' ), false );
?>
    <main id="primary" class="site-main">
<div class="grid-container">
    <div class="small-10 small-offset-1 large-8 large-offset-2 term_description">
        <h2><?php echo $category->name; ?></h2>
        <p><?php echo $category->category_description; ?></p>
    </div>
</div>
        <hr class="wp-block-separator has-alpha-channel-opacity">
        <div class="grid-container">
            <div class="grid-x small-up-2 medium-up-4 large-up-6">

                    <div class="cell">
                        <a href="/category/<? echo $category->slug?>">
                            <div class="grid-card category-card" style="<? the_category_color($category); ?>">
                                <h3><?php echo($category->name); ?></h3>
                            </div>
                        </a>
                    </div>
                    <?php
                        while ( have_posts() ) :
                            the_post();
                        $postThumbnail = get_the_post_thumbnail_url();
                        ?>
                        <div class="cell">
                            <a href="<? echo get_the_permalink();?>">
                                <div class="grid-card post-card" style="background-image:url('<? echo $postThumbnail ?>'); <? the_category_color($category);?>">
                                    <h4><?php the_title(); ?></h4>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile;
                ?>
            </div>
        </div>

    </main><!-- #main -->

<?php
get_footer();
