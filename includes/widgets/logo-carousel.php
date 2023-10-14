<?php
class LogoCarousel extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'logo_carousel';
	}

	public function get_title()
	{
		return esc_html__('Logo Carousel', 'etp');
	}

	public function get_icon()
	{
		return 'eicon-carousel-loop';
	}

	public function get_categories()
	{
		return ['basic', 'general'];
	}

	public function get_keywords()
	{
		return ['logo', 'carousel'];
	}

	protected function register_controls()
	{

		// Content Tab Start
		// repeater controls start
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'etp'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'carousel_title',
			[
				'label' => esc_html__('Title', 'etp'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Carousel Title #', 'etp'),
				'label_block' => true,
				'placeholder' => esc_html__('Type your title here', 'etp'),
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'etp'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__('Repeater List', 'etp'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ carousel_title }}}',
			]
		);

		$this->end_controls_section();

		// repeater controls end


		$this->start_controls_section(
			'carousel_settings',
			[
				'label' => esc_html__('Carousel Settings', 'etp'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => esc_html__('Carousel Loop', 'etp'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'etp'),
				'label_off' => esc_html__('Off', 'etp'),
				'return_value' =>true,
				'default' => true,
			]
		);
		$this->add_control(
			'dot',
			[
				'label' => esc_html__('Carousel Dots', 'etp'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'etp'),
				'label_off' => esc_html__('Off', 'etp'),
				'return_value' =>true,
				'default' => true,
			]
		);
		$this->add_control(
			'nav',
			[
				'label' => esc_html__('Carousel Navs', 'etp'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'etp'),
				'label_off' => esc_html__('Off', 'etp'),
				'return_value' =>true,
				'default' => true,
			]
		);
		$this->add_control(
			'margin',
			[
				'label' => esc_html__('Carousel Margin', 'etp'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$this->end_controls_section();

		// Content Tab End

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute(
			'carousel_options',
			[
				'id' => 'logo-carousel-' . $this->get_id(),
				'data-loop' => $settings['loop'],
				'data-dots' => $settings['dot'],
				'data-nav' => $settings['nav'],
				'data-margin' => $settings['margin'],

			]
		);

		?>
		<div class="owl-carousel owl-theme carousel-class" <?php echo $this->get_render_attribute_string('carousel_options'); ?>><?php
		if ($settings['list']) {
			foreach ($settings['list'] as $item) {
    ?>
				<div class="item"><img src="<?php echo $item['image']['url']; ?>" alt="<?php echo esc_attr($item['carousel_title']) ?>"></div>
    <?php
				
			}
			
		}
		echo '</div>';
	}

	protected function _content_template() {
        ?>
        <#
            view.addRenderAttribute(
                'carousel_options',
                {
                    'id': 'logo-carousel-id',
                    'data-loop': settings.loop,
                    'data-dots': settings.dot,
                    'data-nav': settings.nav,
                    'data-margin': settings.margin
                }
            );
        #>
        <# if( settings.list.length ) { #>
        <div class="owl-carousel owl-theme carousel-class" {{{ view.getRenderAttributeString( 'carousel_options' ) }}}>
            <# _.each( settings.list, function( item ) { #>
            <div class="item">
                <img src="{{ item.image.url }}" alt="{{ item.carousel_title }}" />
            </div>
            <# } ) #>
        </div>
        <# } #>
        <?php
    }
}
