<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme options class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Options {

	/**
	 * Avi option name.
	 *
	 * @static
	 * @access public
	 * @var object
	 */
	public static $option = 'avi_option';

	/**
	 * Avi option page_slug.
	 *
	 * @static
	 * @access public
	 * @var object
	 */
	public static $page_slug = 'avi_options';	

	/**
	 * Avi option directory url.
	 *
	 * @static
	 * @access public
	 * @var object
	 */
	public static $option_dir_url = '';

	/**
	 * Avi option preset.
	 *
	 * @static
	 * @access public
	 * @var object
	 */
	public static $preset = '';

    /**
     * Avi options array.
     *
     * @static
     * @access public
     * @var array
     */
    public static $option_arr = array(); 

    /**
     * Avi window types array.
     *
     * @static
     * @access public
     * @var array
     */
    public static $opt_window = array(); 



	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {		

		Avi::avi_includes( 'includes/avi-redux/', array(			
			'redux-framework/framework',
			'redux-extensions/extensions-init',			
		));

		self::$option_arr = json_decode( json_encode(get_option(self::$option)) );

		/**
		 * Initialize theme options after widgets are initialized
		 */		
		add_action( 'init', array($this, 'avi_redux_init'), 2 );
	}

	/**
	 * Initialize theme options
	 *     
	 * @access public
	 * @since  1.0
	 * @return void     
     */ 
	public function avi_redux_init() {
		
		self::$option_dir_url = Avi::$template_dir_url .'/includes/avi-redux';

		$this->set_aviredux_args();

        self::$preset = $this->get_option_preset();		

		$this->load_option_sections();

		add_action( 'redux/page/avi_option/enqueue', array( $this, 'admin_enqueue_style' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'remove_redux_menu' ), 12 );
		add_action( 'init', array( $this, 'remove_demo_link' ) );	
		add_filter( 'admin_footer_text', '__return_empty_string', 11 );
	}

	/**
	 * Set redux arguments
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */	
	public function set_aviredux_args() {

	    $args = array(
	        'opt_name' =>  self::$option,
	        'page_slug' => self::$page_slug,
	        'display_name' => 'Avi',
	        'page_title' => 'Avi Options',
	        'update_notice' => false,
	        'global_variable' => 'option',
	        'display_version' => ReduxFramework::$_version,
	        'intro_text' => __('<p>Need help? click <a href="#">HERE</a> for online documentation.</p>', 'avi'),
	        'footer_text' => __('<p>Need help? click <a href="#">HERE</a> for online documentation.</p>', 'avi'),	        
	        'admin_bar' => true,
	        'menu_type' => 'submenu',
	        'menu_title' => 'Theme Options',
	        'allow_sub_menu' => true,
	        'page_parent' => 'themes.php',	        
	        'page_priority' => '60',
	        'dev_mode' => false,
	        'disable_tracking' => true,
	        'customizer' => false,
	        'default_mark' => '',
	        'class' => 'avi',
	        'output' => true,
	        'output_tag' => true,
	        'compiler' => true,
	        'page_permissions' => 'manage_options',
	        'save_defaults' => true,
	        'show_import_export' => true,
	        'database' => '',
	        'transient_time' => '3600',
	        'network_sites' => true,
	        'async_typography' => false,
	        'google_update_weekly' => true,
	    );

	    Redux::setArgs( self::$option, $args ); 
	}

	/**
	 * Load theme option sections
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */	
    public function load_option_sections() {

    	$sections = array(
            'branding',
            'layout',         
            'page_title_header',
            'blog_archive',    
            'post_page',
            'shop',            
            'colors_backgrounds',
            'typography',
            'social_media',
            'miscellaneous',
            'custom_css',
            'scripts',
        );        

    	Avi::avi_includes('includes/avi-redux/options/', $sections, 'include_once');
    	
        foreach ($sections as $section) {

        	$section_arr = call_user_func('avi_option_section_'. $section);

        	foreach ($section_arr as $item) {

        		$this->set_option_window( $item );

        		Redux::setSection( Avi_Options::$option, $item );
        	}        	        	
        }
    }

    /**
     * Set option keys with window visibility
     *
     * @access private
     * @since  1.0
     * @param array
     * @return void
     */ 
    private function set_option_window( $fields ) {

    	if( isset($fields['fields']) || array_key_exists('fields', $fields) ) {

    		foreach ($fields['fields'] as $field) {

	    		if( array_key_exists('avi_window', $field) ) {
	    			self::$opt_window[$field['id']] = $field['avi_window'];
	    		}
    		}
    	}
    	 
    }

    /**
     * Set option preset
     *
     * @access public
     * @since  1.0
     * @return array
     */ 
    public function get_option_preset() {

        // set this as option preset if preset.json is blank or not found.
        $json = '{"last_tab":"1","avi-site-title":"Avi","avi-site-tagline":"Just another cool invention","avi-logo":{"url":"http://localhost/base-theme-new/wp-content/themes/avi/assets/images/logo.png","id":"","height":"","width":"","thumbnail":""},"avi-logo-retina":{"url":"http://localhost/base-theme-new/wp-content/themes/avi/assets/images/logo.png","id":"","height":"","width":"","thumbnail":""},"avi-alternate-logo":"0","avi-alt-standard-logo":{"url":"","id":"","height":"","width":"","thumbnail":""},"avi-mobile-logo":{"url":"","id":"","height":"","width":"","thumbnail":""},"avi-favicon":{"url":"","id":"","height":"","width":"","thumbnail":""},"avi-boxed-layout":"0","avi-blog-num-col":"4","avi-archive-num-col":"3","avi-shop-num-col":"3","avi-sticky-header":"1","avi-header-width":"0","avi-top-header":"0","avi-top-left":"top-menu","avi-topleft-html":"<strong>Custom top left html</strong>","avi-top-right":"phone-email","avi-topright-html":"<strong>Custom top right html</strong>","avi-top-phone":"1234","avi-top-email":"email","avi-header-layout":"header1","avi-menu-align":"right","avi-header-search":"1","avi-header-cart":"1","avi-ubermenu":"1","avi-blog-layout":"blog-right-widget","avi-archive-layout":"archive-right-widget","avi-page-layout":"page-right-widget","avi-shop-layout":"shop-right-widget","avi-footer-col":"four","avi-footer-bottom":"2","avi-upperleft-element":"copyright","avi-bottomleft-element":"","avi-upperright-element":"copyright","avi-bottomright-element":"","avi-uppercenter-element":"copyright","avi-bottomcenter-element":"none","avi-footer-logo":{"url":"http://localhost/base-theme-new/wp-content/themes/avi/assets/images/footer-logo.png","id":"","height":"","width":"","thumbnail":""},"avi-footer-phone":"","avi-footer-email":"","avi-footer-copyright":"Copyrights © 2017 All Rights Reserved by Avi.","avi-archive-num-posts":"10","avi-archive-meta":{"date":"1","author":"1","category":"0","comments":"0","format":"0"},"avi-masonry":{"blog":"1","archive":"1"},"avi-infinite-scroll":{"blog":"1","archive":"1"},"avi-article-comments":"1","avi-single-post-show-related":"","avi-post-author":"1","avi-post-tag":"1","avi-postpage-meta":{"single":"1","page":"0"},"avi-singular-meta":{"date":"1","author":"1","comments":"1","category":"1","format":"1"},"avi-next-prev":{"single":"1","page":"1"},"avi-shop-num-posts":"10","avi-shop-tags":"1","avi-shop-excerpt":"0","avi-shop-result-count":"1","avi-shop-sorting":"1","avi-page-header":{"blog":"1","archive":"1","page":"1","shop":"1"},"avi-blog-pageheader-txt":"Blog","avi-blog-subheader-txt":"Our Latest News in Masonry Layout","avi-shop-pageheader-txt":"Shop","avi-shop-subheader-txt":"Start Buying your Favourite Theme","avi-color-scheme":"0","avi-custom-color-opt":"0","avi-custom-color":"#ffffff","avi-color-contrast":"1","avi-top-bg":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"avi-main-header-bg":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"avi-page-header-bg":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"avi-top-item-bg":{"regular":"","hover":"","active":""},"avi-submenu-bg":{"regular":"","hover":"","active":""},"avi-body-bg":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"avi-boxed-body-bg":{"background-color":"#d0d0d0","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"avi-footer-bg":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"avi-footer-bottom-area-bg":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"avi-general-typo":{"font-family":"Lato","font-options":"","google":"true","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-links-typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":""},"avi-links-colors-typo":{"regular":"","hover":"","active":""},"avi-h1-typo":{"font-family":"Raleway","font-options":"","google":"true","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-h2-typo":{"font-family":"Raleway","font-options":"","google":"true","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-h3-typo":{"font-family":"Raleway","font-options":"","google":"true","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-h4-typo":{"font-family":"Raleway","font-options":"","google":"true","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-h5-typo":{"font-family":"Raleway","font-options":"","google":"true","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-h6-typo":{"font-family":"Raleway","font-options":"","google":"true","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-top-menu-typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":""},"avi-top-menu-color-typo":{"regular":"","hover":"","active":""},"avi-submenu-typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":""},"avi-submenu-color-typo":{"regular":"","hover":"","active":""},"avi-page-header-typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-page-header-meta-typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-breadcrumbs-typography":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":""},"avi-breadcrumbs-color-typography":{"regular":"","hover":"","active":""},"avi-article-title-typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-post-meta-typography":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-widget-typography":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-widget-text-typography":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-footer-widgettitle-font":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-footer-widgettxt-font":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-footer-copyright-typography":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-align":"","text-transform":"","font-size":"","line-height":"","color":""},"avi-share-buttons-in":{"post":"1","page":"1","product":"1"},"avi-display-socials":"before","avi-share-text":"Share this","avi-enabled-share-buttons":{"Enabled":{"placebo":"placebo","reddit":"Reddit","facebook":"Facebook","twitter":"Twitter","gplus":"Google Plus","stumbleupon":"StumbleUpon","vk":"VKontakte","digg":"Digg"},"Disabled":{"placebo":"placebo","linkedin":"Linkedin","tumblr":"Tumblr","pinterest":"Pinterest","buffer":"Buffer"}},"avi-dribbble":"","avi-facebook":"","avi-twitter":"","avi-delicious":"","avi-flickr":"","avi-google-plus":"","avi-lastfm":"","avi-linkedin":"","avi-vimeo":"","avi-youtube":"","avi-tumblr":"","avi-pinterest":"","avi-skype":"","avi-github":"","avi-instagram":"","avi-stumbleupon":"","avi-share-size":"small","avi-share-style-prev":"<div data-value=\"style9\" id=\"style9\" class=\"mitem soc-btn selected\"><span class=\"icon-facebook\"></span><span class=\"icon-google-plus\"></span><span class=\"icon-stumbleupon\"></span><span class=\"icon-digg\"></span><span class=\"icon-reddit\"></span><span class=\"icon-dribbble\"></span><span class=\"icon-linkedin\"></span><span class=\"icon-vk\"></span><span class=\"icon-twitter\"></span><span class=\"icon-tumblr\"></span></div>","avi-share-style":"style9","avi-share-style-color":"#1e73be","avi-footerbtn-size":"small","avi-footerbtn-style-prev":"<div data-value=\"style8\" id=\"style8\" class=\"mitem soc-btn selected\"><span class=\"icon-facebook\"></span><span class=\"icon-google-plus\"></span><span class=\"icon-stumbleupon\"></span><span class=\"icon-digg\"></span><span class=\"icon-reddit\"></span><span class=\"icon-dribbble\"></span><span class=\"icon-linkedin\"></span><span class=\"icon-vk\"></span><span class=\"icon-twitter\"></span><span class=\"icon-tumblr\"></span></div>","avi-footerbtn-style":"style8","avi-footerbtn-style-color":"#dd3333","avi-siteloader":"0","avi-loading-style":"3","avi-preload-color":"#1e73be","avi-bc-separator":"breadcrumb-sep","avi-breadcrumbs":{"blog":"1","archive":"1","page":"1","shop":"1"},"avi-scrolltop":"1","avi-scrolltop-color":"","avi-custom-css":"","avi-header-scripts":"","avi-header-ad":"<img src=\"http://localhost/base-theme-new/wp-content/themes/avi/assets/img/ad.jpg\" alt=\"Ad\">","avi-footer-scripts":"","redux-backup":1}';
        $file = ( is_child_theme() )? Avi::$stylesheet_dir .'/preset.json' : dirname(__FILE__) .'/avi-redux/preset.json';
        $content = @file_get_contents( $file );

        if ( $content) {
            return json_decode($content, true);
        }

        return json_decode($json, true);
    }

	/**
	 * Enqueue option styles
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */	
	public function admin_enqueue_style() {
		wp_enqueue_style( 'avi-options-icons', self::$option_dir_url .'/assets/css/font-icons.css', '', Avi::$version );
        wp_enqueue_style( 'avi-options-css', self::$option_dir_url .'/assets/css/style.css', '', Avi::$version );        
	}

	/**
	 * Enqueue option scripts
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */	
	public function admin_enqueue_scripts($page) {

        if( $page === 'appearance_page_'. self::$page_slug ) {
        	wp_enqueue_script( 'avi-options-script', self::$option_dir_url .'/assets/js/options-script.js', '', Avi::$version, true );		
        }        
	}

    /**
     * Remove redux menu under the tools
     *
	 * @access public
	 * @since  1.0
	 * @return void     
     */   
    public function remove_redux_menu() {
        remove_submenu_page('tools.php','redux-about');
    }

    /**
     * Remove redux demo link
     *
	 * @access public
	 * @since  1.0
	 * @return void     
     */ 
    public function remove_demo_link() {
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
        }
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
        }    	
    }

} // end class