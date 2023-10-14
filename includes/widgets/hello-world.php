<?php
class Hello_World_Widget extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'hello_world_widget';
	}

	public function get_title()
	{
		return esc_html__('Hello World', 'etp');
	}

	public function get_icon()
	{
		return 'eicon-code';
	}

	public function get_categories()
	{
		return ['basic', 'general'];
	}

	public function get_keywords()
	{
		return ['hello', 'world', 'first', 'custom'];
	}
	protected function register_controls()
	{

		// Content Tab Start

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Title', 'etp'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'etp'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Hello world', 'etp'),
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__('Show Title', 'etp'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'etp'),
				'label_off' => esc_html__('Hide', 'etp'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		

		$this->end_controls_section();
	}
	


	protected function render()
	{
		$settings = $this->get_settings_for_display();
     ?>
		<p> <?php echo $settings['title']; ?> </p>
	<?php
	}


	protected function content_template() {
		?>
		<# if ( 'yes' === settings.show_title ) { #>
			<p>{{{ settings.title }}}</p>
		<# } #>
		<?php
	}

	
}

?>