<?php 
class new_rwhm_team_viewer extends \Elementor\Widget_Base
{

   public function get_name()
   {
      return 'another_team_viewer';
   }

   public function get_title()
   {
      return esc_html__('another Team Viewer', 'elementor-addon');
   }

   public function get_icon()
   {
      return ' eicon-preferences';
   }

   public function get_categories()
   {
      return ['basic'];
   }

   public function get_keywords()
   {
      return ['another Team viewer', 'hover'];
   }
   protected function _register_controls()
   {
      // Add controls for title.
      $this->start_controls_section(
         'section_title',
         [
            'label' => __('Name', 'my-elementor-addon'),
         ]
      );

      $this->add_control(
         'title_text',
         [
            'label' => __('Your Name:', 'my-elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Lorem', 'my-elementor-addon'),
         ]
      );

      $this->end_controls_section();

      $this->start_controls_section(
         'section_title',
         [
            'label' => __('Profession', 'my-elementor-addon'),
         ]
      );

      $this->add_control(
         'title_sub_text',
         [
            'label' => __('Designation', 'my-elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Lorem', 'my-elementor-addon'),
         ]
      );
   

      $this->end_controls_section();

      // Add controls for text.
      $this->start_controls_section(
         'section_text',
         [
            'label' => __('Description', 'my-elementor-addon'),
         ]
      );

      $this->add_control(
         'text_content',
         [
            'label' => __('Text Content', 'my-elementor-addon'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('My Text Content', 'my-elementor-addon'),
         ]
      );

      $this->end_controls_section();
      // Add controls for image.
      $this->start_controls_section(
         'section_image',
         [
            'label' => __('Image', 'my-elementor-addon'),
         ]
      );

      $this->add_control(
         'image',
         [
            'label' => __('Choose Image', 'my-elementor-addon'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->end_controls_section();
      // Add controls for repeater with icon and link.
      // Add controls for repeater.
      $this->start_controls_section(
         'content_section',
         [
            'label' => esc_html__('Content', 'textdomain'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
         ]
      );

      $this->add_control(
         'list',
         [
            'label' => esc_html__('Repeater List', 'textdomain'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => [
               [
                  'name' => 'list_title',
                  'label' => esc_html__('Title', 'textdomain'),
                  'type' => \Elementor\Controls_Manager::TEXT,
                  'default' => esc_html__('List Title', 'textdomain'),
                  'label_block' => true,
               ],
               [
                  'name' => 'list_content',
                  'label' => esc_html__('Content', 'textdomain'),
                  'type' => \Elementor\Controls_Manager::WYSIWYG,
                  'default' => esc_html__('List Content', 'textdomain'),
                  'show_label' => false,
               ],
               [
                  'name' => 'Icon',
                  'label' => esc_html__('Icons', 'textdomain'),
                  'type' => \Elementor\Controls_Manager::ICONS,

               ]
            ],

            'title_field' => '{{{ list_title }}}',
         ]
      );

      $this->end_controls_section();
   }
   protected function render()
   {
      $settings = $this->get_settings_for_display();

?>

      <div class="rez-single-team-member">
         <div class="rez-single-team-member-inner">
            <?php if (!empty($settings['image']['url'])) { ?>
               <div class="rez-team-member-image">
                  <img src="<?php echo $settings['image']['url']; ?>" />
               </div>

            <?php
            } ?>

            <div class="rez-team-member-info">
               <h3><?php echo  $settings['title_text']  ?></h3>
               <p><?php echo  $settings['title_sub_text']  ?></p>
            </div>
            <div class="rez-team-member-hover">
               <div class="rez-team-member-info">
                  <h3><?php echo  $settings['title_text']  ?></h3>
                  <p><?php echo  $settings['title_sub_text']  ?></p>
               </div>
               <div class="rez-team-member-meta">

                  <?php

                  $settings = $this->get_settings_for_display();
                  $repeater_items = $settings['list'];

                  // Output the icon boxes
                  if (!empty($repeater_items)) {
                     foreach ($repeater_items as $item) {
                        $icon = !empty($item['Icon']) ? '<i class="' . $item['Icon']['value'] . '"></i>' : '';
                        $title = !empty($item['list_title']) ? $item['list_title'] : '';
                        $content = !empty($item['list_content']) ? $item['list_content'] : '';
                        $color = !empty($item['list_color']) ? 'style="color:' . $item['list_color'] . ';"' : '';

                  ?>
                        <i class="<?php echo esc_attr($item['Icon']); ?>" aria-hidden="true"></i>
                  <?php
                        echo '<div class="icon-box" ' . $color . '>';
                        echo $icon;
                        echo '<h3>' . $title . '</h3>';
                        echo '<div class="content">' . $content . '</div>';
                        echo '</div>';
                     }
                  }

                  ?>




               </div>
               <div class="rez-team-details">
                  <?php echo  $settings['text_content']  ?>

               </div>
            </div>
         </div>
      </div>
      <style>

      </style>
<?php
   }
}