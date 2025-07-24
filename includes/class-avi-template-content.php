<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme template content class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Template_Content extends Avi_Template_Structure {

	public $page_titlebar;
	private static $page_titlebar_hideall = false;
	private static $singular;
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		global $avi;

		self::$singular = is_singular();

	    // $breadcrumbs = new Avi_Breadcrumbs();

		add_action( 'avi_header', array( $this, 'avi_title_bar' ), 50 );

		add_action( 'avi_page_titlebar', array( $this, 'avi_get_title' ), 10 );
		add_action( 'avi_page_titlebar', array( $this, 'avi_metadata' ), 20 );

		add_action( 'avi_before_loop', array( $this, 'avi_get_title' ) );

		add_action( 'avi_page_after', array( $this, 'avi_get_pagination' ), 10 );
		add_action( 'avi_page_after', array( $this, 'avi_get_article_comments' ), 20 );

		add_action( 'avi_post_after', array( $this, 'avi_get_pagination' ), 10 );
		add_action( 'avi_post_after', array( $this, 'avi_get_article_author' ), 20 );
		add_action( 'avi_post_after', array( $this, 'avi_get_post_related' ), 30 );			
		add_action( 'avi_post_after', array( $this, 'avi_get_article_comments' ), 40 );

		add_action( 'avi_content_before', array( $this, 'avi_get_title' ), 10 );		
		add_action( 'avi_content_before', array( $this, 'avi_metadata' ), 20 );
		add_action( 'avi_content_before', array( $this, 'avi_featured_image' ), 30 );
		add_action( 'avi_content_before', array( $this, 'avi_share_buttons_before' ), 40 );

		add_action( 'avi_content_after', array( $this, 'avi_meta_tags' ), 10 );
		add_action( 'avi_content_after', array( $this, 'avi_share_buttons_after' ), 20 );

		add_filter( 'avi_share_buttons', array($this, 'share_buttons_in'), 10, 1 );

		add_action( 'avi_excerpt', array( $this, 'avi_excerpt' ) );

		add_action( 'before_loop_content', array( $this, 'avi_get_title' ), 10 );
		add_action( 'before_loop_content', array( $this, 'avi_metadata' ), 20 );

		// add_action( 'avi_loop_meta', array( $this, 'avi_metadata' ), 10 );

		add_action( 'avi_paginate', array($this, 'avi_get_pagination') );

		add_action( 'wp_footer', array( $this, 'content_scripts' ), 10 );
		// add_action( 'save_post', array( $this, 'save_post' ) );

		add_action( 'avi_audio_loop',   	 array( $this, 'avi_get_audio_loop' ), 10, 2 );
		add_action( 'avi_gallery_loop', 	 array( $this, 'avi_get_gallery_loop' ), 10, 3 );
		add_action( 'avi_image_loop', 	 array( $this, 'avi_get_image_loop' ), 10, 2 );
		add_action( 'avi_link_loop',   	 array( $this, 'avi_get_link_loop' ), 10, 2 );
		add_action( 'avi_video_loop',   	 array( $this, 'avi_get_video_loop' ), 10, 2 );

		add_filter( 'avi_title', array( $this, 'avi_get_title' ), 10 );
		// add_filter( 'avi_subtitle', array( $this, 'avi_subtitle' ) );
		// add_filter( 'avi_metadata', array( $this, 'avi_metadata' ) );

		// add_filter( 'avi_excerpt', array( $this, 'avi_excerpt' ), 10, 1 );
		// add_filter( 'avi_metadata', array( $this, 'avi_metadata' ), 10, 1 );

		// add_filter( 'get_the_archive_title', array( $this, 'custom_archive_title' ) );
		add_filter( 'post_thumbnail_size', array( $this, 'custom_thumbnail_size' ), 10 );
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'custom_post_thumbnail_html' ) );
		add_filter( 'avi_excerpt_args', array( $avi, 'filter' ) );

	}

	/**
	 * Display page title bar
	 *
  	 * @access public
	 * @since  1.0
	 * @return void	 
	 */
	public function avi_title_bar() {

		$options = $this->option('avi-page-header');	
		$options->{'single'} = $this->option('avi-page-header')->blog;

		$page_titlebar = $this->get_window_option( 'avi-page-header', $options );
		$this->page_titlebar = ( $page_titlebar && $page_titlebar !== 'content' )? 1: 0;

		if( self::$singular ) {
			$hideall = get_field('avi-page-header');
			if( $hideall === 'disable' ) {
				self::$page_titlebar_hideall = true;
			}
		}

		if( $this->page_titlebar ) {

			$styles = array();
			$data['style'] = array();			
			$data['dark'] = '';
			
			if( self::$singular ) {

				$bgColor  = get_field('avi_page_bg_color');
				$bgSize   = get_field('avi_page_header_bg_size');
				$bgImage  = get_field('avi_page_header_bg_img');

				$styles[] = ( $bgColor )? $bgColor : 0;
				$styles[] = ( $bgImage )? 'url('. esc_url( $bgImage ) .')' : 0;	

				if( $bgImage ) {			
					$styles[] = ( $bgSize !== 'no-repeat' )? preg_replace( array('/_/', '/slash/'), array(' ', '/'), $bgSize) : $bgSize;					
				}
				
				$styles = array_filter($styles);

				if( !empty($styles) ) {
					$styles = 'background: '. implode(' ', $styles) .';';
				}				

				$data['style'] = $styles;

				if( $this->is_true( get_field('avi_page_header_dark') )  ) {
					$data['dark'] = 'dark';
				}
			}

			$this->avi_template('content/asides/page-title-bar', $data);						
		}
	}

	/**
	 * Get page title bar heading
	 *
  	 * @access public
	 * @since  1.0
	 * @return void	 
	 */
	public function avi_get_title() {		

		global $wp_current_filter;

		$page_titlebar  = in_array( 'avi_page_titlebar', $wp_current_filter );
		$before_loop 	= in_array( 'avi_before_loop', $wp_current_filter );		
		$loop_content   = in_array( 'before_loop_content', $wp_current_filter);
		$content_before = in_array( 'avi_content_before', $wp_current_filter );	
		$single_title   = in_array( 'avi_title' , $wp_current_filter);

		if( $before_loop && !self::$singular && $this->page_titlebar ||
			$before_loop && self::$singular ||
			$content_before && self::$singular && $this->page_titlebar ||
			$single_title && self::$singular && $this->page_titlebar ||
			$loop_content && self::$singular && $this->page_titlebar ||
			self::$page_titlebar_hideall ) {
			return false;
		}

		global $option;

		$title = get_the_title();

		if( !$page_titlebar && !$before_loop && !self::$singular ) {
			$title = '<a href="'. get_the_permalink() .'" title= "'. $title .'">'. $title .'</a>';
		}

		if( $before_loop && !self::$singular || $page_titlebar && !self::$singular ) {
			$title = get_the_archive_title();
		}

		$title = apply_filters( 'get_the_title', $title );
		$subtitle = '';

		if( self::$singular && get_field('avi-page-subheading')) {
			$subtitle = apply_filters( 'avi_subtitle', '<span>'. get_field('avi-page-subheading') .'</span>' );
		}
		if( !$loop_content && is_home() && $this->is_true( $this->option('avi-blog-subheader-txt') ) ) {
			$subtitle = apply_filters( 'avi_subtitle', '<span>'. $this->option('avi-blog-subheader-txt') .'</span>' );
		}

		if( $this->get_window() === 'shop' && $this->is_true( $this->option('avi-shop-subheader-txt') ) && !self::$singular ) {
			$subtitle = apply_filters( 'avi_subtitle', '<span>'. $this->option('avi-shop-subheader-txt') .'</span>' );
		}

		if( !$page_titlebar ) {
			echo  apply_filters( 'avi_get_title', '<div class="entry-title"><h2>'. $title . $subtitle .'</h2></div>' );
		} else {			
			echo apply_filters( 'avi_get_title', '<h1>'. $title .'</h1>'.  $subtitle );
		}

	}

	/**
	 * Get page/post metadata
	 *
  	 * @access public
	 * @since  1.0
	 * @param  array
	 * @return void	 
	 */
	public function avi_metadata() {

		global $wp_current_filter;

		$page_titlebar  = in_array( 'avi_page_titlebar', $wp_current_filter );
		$before_loop 	= in_array( 'avi_before_loop' , $wp_current_filter );
		$content_before = in_array( 'avi_content_before' , $wp_current_filter );	
		$loop_content   = in_array( 'before_loop_content', $wp_current_filter);
		$hasmetadata = $this->get_window_option( 'avi-postpage-meta', array(), false );

		if( $before_loop && !self::$singular && $this->page_titlebar ||
			$before_loop && self::$singular ||
			$content_before && self::$singular && $this->page_titlebar ||
			$loop_content && self::$singular && $this->page_titlebar ||
			$page_titlebar && !self::$singular ||
			!$hasmetadata && self::$singular ||
			self::$page_titlebar_hideall ) {
			return false;
		}

		global $post;

		$fields = ( self::$singular )? $this->option('avi-singular-meta') : $this->option('avi-archive-meta');
		$fields = (array) $fields;
		$fields = array_filter($fields);
		$fields = array_keys($fields);
		$fields = apply_filters( 'avi_metadata', $fields );				
		$metadata = array('date', 'author', 'comments', 'category', 'format');
		$fieldIn  = array_intersect($metadata, $fields);
		$icons = array(
				'format'  => 'icon-pushpin',
				'aside'   => 'icon-file-alt',
				'audio'   => 'icon-music2',
				'gallery' => 'icon-line-layers',
				'image'   => 'icon-picture',
				'link'    => 'icon-link',
				'quote'   => 'icon-quote-left',
				'status'  => 'icon-chat-3',
				'video'   => 'icon-film',
				'chat'	  => 'icon-chat-3'
			);

		$format = 0;
		$category  = 0;

		if( !is_page() ) {

			if( in_array('format', $fieldIn) ) {
				$postFormat = get_post_format($post->ID);
				$format = (!$postFormat)? '<i class="'. $icons['format'] .'"></i>' : '<a href="'. get_post_format_link($postFormat) .'"><i class="'. $icons[$postFormat] .'"></i></a>';
			}
		
			if( in_array( 'category', $fieldIn) ) {
				$cats = array();
				foreach (get_the_category($post->ID) as $cat) {
					$cats[] = '<a href="'. get_category_link($cat->term_id) .'">'. $cat->name .'</a>';
				}

				if( !empty($cats) ) {
					$category = implode(', ', $cats);
				}
			}
		}

		if( in_array('comments', $fieldIn) ) {
			$comments = (get_comments_number($post->ID))? '<a href="'. get_comments_link($post->ID) .'">'. get_comments_number($post->ID) .'</a>' : 0;
		}		

		if( in_array('date', $fieldIn) ) {
			$date = '<a href="'. get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')) .'">'. get_the_date() .'</a>';
		}

		if( in_array('author', $fieldIn) ) {
			$author = '<a href="'. get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ), get_the_author_meta( 'user_nicename', $post->post_author ) ) .'">'. get_the_author_meta( 'display_name', $post->post_author ) .'</a>';
		}

		$fields = array();
		foreach ($fieldIn as $field) {
			$fields[$field] = $$field;
		}

		$data['fields'] = array_filter($fields);
		
		if( !empty( $data['fields'] ) ) {
			$this->avi_template('content/asides/metadata', $data);
		}		
	}
	
	public function avi_featured_image() {
		
		$this->avi_template('content/asides/featured-image');
	}

	/**
	 * Display share buttons before content
	 */
	function avi_share_buttons_before() {
		$this->avi_share_buttons('before');
	}

	/**
	 * Display share buttons after content
	 */
	function avi_share_buttons_after() {
		$this->avi_share_buttons('after');
	}

	function share_buttons_in($post_types = array()) {

		// $post_types = $this->get_display_in('avi-share-buttons-in', $post_types);

		return $post_types;
	}

	function avi_share_buttons($pos = 'before') {

		$ptypes = (array) $this->option('avi-share-buttons-in');
		$ptypes = array_filter($ptypes);
		$ptypes = array_keys($ptypes);
		$bttons = apply_filters('avi_share_buttons', $ptypes);

		$window = preg_replace(array('/single/', '/shop/'), array('post', 'product'), $this->get_window());

		if( in_array($window, $bttons) ) {
			$arr['before'] = array('before', 'both', 'fleft', 'fright');
			$arr['after']  = array('after', 'both');

			if( in_array($this->option('avi-display-socials'), $arr[$pos]) && apply_filters('avi_display_share_buttons', true) ) {
				$this->avi_get_share_buttons();
			}
		}
	}

	/**
	 * Render share buttons
	 */
	function avi_get_share_buttons() { 
		
		$socialIn = $this->option('avi-enabled-share-buttons');

		if(isset($socialIn->Enabled->placebo)) { unset($socialIn->Enabled->placebo); }		

		$float = '';
		$data['isfloat'] = '';

		if( $this->option('avi-display-socials') == 'fleft' ) { $float = 'si-sticky'; $data['isfloat'] = 'si-float'; }
		
		$data['sharetxt'] = apply_filters( 'avi_share_text', $this->option('avi-share-text') );
		$data['float'] = $float;
		$data['socials'] = array_intersect_key(Avi_Options_Functions::set_share_buttons(), (array) $socialIn->Enabled);

		$this->avi_template('content/asides/socials', $data);
	}

	/**
	 * Get post excerpt
	 *
  	 * @access public
	 * @since  1.0
	 * @param  array
	 * @return string 
	 */
	public function avi_excerpt( $args = array() ) {

		$default = array(
			'content' => get_the_excerpt(), // text to trim
			'more' =>  '...',  // text right after content
			'before' => '<p>', // before content wrapper
			'after' => '</p>', // after content wrapper
			'read_more' => '<a href="'. get_the_permalink() .'" class="more-link">'. __('Read More', 'avi') .'</a>', // after "after" wrapper
			'num_words' => 50 // number of allowed words
		);

		$args = wp_parse_args( $args, $default );
		$args = apply_filters( 'avi_excerpt_args', $args );

		extract($args);

	    $out = preg_replace('/\[[\s\S]+?\]/', '', $content);
	    $out = $before . apply_filters( 'get_the_excerpt', wp_trim_words( $out, $num_words, $more ) ) . $after;
	    $out .= $read_more;

	    echo $out;
	}

	/**
	 * Post Author
	 */
	function avi_get_article_author() {

		if( $this->option('avi-post-author') ) {
			$this->avi_template('content/asides/author');
		}
	}

	/**
	 * Related posts
	 */
	function avi_get_post_related() {		

		if( $this->option('avi-single-post-show-related') ) {

			$tags = array();
			foreach ( wp_get_post_tags(get_the_ID()) as $tag ) {
				$tags[] = $tag->term_id;
			}

			$args = array(
				    'post_type'      => 'post',
				    'posts_per_page' => 4,
				    'post_status'    => 'publish',
				    'post__not_in'   => array( get_the_ID() ),
				    // 'orderby'        => 'rand',
				    'tax_query'      => array(
				        'relation' => 'OR',
				        array(
				            'taxonomy' => 'category',
				            'fields'   => 'slug',
				            'terms'    => wp_get_post_categories(get_the_ID())
				        ),
				        array(
				            'taxonomy' => 'post_tag',
				            'fields'   => 'slug',
				            'terms'    => $tags
				        ),
				    )
				);

			$data['loop'] = new WP_Query( $args );

			$this->avi_template('content/asides/related_post', $data);

			wp_reset_postdata();
		}
	}

	/**
	 * Article Comments
	 */
	public function avi_get_article_comments() {
		//If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	}

	/**
	 * Add alt and title attributes for post_thumbnail (for SEO)
	 */
	public function custom_post_thumbnail_html($attr) {		

		if( $attr['alt'] === '' ) {
			$attr['alt'] = get_the_title();	
		}
		
		$attr['title'] = get_the_title();

		return $attr;
	}

	/**
	 * Set Custom thumbnail size
	 *
  	 * @access public
	 * @since  1.0
	 * @param  string
	 * @return string 
	 */
	public function custom_thumbnail_size($size) {

		global $avi;

		$sidebar = $avi->template_structure->sidebar;
	    $layout  = $this->option('avi-'. $this->get_window() .'-num-col');
	    $window  = $this->get_window();

	    if( $window === 'blog' || $window === 'archive' ) {
		    if( $layout === 'left' || $layout === 'right' || $layout === 'alternate' ) {
		        $size = 'thumb-400x300';
		    } elseif( $layout === 1 && !$sidebar->count ) {
		        $size = 'full';
		    } elseif( $layout === '1' && $sidebar->count === 1 ) {
		        $size = 'thumb-860x400';
		    } else {
		        $size = 'thumb-520x280';
		    }
	    }

	    return $size;
	}

	/**
	 * Pagination
	 */
	function avi_pagination() {

		global $wp_query;

        if( self::$singular )
            return;

        /** Stop execution if there's only 1 page */
        if( $wp_query->max_num_pages <= 1 )
            return;

        $data['paged'] = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $data['max']   = intval( $wp_query->max_num_pages );

        /** Add current page to the array */
        if ( $data['paged'] >= 1 )
            $data['links'][] = $data['paged'];

        /** Add the pages around the current page to the array */
        if ( $data['paged'] >= 3 ) {
            $data['links'][] = $data['paged'] - 1;
            $data['links'][] = $data['paged'] - 2;
        }

        if ( ( $data['paged'] + 2 ) <= $data['max'] ) {
            $data['links'][] = $data['paged'] + 2;
            $data['links'][] = $data['paged'] + 1;
        }

        $this->avi_template('content/asides/pagination', $data);

	} //avi pagination

	/**
	 * Archive pagination
	 */
	function avi_get_pagination() {

		global $wp_query;

		$infi = 0;

		if ( !self::$singular ) {

			if( $wp_query->max_num_pages <= 1 ) { return false; }

			if( $this->get_window_option('avi-infinite-scroll', array(), 0) ) {
				$this->avi_template('content/asides/load-btn');
			} else {
				$this->avi_pagination();
			}

		} else {

			$data['next'] = get_next_post_link('%link &rArr;');
			$data['prev'] = get_previous_post_link('&lArr; %link');

			if( $this->get_window_option('avi-next-prev', array(), 0) && ( $data['next'] || $data['prev'] ) ) {
				$this->avi_template('content/asides/next-prev', $data);
			} 
		}
	}

	/**
	 * Display post meta tags
	 */
	function avi_meta_tags() {
	
		if( !self::$singular ) { return false; }

		$data['posttags'] = get_the_tags();

		if( $this->option('avi-post-tag') && $data['posttags'] ) {
			$this->avi_template('content/asides/tags', $data);
		}
	}	

	/**
	 * Find available audio embed for audio post format loop.
	 */
	function avi_get_audio_loop($before = '', $after = '') {
		global $post;
		$audio = false;

		if( preg_match('/(?:(?:\[playlist.*?\])|(?:\[audio.*?\]))/s', $post->post_content, $playlist) ) {
			$audio = do_shortcode($playlist[0]);
		} elseif( preg_match( '/(?:<iframe.+src="(?:(?:https|https):\/\/w\.soundcloud\.com.+)".+<\/iframe>|<iframe.+src="(?:(?:https|https):\/\/embed\.spotify\.com.+)".+<\/iframe>)/', $post->post_content, $playlist ) ) {
			$audio = $playlist[0];
		} elseif( preg_match( '/(?:<audio[^>]*>.*?<\/audio>)/s' , $post->post_content, $playlist) ) {
			$audio = $playlist[0];
		}

		if( $audio ) {
			echo $before . $audio . $after;	
		}
	}

	/**
	 * Find available gallery embed for gallery post format loop.
	 */
	function avi_get_gallery_loop($before = '', $after = '', $args = array()) {
		global $post;

		$post_num = 9;
		$columns  = 4;
		$databig  = (isset($args['data-big']))? ' data-big="'. $args['data-big'] .'" ' : '';

		extract($args);

		$shortcodes_in = array(		
				'gallery' => 'ids', 
				'avi_carousel' => 'images',
				'vc_masonry_media_grid' => 'include',
				'vc_media_grid' => 'include',			
			);
		$gallery = false;
		$stop = false;

		foreach ($shortcodes_in as $shortcode => $ids) {
			if(preg_match( '/(?:\['. $shortcode .'.*?ids=["|\']([^"|\']+))/', $post->post_content, $match ) && !$stop ) {
				$gallery = do_shortcode('[gallery ids="'. $match[1] .'" link="file" post_num="'. $post_num .'" columns="'. $columns .'"'. $databig .']');
				$stop = true;
			}
		}

		if( preg_match_all('/<img.*?wp-image-(\d+)/', $post->post_content, $id) && !$gallery ) {
			$gallery = do_shortcode('[gallery ids="'. implode(',', $id[1]) .'" link="file" post_num="'. $post_num .'" columns="'. $columns .'"'. $databig .']');
		}

		if( $gallery ) {
			echo $before . $gallery . $after;
		}
	}

	/**
	 * Find available image embed for image post format loop.
	 */
	function avi_get_image_loop($before = '', $after = '') {

		global $post;
		$size = avi_thumb_loop();

		if( preg_match_all('/<img.*?wp-image-(\d+)/', $post->post_content, $image) ) {
			$thumb = wp_get_attachment_image_src($image[1][0], $size);
			$full  = wp_get_attachment_url($image[1][0]);
			$thumb = $thumb[0];
		} elseif( preg_match( '/<img.*src=["|\']([^"|\']+)/', $post->post_content, $image ) ) {
			$thumb = $image[1];
			$full  = $image[1];
		} elseif( preg_match( '/(?:\[vc_single_image.*?image=["|\']([^"|\']+))/', $post->post_content, $image ) ) {
			$thumb = wp_get_attachment_image_src($image[1], $size);
			$full  = wp_get_attachment_url($image[1]);
			$thumb = $thumb[0];
		} elseif ( preg_match('~https?://[^/\s]+/\S+\.(jpg|png|gif|jpeg)~', $post->post_content, $image) ) {
			$thumb = $image[0];
			$full  = $image[0];
		} else {
			$thumb = false;
			$full = '';
		}

		if( $thumb ) {
			$before = str_replace(array('%image_link%', '%title%'), array($full, $post->post_title), $before);			
			echo $before .'<img src="'. $thumb .'" alt="'. $post->post_title .'">'. $after;
		}
	}	

	/**
	 * Find available link for link post format loop.
	 */
	function avi_get_link_loop($before = '', $after = '') {

		global $post;
		preg_match('~<a.href=["|\']([^"|\']+)~', $post->post_content, $link);

		if( !empty($link) ) {
			echo $before . '<a href="'. $link[1] .'" class="entry-link" target="_blank">'. $post->post_title .'<span>- '. $link[1] .'</span></a>' . $after;
		}
	}

	/**
	 * Find available video embed for video post format loop.
	 */
	function avi_get_video_loop($before = '', $after = '') {
		global $post;
		$video = false;

		$iframes_in = array(
				'animoto.com',
				'cloudup.com',
				'players.brightcove.net',
				'collegehumor.com',
				'dailymotion.com',
				'flickr.com',
				'funnyordie.com',
				'hulu.com',
				'ted.com',
				'videopress.com',
				'vimeo.com',
				'vine.co',
				'videopress.com',
				'youtube.com'
			);

		$links   = implode('|', $iframes_in);
		$linkstr = str_replace('.', '\.', $links);

		$shortcode 	 = '/(?:\[video.*?\]|\[playlist.*?type=\"video\".*\]|\[vc_video.*?\])/s';
		$html_embed1 = '/(?:<video[^>]*>.*?<\/video>)/s';
		$html_embed2 = '/(?:<blockquote.*?class="instagram-media".*?<\/blockquote>)/';
		$html_embed3 = '/(<div.class=\"tumblr-post\".data-href=\".+?embed.tumblr.com\/embed\/.*?<\/div>)/';
		$iframe 	 = '/<iframe.*src=[\"\'](\S+(?:'. $linkstr .')\S+)[\"\']/';
		$link 		 = '~\s((?:https|http):\/\/\S+'. $linkstr .'\S+)~';
		$match 		 = '';

		if( preg_match( $shortcode, $post->post_content, $match) ) {
			$video = do_shortcode($match[0]);
		} elseif( preg_match( $html_embed1 , $post->post_content, $match) ) {
			$video = $match[0];
		} elseif( preg_match( $html_embed2 , $post->post_content, $match) ) {
			$video = $match[0] . '<script async defer src="//platform.instagram.com/en_US/embeds.js"></script>';
		} elseif( preg_match( $html_embed3 , $post->post_content, $match) ) {
			$video = $match[0] . '<script async src="https://secure.assets.tumblr.com/post.js"></script>';
		} elseif( preg_match($iframe, $post->post_content, $match) ) {
			$video = '<iframe src="'. $match[1] .'" frameborder="0" allowfullscreen mozallowfullscreen webkitallowfullscreen></iframe>';
		} elseif( preg_match($link, $post->post_content, $match) ) {
			$video = wp_oembed_get($match[1]);
		}

		if( $video ) {
			echo $before . $video . $after;	
		}
	}

	/**
	 * Insert masonry script to wp footer
	 *
  	 * @access public
	 * @since  1.0	 
	 * @return void 
	 */
	public function content_scripts() {	

		$masonry = array();
		$infiscroll = false;

		if( !self::$singular ) {
			$masonry['masonry'] = (int) $this->get_window_option('avi-masonry', array(), 0);
			$masonry['blog'] 	= ( $this->option('avi-blog-num-col') === '5' && is_home())? 1 : 0;
			$masonry['archive'] = ( $this->option('avi-archive-num-col') === '5' && !self::$singular)? 1: 0;
			$masonry = array_filter($masonry);

			$infiscroll = (int) $this->get_window_option('avi-infinite-scroll', array(), 0);
		}

	?>
        <script type="text/javascript">

        	<?php if( !empty($masonry) ) : ?>
	            jQuery(window).load(function() {
	                var $container = $('#posts');
	                $container.isotope({ transitionDuration: '0.65s' });
	                $(window).resize(function() {
	                    $container.isotope('layout');
	                });
	            });
            <?php endif; ?>
            
            <?php if( !empty($infiscroll) ) : ?>
            	jQuery(window).load(function() {
            		var $container = $('#posts');

                    $container.infinitescroll({
                        loading: {
                            finishedMsg: '<i class="icon-line-check"></i>',
                            msgText: '<i class="icon-line-loader icon-spin"></i>',
                            img: "",
                            speed: 'normal'
                        },
                        state: {
                            isDone: false
                        },
                        nextSelector: "#load-next-posts a",
                        navSelector: "#load-next-posts",
                        itemSelector: "div.entry"
                    },
                    function( newElements ) {
                        $('#infscr-loading').remove();

                        <?php if( !empty($masonry) ) : ?>
                            $container.isotope( 'appended', $( newElements ) );
                            var t = setTimeout( function(){ $container.isotope('layout'); }, 2000 );
                        <?php endif; ?>

                        SEMICOLON.initialize.resizeVideos();
                        SEMICOLON.widget.loadFlexSlider();
                        SEMICOLON.widget.masonryThumbs();
                    });	            
				});
			<?php endif; ?>

        </script>

    <?php
	}


	// public function save_post( $post_id ) {

	// 	$title = get_the_title($post_id);

	// 	update_post_meta( $post_id, 'avi-page-heading', $title );
	// }
	

} // end class