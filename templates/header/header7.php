<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for header 6
 *
 * @package avi
 */

$class[] = 'split-menu';

?>

<!-- Header
============================================= -->
<header id="header" <?php avi_html_attr($class); ?>>

    <div id="header-wrap">

        <div class="container clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <!-- Logo
            ============================================= -->
            <div id="logo">
                <?php if( $logo !== '' ) : ?>
                    <a href="<?php echo site_url(); ?>" class="standard-logo" <?php echo $sticky_logo . $mobile_logo; ?>><img src="<?php echo $logo; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
                    <a href="<?php echo site_url(); ?>" class="retina-logo" <?php echo $sticky_logo . $mobile_logo; ?>><img src="<?php echo $retina; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
                <?php else : ?>
                    <h3 class="uppercase text-center"><a href="<?php echo site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h3>
                <?php endif; ?> 
            </div><!-- #logo end -->

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" class="with-arrows clearfix">

                <?php 
                  if ( has_nav_menu( 'split-left' ) ) {
                    wp_nav_menu( array(
                        'menu'              => 'split-left',
                        'theme_location'    => 'split-left',
                        'depth'             => 4,
                        'container'         => false,
                        'menu_class'        => '',
                        'walker'            => new Avi_Nav_Walker())
                    );
                  }                
                ?>

                <?php do_action('avi_nav_elements'); ?>

                <?php 
                  if ( has_nav_menu( 'split-right' ) ) {
                    wp_nav_menu( array(
                        'menu'              => 'split-right',
                        'theme_location'    => 'split-right',
                        'depth'             => 4,
                        'container'         => false,
                        'menu_class'        => '',
                        'walker'            => new Avi_Nav_Walker())
                    );
                  }                
                ?>                    
  
            </nav><!-- #primary-menu end -->

        </div>

    </div>

</header><!-- #header end -->