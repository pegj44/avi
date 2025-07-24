<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme template footer class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Template_Footer extends Avi_Template_Structure {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'avi_footer', array( $this, 'avi_get_footer_widget_area' ), 10 );
		add_action( 'avi_footer', array( $this, 'avi_get_footer_bottom_area' ), 20 );	
		add_action( 'avi_footer_widgets', array( $this, 'avi_get_footer_widgets' ) );
		add_filter( 'avi_footer_elements', array( $this, 'get_element' ), 10, 3 );
	}	

    function avi_get_footer_widgets() {

    	global $option;

        $fcol = array(
	        'one' => array('col_full'),
	        'two' => array('col_half', 'col_half'),
	        'two_b' => array('col_two_third', 'col_one_third'),
	        'two_c' => array('col_one_third', 'col_two_third'),
	        'two_d' => array('col_three_fourth', 'col_one_fourth'),
	        'two_e' => array('col_one_fourth', 'col_three_fourth'),
	        'three' => array('col_one_third', 'col_one_third', 'col_one_third'),
	        'three_b' => array('col_one_fourth', 'col_half', 'col_one_fourth'),
	        'four' => array('col_one_fourth', 'col_one_fourth', 'col_one_fourth', 'col_one_fourth'),
	        'four_b' => array('col_one_fifth', 'col_one_fifth', 'col_one_fifth', 'col_two_fifth'),
	        'six' => array('col_one_sixth', 'col_one_sixth', 'col_one_sixth', 'col_one_sixth', 'col_one_sixth', 'col_one_sixth')
        );

        $i = 0;
        foreach ($fcol[$option['avi-footer-col']] as $column) {
        	$i++;
            echo '<div class="'. $column .'">';
            	dynamic_sidebar('footer-col'. $i .'-widget');
            echo '</div>';
        }
    }

	/**
	 * Footer navigation area
	 */
	function avi_get_footer_widget_area() {
		global $option;

		$widgets = array();
		for ($i=1; $i <= 6 ; $i++) { 
			$widgets[] = is_active_sidebar('footer-col'. $i .'-widget');
		}

		$widgets = array_filter($widgets);
		if( !empty($widgets) ) {
			$this->avi_template('footer/footer-area');
		}		
	}

	function get_element( $elem, $before = '', $after = '' ) {

		global $option;

		if( !$option[$elem] || $option[$elem] === 'none' ) { return false; }

		echo $before;
			call_user_func_array( array($this, 'elem_'. $option[$elem]), array($elem) );
		echo $after;
	}

	function elem_logo() {
		global $option;
		if( $option['avi-footer-logo']['url'] ) {
			echo '<a class="footer-logo-wrap" href="'. get_site_url() .'"><img src="'. esc_url($option['avi-footer-logo']['url']) .'" alt="" class="footer-logo"></a>';
		}
	}

	function elem_link() {
	?>
		<div class="copyrights-menu copyright-links clearfix">
			<?php
			  if ( has_nav_menu( 'footer_menu' ) ) {
			    wp_nav_menu( array(
			        'menu'              => 'footer_menu',
			        'theme_location'    => 'footer_menu',
			        'depth'             => 1,
			        'container'         => false,
			        'menu_class'        => 'footer-menu'
			    ));
			  }
			?>						
		</div>
	<?php
	}

	function elem_copyright() {
		global $option;
		if( trim($option['avi-footer-copyright']) ) {
			echo wp_kses( preg_replace('/{Y}/', date('Y'), $option['avi-footer-copyright']), avi_allowed_html());
		}		
	}

	function elem_social() {
		echo apply_filters('avi_social_buttons', '<a href="{link}" target="_blank" class="{class} social-icon" style="{style}"><i class="{icon}"></i><i class="{icon}"></i></a>', array_filter(avi_user_social_media()), 'footerbtn' );
	}

	function elem_contact() {
		global $option;
	?>
		<ul class="copyright-contact nomargin">
			<?php if($option['avi-footer-phone']) : ?><li><i class="icon-phone3"></i> <?php echo esc_html($option['avi-footer-phone']); ?></li><?php endif; ?>
			<?php if($option['avi-footer-email']) : ?><li><i class="icon-line-mail"></i> <?php echo esc_html($option['avi-footer-email']); ?></li><?php endif; ?>
		</ul>		
	<?php
	}

	function elem_html($param) {
		$param = explode('-', $param);
		echo wp_kses($this->option('avi-'. $param[1] .'-element-html'), avi_allowed_html());
	}

	/**
	 * Footer secondary navigaton area.
	 */
	function avi_get_footer_bottom_area() {
		global $option;

		if( $option['avi-footer-bottom'] === 'none' ) { return false; }		
		$this->avi_template('footer/footer-bottom-'. $option['avi-footer-bottom']);
	}
	
} // end class