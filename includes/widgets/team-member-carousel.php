<?php

class Card_Carousel extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'card_carousel';
    }

    public function get_title()
    {
        return esc_html__('Card Carousel', 'etp');
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
        return ['card', 'carousel', 'slider',];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'etp'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'photo',
            [
                'label' => esc_html__('Choose Photo', 'etp'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'etp'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Card Title', 'etp'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'sub-title',
            [
                'label' => esc_html__('Sub Title', 'etp'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Card Sub Title', 'etp'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'btn-text-one',
            [
                'label' => esc_html__('Button Text One', 'etp'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Hire Now'),
                'show_label' => 'false',
            ]
        );

        $repeater->add_control(
            'btn-link-one',
            [
                'label' => esc_html__('Button Link One', 'etp'),
                'type' => \Elementor\Controls_Manager::URL,
                'show_label' => 'false',
                'default' => [
                    'url' => 'https://www.your-link.com',
                ]
            ]
        );
        
        $repeater->add_control(
            'btn-text-two',
            [
                'label' => esc_html__('Button Text Two', 'etp'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Visit Project'),
                'show_label' => 'false',
            ]
        );

        $repeater->add_control(
            'btn-link-two',
            [
                'label' => esc_html__('Button Link Two', 'etp'),
                'type' => \Elementor\Controls_Manager::URL,
                'show_label' => 'false',
                'default' => [
                    'url' => 'https://www.your-link.com',

                ]
            ]

        );



        $this->add_control(
            'card',
            [
                'label' => esc_html__('Repeater List', 'etp'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->add_control(
            'carousel',
            [
                'label' => esc_html__('Carousel', 'etp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if ('yes' == $settings['carousel']) {
            // wp_enqueue_script('my-carousel-script', plugins_url('/elementortestplugin/assets/js/conditional-carousel.js' ), [], '1.0.0', true);
            
?>
            <script>
                jQuery(document).ready(function($) {
                    $('.card-carouselyes').slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        arrows: false,
                        dots: true,
                        // centerMode: true,
                    });
                });
            </script>
<?php
        }

        if ($settings['card']) {
            echo '<div class="card-container card-carousel'. $settings['carousel'] . '">';
            foreach ($settings['card'] as $item) {
                echo '<div class="card-wrapper"><div class="addon-card">';
                echo '<img src="' . $item['photo']['url'] . '">';
                echo '<h3 class="title elementor-repeater-item-' . esc_attr($item['_id']) . '">' . $item['title'] . '</h3>';
                echo '<h5 class="sub-title">' . $item['sub-title'] . '</h5>';
                echo '<a class="btn-one" href="' . $item['btn-link-one']['url'] . '">' . $item['btn-text-one'] . '</a>';
                echo '<a class="btn-two" href="' . $item['btn-link-two']['url'] . '">' . $item['btn-text-two'] . '</a>';
                echo '</div></div>';
            }
            echo '</div>';
        }
    }
    protected function _content_template() {
        ?>
        <# if ( settings.card ) { #>
            <div class="card-container card-carousel-{{{ settings.carousel }}}">
                <# _.each( settings.card, function( item ) { #>
                    <div class="card-wrapper">
                        <div class="addon-card">
                            <img src="{{ item.photo.url }}">
                            <h3 class="title elementor-repeater-item-{{ item._id }}">{{ item.title }}</h3>
                            <h5 class="sub-title">{{ item['sub-title'] }}</h5>
                            <a class="btn-one" href="{{ item['btn-link-one'].url }}">{{ item['btn-text-one'] }}</a>
                            <a class="btn-two" href="{{ item['btn-link-two'].url }}">{{ item['btn-text-two'] }}</a>
                        </div>
                    </div>
                <# }); #>
            </div>
        <# } #>
        <?php
    }
   
}
