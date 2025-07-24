<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for top usermeta login.
 *
 * @package avi
 */

?>

<?php if( is_user_logged_in() ) : $user = wp_get_current_user(); ?>

<div class="top-links logout-nav">
  <ul id="menu-top-menu" class="clearfix">
    <li class="menu-item menu-item-type- menu-item-object- menu-item-has-children">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><div class="user-gravatar pull-left"><?php echo get_avatar($user->ID,32); ?></div> <?php echo $user->user_nicename; ?></a>
      <ul class="sub-menu">
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
          <li class="menu-item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </li>
  </ul>
</div>

<?php else : ?>

  <div class="top-links">
    <ul>      
      <li class="desktop-login"><a href="#"><i class="icon-line2-login"></i> <?php _e('Login', 'avi'); ?></a>
        <div class="top-link-section">
          <form id="top-login" role="form" name="loginform" action="<?php echo site_url(); ?>/wp-login.php" method="post">
            <div class="input-group" id="top-login-username">
              <span class="input-group-addon"><i class="icon-user"></i></span>
              <input type="text" name="log" id="user_login" class="form-control useremail" placeholder="<?php _e('Username or Email', 'avi'); ?>" required="">
            </div>
            <div class="input-group" id="top-login-password">
              <span class="input-group-addon"><i class="icon-key"></i></span>
              <input type="password" name="pwd" id="user_pass" class="form-control userpass" placeholder="<?php _e('Password', 'avi'); ?>" required="">
            </div>
             <label class="checkbox">
              <input name="rememberme" type="checkbox" id="rememberme" value="forever"> <?php _e('Remember me', 'avi'); ?>
            </label>  
            <input type="hidden" name="redirect_to" value="<?php echo site_url(); ?>">          
            <button name="wp-submit" id="wp-submit" class="btn btn-danger btn-block" type="submit"><?php _e('Sign in', 'avi'); ?></button>
          </form>
        </div>
      </li>
    </ul>
  </div>

<?php endif; ?>  