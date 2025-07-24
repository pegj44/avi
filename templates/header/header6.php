<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for header 5
 *
 * @package avi
 */

$class[] = 'sticky-style-2';

?>    
    <!-- Header
    ============================================= -->
    <header id="header" <?php avi_html_attr($class); ?>>

      <div class="container clearfix">

      <!-- Logo
      ============================================= -->
      <div id="logo" class="divcenter">
          <?php if( $logo !== '' ) : ?>
              <a href="<?php echo site_url(); ?>" class="standard-logo" <?php echo $sticky_logo . $mobile_logo; ?>><img class="divcenter" src="<?php echo $logo; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
              <a href="<?php echo site_url(); ?>" class="retina-logo" <?php echo $sticky_logo . $mobile_logo; ?>><img class="divcenter" src="<?php echo $retina; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
          <?php else : ?>
              <h3 class="uppercase text-center"><a href="<?php echo site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h3>
          <?php endif; ?> 
      </div><!-- #logo end -->

      </div>

      <div id="header-wrap">

          <div class="menu-align-wrap container">

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" class="style-2">

              <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <?php 
                  if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'menu'              => 'primary',
                        'theme_location'    => 'primary',
                        'depth'             => 4,
                        'container'         => false,
                        'menu_class'        => '',
                        'walker'            => new Avi_Nav_Walker())
                    );
                  }                
                ?>

              <?php do_action('avi_nav_elements'); ?>

            </nav><!-- #primary-menu end -->
          </div>

      </div>

    </header><!-- #header end -->