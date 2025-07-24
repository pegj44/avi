<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for top links.
 *
 * @package avi
 */

?>

<div class="top-links">
  <?php 
    if ( has_nav_menu( 'top_menu' ) ) {
      wp_nav_menu( array(
          'menu'              => 'top_menu',
          'theme_location'    => 'top_menu',
          'depth'             => 2,
          'container'         => false,
          'menu_class'        => '',
      ));
    }                
  ?>
</div><!-- .top-links end -->