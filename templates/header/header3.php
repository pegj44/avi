<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for header 2.
 *
 * @package avi
 */

  global $option;

  $class[] = 'sticky-style-2';

?>

<!-- Header
============================================= -->
<header id="header" <?php avi_html_attr($class); ?>>
  
  <div class="container clearfix">

    <!-- Logo
    ============================================= -->
    <div id="logo">
        <?php if( $logo !== '' ) : ?>
            <a href="<?php echo site_url(); ?>" class="standard-logo" <?php echo $sticky_logo . $mobile_logo; ?>><img src="<?php echo $logo; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
            <a href="<?php echo site_url(); ?>" class="retina-logo" <?php echo $sticky_logo . $mobile_logo; ?>><img src="<?php echo $retina; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
        <?php else : ?>
            <h3 class="uppercase"><a href="<?php echo site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h3>
        <?php endif; ?> 
    </div><!-- #logo end -->

    <ul class="header-extras">
      <?php if( trim($option['avi-top-email']) !== '' ) : ?>
      <li>
        <i class="i-plain icon-email3 nomargin"></i>
        <div class="he-text">
          <?php _e('Drop an Email', 'avi'); ?>
          <span><?php echo $option['avi-top-email']; ?></span>
        </div>
      </li>
      <?php endif; ?>
      <?php if( trim($option['avi-top-phone']) !== '' ): ?>
      <li>
        <i class="i-plain icon-call nomargin"></i>
        <div class="he-text">
          <?php _e('Get in Touch', 'avi'); ?>
          <span><?php echo $option['avi-top-phone']; ?></span>
        </div>
      </li>
      <?php endif; ?>
    </ul>

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

        </div>
      </nav><!-- #primary-menu end -->
    </div>
    
  </div>

</header><!-- #header end -->