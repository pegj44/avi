<?php
/**
 * Icon Box shortcode
 *
 * @package avi
 */

if( function_exists('vc_add_shortcode_param') ) { 

   add_action( 'vc_before_init', 'avi_icon_box' );
   function avi_icon_box() {

      vc_map( array(
         "name" => __( "Icon Box", "avi" ),
         "base" => "avi_icon_box",
         "class" => "",
         "category" => __( "Content", "avi"),
         "params" => array(        
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __( "Title", "avi" ),
               "param_name" => "title",
               "value" => __('Title', 'avi')
            ),
            array(
               "type" => "textarea_html",
               "holder" => "div",
               "class" => "",
               "heading" => __( "Content", "avi" ),
               "param_name" => "content",
            ), 
            array(
               'type' => 'dropdown',
               'heading' => __('Icon Type', 'avi'),
               'param_name' => 'icon_type',
               'value' => array(
                  'Font Awesome' => __('fontawesome', 'js_composer'),
                  'Open Iconic' => __('openiconic', 'js_composer'),
                  'Type Icons' => __('typicons', 'js_composer'),
                  'Entypo' => __('entypo', 'js_composer'),
                  'Linecons' => __('linecons', 'js_composer'),
                  'Mono Social' => __('monosocial', 'js_composer'),
                  'Image' => __('image', 'avi')
               )
            ),
            array(
               'type' => 'attach_image',
               'heading' => __('Icon Image', 'avi'),
               'param_name' => 'icon_image',
               'value' => '',
               'dependency' => array(
                  'element' => 'icon_type',
                  'value' => 'image'
               ),
               'description' => __('Recommended size is 300x300px.')
            ),            
            array(
               'type' => 'iconpicker',
               'heading' => __( "Icon", "avi" ),
               'param_name' => 'icon_fontawesome',
               'settings' => array(
                  'emptyIcon' => true,
                  'type' => 'fontawesome',
                  'iconsPerPage' => 200,
               ),
               'dependency' => array(
                  'element' => 'icon_type',
                  'value' => 'fontawesome',
               )
            ),
            array(
               'type' => 'iconpicker',
               'heading' => __( "Icon", "avi" ),
               'param_name' => 'icon_openiconic',
               'settings' => array(
                  'emptyIcon' => true,
                  'type' => 'openiconic',
                  'iconsPerPage' => 200,
               ),
               'dependency' => array(
                  'element' => 'icon_type',
                  'value' => 'openiconic',
               )
            ),            
            array(
               'type' => 'iconpicker',
               'heading' => __( "Icon", "avi" ),
               'param_name' => 'icon_typicons',
               'settings' => array(
                  'emptyIcon' => true,
                  'type' => 'typicons',
                  'iconsPerPage' => 200,
               ),
               'dependency' => array(
                  'element' => 'icon_type',
                  'value' => 'typicons',
               )
            ),
            array(
               'type' => 'iconpicker',
               'heading' => __( "Icon", "avi" ),
               'param_name' => 'icon_entypo',
               'settings' => array(
                  'emptyIcon' => true,
                  'type' => 'entypo',
                  'iconsPerPage' => 200,
               ),
               'dependency' => array(
                  'element' => 'icon_type',
                  'value' => 'entypo',
               )
            ),
            array(
               'type' => 'iconpicker',
               'heading' => __( "Icon", "avi" ),
               'param_name' => 'icon_linecons',
               'settings' => array(
                  'emptyIcon' => true,
                  'type' => 'linecons',
                  'iconsPerPage' => 200,
               ),
               'dependency' => array(
                  'element' => 'icon_type',
                  'value' => 'linecons',
               )
            ),
            array(
               'type' => 'iconpicker',
               'heading' => __( "Icon", "avi" ),
               'param_name' => 'icon_monosocial',
               'settings' => array(
                  'emptyIcon' => true,
                  'type' => 'monosocial',
                  'iconsPerPage' => 200,
               ),
               'dependency' => array(
                  'element' => 'icon_type',
                  'value' => 'monosocial',
               )
            ),            
            array(
               "type" => "colorpicker",
               "holder" => "div",
               "class" => "",
               "heading" => __( "Icon Color", "avi" ),
               "param_name" => "icon_color",
               'dependency' => array(
                  'element' => 'icon_type',
                  'value' => array(
                     'fontawesome',
                     'openiconic',
                     'typicons',
                     'entypo',
                     'linecons',
                     'monosocial'
                  ),
               )
            ),



         )

      ));

      
   }

}

add_shortcode( 'avi_icon_box', 'avi_icon_box_shortcode' );
function avi_icon_box_shortcode( $atts, $content ) {   

   extract( shortcode_atts( array(
      'icon_type' => 'fontawesome',
      'icon_fontawesome' => '',
      'icon_openiconic' => '',
      'icon_typicons' => '',
      'icon_entypo' => '',
      'icon_linecons' => '',
      'icon_monosocial' => '',
      'icon_image' => '',
      'title' => 'Title',
      'icon_color' => '',
   ), $atts ) );

   if( $icon_type !== 'image' ) {
      $icon = 'icon_'. $icon_type;
      do_action( 'vc_enqueue_font_icon_element', $icon_type );         
   } else {
      $img_id = (int) $icon_image;
      $image = wp_get_attachment_image( $img_id, 'thumb-300x300', true );
   }

   ob_start();
?>

   <div class="fbox-center fbox-plain feature-box noborder bottommargin-sm">
      <div class="fbox-icon">         
         <?php 
            if( $icon_type !== 'image' ) {
               echo '<i class="'. esc_attr($$icon) .'"></i>';
            } else {
               echo $image;
            }
         ?>
      </div>
      <h3><?php esc_html_e($title); ?></h3>
      <p><?php echo $content; ?></p>
   </div>   

<?php   

   return ob_get_clean();
}