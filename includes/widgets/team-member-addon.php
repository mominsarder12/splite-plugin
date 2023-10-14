<?php
class Team_Members_Addon extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'team_member';
	}

	public function get_title()
	{
		return esc_html__('Team Member', 'elementor-addon');
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
		return ['team', 'member', 'team member'];
	}

	protected function register_controls()
	{

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Team Member', 'elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'member-image',
			[
				'label' => esc_html__('Choose Member Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'member-name',
			[
				'label' => esc_html__('Member Name', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Member Name', 'elementor-addon'),
			]
		);
		$this->add_control(
			'member-designation',
			[
				'label' => esc_html__('Member Designation', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Member Designation', 'elementor-addon'),
			]
		);

		$this->add_control(
			'social_links',
			[
				'label' => __('Social Links', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'link',
						'label' => __('Link', 'elementor-addon'),
						'type' => \Elementor\Controls_Manager::URL,
						'default' => [
							'url' => '',
						],
					],
					[
						'name' => 'icon',
						'label' => __('Icon', 'elementor-addon'),
						'type' => \Elementor\Controls_Manager::ICONS,
					],
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
			'member_color',
			[
				'label' => esc_html__('Member Color', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default'=> '#fff',
				'selectors' => [
					'{{WRAPPER}} .member-colors' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$member_name = $settings['member-name'];
		$member_image = $settings['member-image'];
		$member_socials = $settings['social_links'];
		$member_designation = $settings['member-designation'];

?>
		<div class="wrapper">
			<div class="card">
				<div class="img-container">
					<img src="<?php echo $member_image['url']; ?>" />
				</div>
				<h3 class="member-colors"><?php echo $member_name; ?></h3>
				<p><?php echo $member_designation; ?></p>
				<div class="icons">
					<?php
					foreach ($member_socials as $social) {
					?>
						<a href="<?php echo esc_url($social['link']['url']); ?>">
							<i class="<?php echo $social['icon']['value']; ?>"></i>
						</a>
					<?php
					}
					?>

				</div>
			</div>
		</div>

<?php
	}
}
