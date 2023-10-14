<?php
class Widget_1  extends \Elementor\Widget_Base {
    public function get_name() {
		return 'world_widget_one';
	}

	public function get_title() {
		return esc_html__( 'Widget One', 'etp' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}

	protected function render() {
		?>

		<p> widget One </p>

		<?php
	}
}
