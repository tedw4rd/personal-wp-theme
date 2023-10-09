<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foolish.computer
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
    <div class="grid-x">
        <div class="cell small-4 small-offset-4 site-branding">
            <?php
            if ( is_front_page() || is_home() ) :
                ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
            else :
                ?>
                <ul class="dropdown menu" data-dropdown-menu>
                    <li class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></li>
                    <li><a href="#"></a>
                        <ul class="menu">
                            <?php
                            $nav_items = wp_get_nav_menu_items('primary');
                            if ($nav_items != false) :
                                foreach ($nav_items as $nav):
                                    ?>
                                    <li><a href="<? echo $nav->url?>"><? echo $nav->title; ?></a></li>
                                <?php endforeach; endif; ?>
                        </ul></li>
                </ul>
            <?php endif;?>
        </div>
    </div>

    </div>
</header><!-- #masthead -->
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'foolish-computer' ); ?></a>

