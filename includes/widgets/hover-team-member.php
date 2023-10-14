<?php

class Hover_Team_Member extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'hover_team_card';
    }

    public function get_title()
    {
        return esc_html__('Hover Team Member', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['hover team', 'team', 'hover effect',];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'member_image',
            [
                'label' => esc_html__('Choose An Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__('upload here square size image for better experience', 'textdomain'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'member_name',
            [
                'label' => esc_html__('Member Name', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'textdomain'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'member_designation',
            [
                'label' => esc_html__('Member Designation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Employee of ABC company', 'textdomain'),
                'show_label' => false,
            ]
        );
     $repeater->add_control(
			'icon_one',
			[
				'label' => esc_html__( 'Icon one', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				
			]
		);
        $repeater->add_control(
            'icon_text_one',
            [
                'label' => esc_html__('icon text one', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('icon text one', 'textdomain'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'icon_link_one',
            [
                'label' => esc_html__('icon link one', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => 'https://www.yourlink.com',
                ]
            ]
		);
     $repeater->add_control(
			'icon_two',
			[
				'label' => esc_html__( 'Icon two', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				
			]
		);
        $repeater->add_control(
            'icon_text_two',
            [
                'label' => esc_html__('icon text two', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('icon text two', 'textdomain'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'icon_link_two',
            [
                'label' => esc_html__('icon link two', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => 'https://www.yourlink.com',
                ]
            ]
		);
      
        $repeater->add_control(
            'member_content',
            [
                'label' => esc_html__('Member Introduced text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, voluptatum sunt cumque, dolor','textdomain'),
                'label_block' => true,
            ]
        );





        $this->add_control(
            'team_member_hover',
            [
                'label' => esc_html__('Member Repeater', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),

                'title_field' => '{{{ member_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ($settings['team_member_hover']) {
?>
            <div class="team-members">
                <?php
                foreach ($settings['team_member_hover'] as $items) {
                ?>
                    <div class="single-team-member-wrapper">
                        <div class="single-tema-member-inner">
                            <div class="team-member-front">
                                <div class="t-image">
                                    <img src="<?php echo $items['member_image']['url'];  ?>" alt="">
                                </div>
                                <div class="team-member-info">
                                    <h3 class="tm-name"><?php echo $items['member_name']; ?></h3>
                                    <p class="tm-designation"><?php echo $items['member_designation']; ?></p>
                                </div>
                                <div class="team-member-hover-part">
                                    <div class="team-member-info">
                                        <h3 class="tm-name"><?php echo $items['member_name']; ?></h3>
                                        <p class="tm-designation"><?php echo $items['member_designation']; ?></p>
                                    </div>
                                    <div class="tm-meta-info">
                                        <p class="single-meta">
                                            <span>
                                                <?php \Elementor\Icons_Manager::render_icon( $items['icon_one'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                            <a href="<?php echo $items['icon_link_one']['url'];  ?>"><?php echo $items['icon_text_one'];  ?></a>
                                        </p>
                                        <p class="single-meta">
                                            <span>
                                            <?php \Elementor\Icons_Manager::render_icon( $items['icon_two'], [ 'aria-hidden' => 'true' ] ); ?>

                                            </span>
                                            <a href="<?php echo $items['icon_link_two']['url'];  ?>"><?php echo $items['icon_text_two'];  ?></a>
                                        </p>
                                    </div>
                                    <div class="tm-details">
                                        <p><?php echo $items['member_content']; ?></p>
                                    </div>
                                    <?php //var_dump($items['icon_link_one']['url']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php

                }
                ?>
            </div>
<?php
        }
    }
}



