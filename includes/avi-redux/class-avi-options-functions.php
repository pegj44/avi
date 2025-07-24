<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme options functions class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Options_Functions {

    /**
     * Avi options array.
     *
     * @static
     * @access public
     * @var array
     */
    public static $option = array(); 

    /**
     * Constructor
     *
     * @access public
     */
    public function __construct() {

        self::$option = Avi_Options::$option_arr;

        add_action( 'wp_enqueue_scripts', array( $this, 'get_custom_css' ), 30 );
        add_action( 'wp_head', array( $this, 'get_header_script' ) );
        add_action( 'wp_footer', array( $this, 'get_footer_scripts' ), 20 );

        add_action( 'redux/options/'. Avi_Options::$option .'/saved', array( $this, 'avi_option_update' ) );
        add_action( 'redux/options/'. Avi_Options::$option .'/reset', array( $this,  'avi_option_update' ) );
        add_action( 'redux/options/'. Avi_Options::$option .'/section/reset', array( $this,  'avi_option_update' ) );

        add_action( 'update_option_site_icon', array( $this, 'update_site_icon' ) );
        add_action( 'update_option_blogname', array( $this, 'update_site_title' ) );
        add_action( 'update_option_blogdescription', array( $this, 'update_site_tagline' ) );
        add_action( 'update_option_posts_per_page', array( $this, 'update_post_num' ) );
        add_action( 'customize_save_after', array( $this, 'avi_update_custom_css' ) );

        add_action( 'widgets_init', array( $this, 'footer_widget_areas_init' ), 10 );
        add_action( 'widgets_init', array( $this, 'custom_widgets_init' ), 20 );

    }

    /**
    * Enqueue custom inline css
    */    
    public function get_custom_css() {

        wp_add_inline_style( 'avi-main', self::$option->{'avi-custom-css'} );
    }

    /**
     * Enqueue header inline script
     */    
    public function get_header_script() {
 
        if( trim(self::$option->{"avi-header-scripts"}) ) {
            echo '<script>'. self::$option->{"avi-header-scripts"} .'</script>';    
        }
    }

    /**
     * Print options conditional script
     */        
    public function get_footer_scripts() {

        // insert template conditional scripts here
        if( trim(self::$option->{"avi-footer-scripts"}) ) {
            echo '<script>'. self::$option->{"avi-footer-scripts"} .'</script>';    
        }
    }

    /**
     * Update wp options from theme options
     */
    public function avi_option_update() {    

        $option = get_option('avi_option');

        // Update site icon from theme options  
        if( isset($option['avi-favicon']['id']) ) {
            $icon = sanitize_text_field( $option['avi-favicon']['id'] );
            if( $icon ) {
                update_option( 'site_icon', $icon, false );  
            }            
        }

        // Update site title and description from theme options
        $title   = sanitize_text_field( $option['avi-site-title'] );
        $tagline = sanitize_text_field( $option['avi-site-tagline'] );
        if( ! empty( $title ) ) { update_option( 'blogname', $title, false ); }    
        if( ! empty( $tagline ) ) { update_option( 'blogdescription', $tagline, false ); }    

        // Update number of blog pages from theme options
        $num = $option['avi-archive-num-posts'];
        if( ! empty( $num ) ) { update_option( 'posts_per_page', $num, false ); }

        // Update custom css from customizer on theme option custom css save
        wp_update_post( array( 'ID' => get_theme_mod('custom_css_post_id'), 'post_content' => $option['avi-custom-css'] ) );        
    }
    
    /**
    * Update site icon from wp options
    */    
    public function update_site_icon() {

        $option = get_option('avi_option');
        $icon   = get_option('site_icon');
        $full   = wp_get_attachment_image_src(get_option('site_icon'), 'full');
        $thumb  = wp_get_attachment_image_src(get_option('site_icon'), 'thumbnail');

        $option['avi-favicon'] = array(
                'url' => $full[0],
                'id' => (int) $icon,
                'height' => (string) $full[1],
                'width' => (string) $full[2],
                'thumbnail' => $thumb[0],
            );

        update_option( 'avi_option', $option, false );            
    }

    /**
    * Update site title from wp options
    */    
    public function update_site_title() {

        $title = get_option('blogname');
        $option = get_option('avi_option');

        if( isset($option['avi-site-title']) ) { $option['avi-site-title'] = $title; }
        if( !empty( $option ) ) { update_option( 'avi_option', $option, false ); }
    }

    /**
    * Update site tagline from wp options
    */    
    public function update_site_tagline() {

        $tagline = get_option('blogdescription');
        $option = get_option('avi_option');

        if( isset($option['avi-site-tagline']) ) { $option['avi-site-tagline'] = $tagline; }
        if( ! empty( $option ) ) { update_option( 'avi_option', $option, false ); }
    }

    /**
    * Update number of blog pages from wp options
    */    
    public function update_post_num() {

        $num = get_option('posts_per_page');
        $option = get_option('avi_option');
        $option['avi-archive-num-posts'] = $num; 
        
        update_option( 'avi_option', $option, false );
    }

    /**
    * Update theme option custom css on customizer custom css save.
    */    
    public function avi_update_custom_css() {

        $option = get_option('avi_option');
        $css = get_post_field('post_content', get_theme_mod('custom_css_post_id'), 'raw');

        $option['avi-custom-css'] = $css;
        update_option( 'avi_option', $option, false );
    }

    /**
    * Register custom widget area defined from theme options custom sidebar
    */        
    public function custom_widgets_init() {

        if( ! empty( self::$option->{'avi-custom-sidebar'} ) ) {

            foreach ( array_filter( self::$option->{'avi-custom-sidebar'} ) as $value) {

                register_sidebar( array(
                    'name'          => __( $value, 'avi' ),
                    'id'            => strtolower( str_replace( ' ', '-', $value ) ),
                    'description'   => __( 'Custom widget area.', 'avi' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3 class="widget-title">',
                    'after_title'   => '</h3>',
                ) );
            }
        }
    }

    /**
    * Register footer widget area depending on footer column
    */  
    public function footer_widget_areas_init() {

        $footer_col = self::$option->{'avi-footer-col'};

        $fcol = array(
            'one' => 1,
            'two' => 2,
            'two_b' => 2,
            'two_c' => 2,
            'two_d' => 2,
            'two_e' => 2,
            'three' => 3,
            'three_b' => 3,
            'four' => 4,
            'four_b' => 4,
            'six' => 6,
        );

        for ( $i=1; $i <= $fcol[$footer_col] ; $i++ ) { 
            register_sidebar( array(
                'name'          => __( 'Footer Column '. $i, 'avi' ),
                'id'            => 'footer-col'. $i .'-widget',
                'description'   => __( 'Appears on footer col '. $i, 'avi' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget-title">',
                'after_title'   => '</h4>',
            ) );
        }        
    }

    /**
    * Render color scheme selection
    *
    * @static
    * @access public
    * @return array
    */    
    public static function color_selection() {        

        $scheme = apply_filters('avi_color_scheme', array(
                        '#1ABC9C',
                        '#27ae60',
                        '#D24D57',
                        '#EF4836',
                        '#D2527F',
                        '#663399',
                        '#BF55EC',
                        '#4183D7',
                        '#336E7B',
                        '#26A65B',
                        '#F89406',
                        '#6C7A89',
                        '#BDC3C7'
                    ));

        $colors = array();

        foreach ($scheme as $key => $value) {    
            $paint = explode(',', $value);
            $colors[preg_replace('/#/', '', $value)] = '<div class="color-item" style="background: '. $paint[0] .';"><i class="el el-check"></i></div>';
        }

        return $colors;
    }

    /**
    * Get social share list
    *
    * @static
    * @access public
    * @param string
    * @return array
    */    
    public static function get_share_buttons($val = '') {

        $param = ( '' !== $val )? $val : 'title';

        $socials = self::set_share_buttons();
        $items = array();   

        foreach ($socials as $key => $value) {
            $$param = '';
            extract($value);
            $items[$key] = $$param;
        }
        return $items;
    }

    /**
    * Set social share buttons
    *
    * @static    
    * @access public
    * @return array
    */  
    public static function set_share_buttons() {

        $socials = array(
            'facebook' => array( 
                'title' => 'Facebook', 
                'link' => 'http://www.facebook.com/sharer.php?u={url}', 
                'icon' => 'icon-facebook',
                'class' => 'avi-share-btn si-facebook' 
            ),
            'twitter' => array(
                'title' => 'Twitter', 
                'link' => 'http://twitter.com/share?url={url}&text={title}', 
                'icon' => 'icon-twitter',
                'class' => 'avi-share-btn si-twitter' 
            ),
            'pinterest' => array( 
                'title' => 'Pinterest', 
                'link' => "javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());", 
                'icon' => 'icon-pinterest',
                'class' => 'si-pinterest' 
            ),
            'gplus' => array( 
                'title' => 'Google Plus', 
                'link' => 'https://plus.google.com/share?url={url}',
                'icon' => 'icon-google-plus', 
                'class' => 'avi-share-btn si-google' 
            ),
            'linkedin' => array( 
                'title' => 'Linkedin', 
                'link' => 'http://www.linkedin.com/shareArticle?mini=true&url={url}', 
                'icon' => 'icon-linkedin',
                'class' => 'avi-share-btn si-linkedin' 
            ),
            'tumblr' => array( 
                'title' => 'Tumblr', 
                'link' => 'http://www.tumblr.com/share/link?url={url}', 
                'icon' => 'icon-tumblr',
                'class' => 'avi-share-btn si-tumblr'
            ),
            'reddit' => array( 
                'title' => 'Reddit', 
                'link' => 'http://reddit.com/submit?url={url}&text={title}', 
                'icon' => 'icon-reddit',
                'class' => 'avi-share-btn si-reddit' 
            ),
            'stumbleupon' => array( 
                'title' => 'StumbleUpon', 
                'link' => 'http://www.stumbleupon.com/submit?url={url}&text={title}', 
                'icon' => 'icon-stumbleupon',
                'class' => 'avi-share-btn si-stumbleupon' 
            ),
            'vk' => array( 
                'title' => 'VKontakte', 
                'link' => 'http://vkontakte.ru/share.php?url={url}', 
                'icon' => 'icon-vk',
                'class' => 'avi-share-btn si-vk'
            ),
            'digg' => array( 
                'title' => 'Digg', 
                'link' => 'http://www.digg.com/submit?url={url}', 
                'icon' => 'icon-digg',
                'class' => 'avi-share-btn si-digg' 
            ),
            'buffer' => array( 
                'title' => 'Buffer', 
                'link' => 'https://bufferapp.com/add?url={url}&text={title}', 
                'icon' => 'icon-buffer',
                'class' => 'avi-share-btn si-buffer' 
            ),
        );

        return $socials;
    }

    /**
    * Set social media list
    *
    * @static    
    * @access public
    * @return array
    */  
    public static function set_social_media() {

        $socials = array(
                array(
                    'id'          => 'avi-dribbble',
                    'type'        => 'text',
                    'title'       => __( 'Dribbble', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-dribbble',
                    'class'       => 'si-dribbble',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-facebook',
                    'type'        => 'text',
                    'title'       => __( 'Facebook', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-facebook',
                    'class'       => 'si-facebook',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-twitter',
                    'type'        => 'text',
                    'title'       => __( 'Twitter', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-twitter',
                    'class'       => 'si-twitter',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-delicious',
                    'type'        => 'text',
                    'title'       => __( 'Delicious', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-delicious',
                    'class'       => 'si-delicious',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-flickr',
                    'type'        => 'text',
                    'title'       => __( 'Flickr', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-flickr',
                    'class'       => 'si-flickr',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-google-plus',
                    'type'        => 'text',
                    'title'       => __( 'Google Plus', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-google-plus',
                    'class'       => 'si-google',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-lastfm',
                    'type'        => 'text',
                    'title'       => __( 'Lastfm', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-lastfm',
                    'class'       => 'si-lastfm',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-linkedin',
                    'type'        => 'text',
                    'title'       => __( 'Linkedin', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-linkedin',
                    'class'       => 'si-linkedin',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-vimeo',
                    'type'        => 'text',
                    'title'       => __( 'Vimeo', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-vimeo',
                    'class'       => 'si-vimeo',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-youtube',
                    'type'        => 'text',
                    'title'       => __( 'Youtube', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-youtube',
                    'class'       => 'si-youtube',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-tumblr',
                    'type'        => 'text',
                    'title'       => __( 'Tumblr', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-tumblr',
                    'class'       => 'si-tumblr',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-pinterest',
                    'type'        => 'text',
                    'title'       => __( 'Pinterest', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-pinterest',
                    'class'       => 'si-pinterest',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-skype',
                    'type'        => 'text',
                    'title'       => __( 'Skype', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-skype',
                    'class'       => 'si-skype',
                ),
                array(
                    'id'          => 'avi-github',
                    'type'        => 'text',
                    'title'       => __( 'Github', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-github',
                    'class'       => 'si-github',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-instagram',
                    'type'        => 'text',
                    'title'       => __( 'Instagram', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-instagram',
                    'class'       => 'si-instagram',
                    'validate'    => 'url',
                ),
                array(
                    'id'          => 'avi-stumbleupon',
                    'type'        => 'text',
                    'title'       => __( 'Stumbleupon', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'icon'        => 'icon-stumbleupon',
                    'class'       => 'si-stumbleupon',
                    'validate'    => 'url',
                ),        
            );

        usort($socials, function( $arr1, $arr2 ) {
            return strcmp($arr1["title"], $arr2["title"]);
        });

        return $socials;
    }

    /**
    * Get social media list
    *
    * @static    
    * @access public
    * @return array
    */  
    public static function get_social_media() {

        return self::set_social_media();
    }

} // end class