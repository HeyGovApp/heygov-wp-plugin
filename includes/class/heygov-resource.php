<?php

class HeyGovResource {

	function load_admin_includes() {
		wp_enqueue_style('heygov-admin-css', HEYGOV_URL . 'assets/css/heygov-admin.css');
	}

	function load_frontend_includes() { 
		$heygov_id          = get_option('heygov_id') ? : get_option( 'siteurl');
		$heygov_btn_text    = get_option('heygov_btn_text') ? : 'Report an Issue';
		$heygov_btn_position     = get_option('heygov_btn_position') ? :'middle-right';
		if($heygov_btn_position != 'none'):
		?>

		<script src="https://files.heygov.com/widget.js" data-heygov-jurisdiction="<?php echo $heygov_id; ?>" data-heygov-button-style="<?php echo $heygov_btn_position; ?>" data-heygov-button-text="<?php echo $heygov_btn_text; ?>"></script>

		<?php endif;
	}
}