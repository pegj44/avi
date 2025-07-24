<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for search field
 *
 * @package avi
 */

?>

<!-- Top Search
============================================= -->
<div id="top-search">
    <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="text" name="s" class="form-control" id="s" value="" placeholder="Type &amp; Hit Enter..">
    </form> 
</div><!-- #top-search end -->