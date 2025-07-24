<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for header 9
 *
 * @package avi
 */

  global $option;

 ?>

    <div id="header-trigger"><i class="icon-line-menu"></i><i class="icon-line-cross"></i></div>

    <!-- Header
    ============================================= -->
    <header id="header" class="no-sticky">

      <div id="header-wrap">

        <div class="container clearfix">

          <!-- Logo
          ============================================= -->
          <div id="logo" class="nobottomborder">
              <?php if( $logo !== '' ) : ?>
                  <a href="<?php echo site_url(); ?>" class="standard-logo" <?php echo $sticky_logo . $mobile_logo; ?>><img src="<?php echo $logo; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
                  <a href="<?php echo site_url(); ?>" class="retina-logo" <?php echo $sticky_logo . $mobile_logo; ?>><img src="<?php echo $retina; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
              <?php else : ?>
                  <h3 class="uppercase"><a href="<?php echo site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h3>
              <?php endif; ?> 
          </div><!-- #logo end -->

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu">

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

            </nav><!-- #primary-menu end -->

          <div class="side-header-bottom clearfix visible-md visible-lg">

            <?php echo apply_filters('avi_social_buttons', '<a href="{link}" class="{class} social-icon" style="{style}"><i class="{icon}"></i><i class="{icon}"></i></a>', array_filter(avi_user_social_media()), 'footerbtn' ); ?>
            
            <div class="clear bottommargin-sm"></div>
            
            <?php if( trim($option['avi-top-phone']) !== '' ) : ?>
              <a href="tel:<?php echo esc_html($option['avi-top-phone']); ?>" class=""><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text"><?php echo esc_html($option['avi-top-phone']); ?></span></a>
            <?php endif; ?>

            <?php if( trim($option['avi-top-email']) !== '' ) : ?>
              <a href="mailto:<?php echo esc_html($option['avi-top-email']); ?>" class=""><span class="ts-icon"><i class="icon-email3"></i></span><span class="ts-text"><?php echo esc_html($option['avi-top-email']); ?></span></a>
            <?php endif; ?>

          </div>

        </div>
      </div>
    </header><!-- #header end -->