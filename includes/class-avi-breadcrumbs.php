<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Breadcrumbs
 *
 * Class Name: Avi_Breadcrumbs
 * @package avi
 * @version 1.0
 */
class Avi_Breadcrumbs {

    /**
    * The page type
    *
    * @static
    * @access private
    * @var string
    */
    private static $p_type = 'none';

    /**
    * The current page
    *
    * @static
    * @access private
    * @var string
    */    
    private static $current = '';

    /**
    * The terms array
    *
    * @static
    * @access private
    * @var string
    */    
    private static $terms_arr = array();

    /**
    * The breadcrumbs prepend
    *
    * @static
    * @access private
    * @var string
    */    
    private static $prepend = '';

    /**
    * The breadcrumbs separator
    *
    * @static
    * @access private
    * @var string
    */    
    private static $sep = 'breadcrumb-sep';    

    /**
    * The breadcrumbs array
    *
    * @access public
    * @var string
    */
    public $crumbs_arr = array();

    /**
    * The Constructor
    *
    * @access public
    */
    function __construct() {

        global $avi;        

        $this->crumbs_arr[] = array( 'name' => __('Home', 'avi'), 'url' => get_site_url());

        add_action( 'avi_breadcrumbs', array( $this, 'avi_breadcrumbs' ), 10, 1 );
        add_filter( 'avi_breadcrumb_main_taxonmy', array( $avi, 'filter' ) );
        add_filter( 'avi_breadcrumbs_arr', array( $avi, 'filter' ) );
        add_filter( 'avi_breadcrumb_main_term', array( $avi, 'filter' ) );
    }

    /**
    * Call page type functions
    *    
    * @access public
    * @since  1.0
    * @param  string    The breadcrumbs separator
    * @return void
    */
    public function avi_breadcrumbs($separator = '') {

        global $option;

        if( !$option['avi-breadcrumbs'] ) { return false; }

        self::$sep = ( $separator === '' ? $option['avi-bc-separator'] : esc_attr( $separator ) );
        $this->get_page_type();

        call_user_func( array($this, 'type_'. self::$p_type ) );
         
        $this->render_path();
    }

    /**
    * Get current page type: $p_type
    *
    * @access public
    * @since  1.0
    * @return void
    */
    public function get_page_type() {

        global $wp_query;

        $types = array(
            'single'     => ( $wp_query->is_single && !$wp_query->is_attachment ),
            'attachment' => $wp_query->is_attachment,
            'page'       => $wp_query->is_page,
            'date'       => $wp_query->is_date,
            'author'     => $wp_query->is_author,
            'category'   => $wp_query->is_category,
            'tag'        => $wp_query->is_tag,
            'tax'        => $wp_query->is_tax,
            'search'     => $wp_query->is_search,
            'error'      => $wp_query->is_404,
            'home'       => $wp_query->is_home,
            'post_type_archive' => $wp_query->is_post_type_archive,            
        );

        $types = array_filter( $types );

        if( !empty($types) ) {
            self::$p_type = key( $types );    
        }
    }

    /**
    * Home trail.
    *
    * @access public
    * @since  1.0
    * @return void
    */
    public function type_home() {
    
        global $wp_query;

        $front = get_option( 'page_on_front' );
        $blog  = get_option( 'page_for_posts' );

        if( !$front && $wp_query->queried_object === null ) {
            self::$prepend  = '<li class="active"><i class="icon-home2"></i>'. __('Home', 'avi') .'</li>';            
        }

        if( $blog && $wp_query->queried_object !== null ) {
            self::$current = $wp_query->queried_object->post_title;
        }
    }

    /**
    * Single post type trail.
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function type_single() {

        global $post;

        $this->set_post_archive_trail();

        $taxonomy  = apply_filters('avi_breadcrumb_main_taxonmy', 'category');        
        $terms = wp_get_object_terms( $post->ID, $taxonomy );

        if( !empty($terms) ) {

            foreach ($terms as $key => $val) {
                if( !$val->parent ) {
                    unset($terms[$key]);
                }
            }

            if( !empty($terms) ) {

                $term = array_values($terms);

                self::$terms_arr[] = $term[0];
                $main_term = apply_filters('avi_breadcrumb_main_term', $term[0]->term_id );

                $this->term_parents_trail( $main_term, $taxonomy );
            }
        }

        $this->set_terms_trail();

        self::$current = get_the_title($post->ID);
    }

    /**
    * Set term parents trail.
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function term_parents_trail( $term_id, $taxonomy ) {

        $ancestors = get_ancestors( $term_id, $taxonomy );

        if( !empty($ancestors) ) {

            $ancestors = array_reverse($ancestors);

            foreach ($ancestors as $parent) {

                $term = get_term($parent);

                $this->crumbs_arr[] = array(
                    'name' => $term->name,
                    'url' => get_term_link($parent)
                );                
            }
        }

    }

    /**
    * Get post type main term.
    *
    * @access public
    * @since  1.0    
    * @return object
    */
    public function get_main_term( $terms ) {

        if( !empty($terms) ) {

            foreach ($terms as $key => $val) {
                if( !$val->parent ) {
                    unset($terms[$key]);
                }
            }

            $term = array_values($terms);

            self::$terms_arr[] = $term[0];

            return $term[0];
        }

        return false;
    }

    /**
    * Set post type archive trail.
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function set_post_archive_trail() {

        $post_type = get_post_type();        

        if( $post_type === 'post' ) {

            $post_page = get_option( 'page_for_posts' );
            $ancestors = get_ancestors( $post_page, 'page', 'post_type' );
        
            if( !empty($ancestors) ) {
                asort($ancestors);
                foreach ($ancestors as $id) {                        
                    $this->crumbs_arr[] = array(
                            'name' => get_the_title($id),
                            'url' => get_the_permalink($id)
                        );
                }
            }

            if( $post_page ) {
                $this->crumbs_arr[] = array(
                        'name' => get_the_title($post_page),
                        'url' => get_the_permalink($post_page)
                    );                    
            }
        } else {

            $archive_link = get_post_type_archive_link($post_type);

            if( $archive_link ) {
                $obj = get_post_type_object($post_type);
                $this->crumbs_arr[] = array(
                        'name' => $obj->labels->name,
                        'url' => $archive_link
                    );  
            }
        }
    }

    /**
    * Set terms trail from $terms_arr.
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function set_terms_trail() {

        if( !empty(self::$terms_arr) ) {
            asort(self::$terms_arr);

            foreach (self::$terms_arr as $term) {
                
                $this->crumbs_arr[] = array(
                        'name' => $term->name,
                        'url' => get_term_link($term->term_id)
                    );                  
            }
        }
    }

    /**
    * Page trail.
    *
    * @access public
    * @since  1.0      
    * @return void
    */
    public function type_page() {

        $front = (int) get_option('page_on_front');
        $id = get_the_ID();

        if( $front !== $id ) {            
            $items = get_post_ancestors($id);        
            sort($items);

            if( !empty($items) ) {
                foreach ($items as $item) {
                    $this->crumbs_arr[] = array(
                            'name' => get_the_title($item),
                            'url' => get_the_permalink($item)
                        );
                }
            }

            self::$current = get_the_title($id);
        } else {
            self::$prepend  = '<li class="active"><i class="icon-home2"></i>'. __('Home', 'avi') .'</li>';
        }
    }

    /**
    * Date trail.
    *
    * @access public
    * @since  1.0      
    * @return void
    */
    public function type_date() {

        global $wp_query;

        $year  = get_the_date('Y');
        $month = get_the_date('m');
        $day   = get_the_date('d');
        $time  = get_the_date('His');
        $site  = get_site_url();

        $freqs = array( 
            'year' => array( $year, $year ),
            'month' => array( get_the_date('M'), $year . $month ), 
            'day' => array( get_the_date('D'), $year . $month . $day ), 
            'time' => array( get_the_date('G:i:s'), $year . $month . $day . $time)
        );        

        $is_freq = array();
        foreach ($freqs as $fkey => $fval) {
            $freq_str = 'is_'. $fkey;
            $is_freq[$fkey] = $wp_query->$freq_str;
        }

        $freq = array_filter($is_freq);
        $freq = array_keys($freq);
        $freqs_key = array_keys($freqs);
        $curr_freq = array_search($freq[0], $freqs_key);

        $loop = 1;
        $key  = 0;
        while ( $loop <= $curr_freq ) {

            $freq_key = $freqs_key[$key++];

            $this->crumbs_arr[] = array(
                    'name' => $freqs[$freq_key][0],
                    'url' => $site .'?m='. $freqs[$freq_key][1]
                );
            $loop++;
        }     
        
        self::$current = $freqs[$freq[0]][0];
    }

    /**
    * Author trail.
    *
    * @access public
    * @since  1.0      
    * @return void
    */
    public function type_author() {

        $this->set_post_archive_trail();
        self::$current = __('Articles by: ', 'avi') . ucwords(get_the_author());
    }

    /**
    * Category trail.
    *
    * @access public
    * @since  1.0      
    * @return void
    */
    public function type_category() {

        global $wp_query;

        $term = $wp_query->queried_object;

        $this->set_post_archive_trail();
        $this->term_parents_trail($term->term_id, $term->taxonomy);
        $this->set_terms_trail();

        self::$current = $term->name;
    }

    /**
    * Tags trail.
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function type_tag() {

        global $wp_query;

        $term = $wp_query->queried_object;
        $this->set_post_archive_trail();
        self::$current = $term->name;
    }

    /**
    * Taxonomy trail.
    *
    * @access public
    * @since  1.0
    * @return void
    */
    public function type_tax() {

        $this->type_category();
    }

    /**
    * Search trail.
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function type_search() {

        self::$current = __('Search results for: ', 'avi') . wp_trim_words(esc_html( $_GET['s'] ), 5, '...');
    }

    /**
    * 404 trail.
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function type_error() {

        self::$current = '404';
    }

    /**
    * Post archive trail
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function type_post_type_archive() {

        global $wp_query;

        self::$current = $wp_query->queried_object->label;
    }

    /**
    * Attachment trail
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function type_attachment() {

        global $wp_query;

        self::$current = __('Attachment: ') . $wp_query->queried_object->post_title;        
    }

    /**
    * Fall back function if page type does not exist.
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function type_none() {

        // nothing here.
    }

    /**
    * Render breadcrumbs trail
    *
    * @access public
    * @since  1.0    
    * @return void
    */
    public function render_path() {

        $out = '';
        $this->crumbs_arr[] = array( 'name' => self::$current, 'url' => '');
        $breadcrumbs = apply_filters('avi_breadcrumbs_arr', $this->crumbs_arr);

        $first = array_shift($breadcrumbs);
        $last = array_pop($breadcrumbs);

        if( $first['name'] !== '' ) {
            $home = ( !empty($breadcrumbs) )? '<a href="'. $first['url'] .'" rel="nofollow">'. esc_html( $first['name'] ) .'</a>' : esc_html( $first['name'] );
            $out .= '<li><i class="icon-home2"></i>'. $home .'</li>';
        }        

        if( !empty($breadcrumbs) ) {

            foreach ($breadcrumbs as $crumb) {
                $out .= '<li><i class="'. self::$sep .'"></i><a href="'. esc_url( $crumb['url'] ) .'" rel="nofollow">'. esc_html( $crumb['name'] ) .'</a></li>';
            }            
        }

        if( $last['name'] !== '' ) {
            $out .= '<li class="active"><i class="'. self::$sep .'"></i>'. esc_html( $last['name'] ) .'</li>';    
        }

        echo '<ol class="breadcrumb">'. $out .'</ol>';
    }

} // end Class

/**
 * Initialize avi breadcrums
 */
function avi_breadcrumbs($sep = '') {

    $avi_breadcrumbs = new Avi_Breadcrumbs();
    $avi_breadcrumbs->avi_breadcrumbs($sep);
}