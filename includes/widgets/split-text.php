<?php
class SplitText extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'split-text';
	}

	public function get_title()
	{
		return esc_html__('Split Text', 'elementor-addon');
	}

	public function get_icon()
	{
		return 'eicon-heading';
	}

	public function get_categories()
	{
		return ['basic'];
	}

	public function get_keywords()
	{
		return ['split text', 'split', 'amimation', 'custom'];
	}

	protected function register_controls()
	{

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Title', 'elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Hello world', 'elementor-addon'),
				'label_block' => true,

			]
		);
		// Add the heading size control
		$this->add_control(
			'heading_size',
			[
				'label' => esc_html__( 'Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'textdomain' ),
					'small' => esc_html__( 'Small', 'textdomain' ),
					'medium'  => esc_html__( 'Medium', 'textdomain' ),
					'large' => esc_html__( 'Large', 'textdomain' ),
					'XL' => esc_html__( 'XL', 'textdomain' ),
					'XXL' => esc_html__( 'XXL', 'textdomain' ),
				],
				'selectors' => [
					'{{WRAPPER}} .quote' => 'font-size: {{VALUE}};',
				],
			]
		);
		

		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Text Color', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quote' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>

		<h1 class="quote"><?php echo $settings['title']; ?> </h1>

<?php
	}
}
