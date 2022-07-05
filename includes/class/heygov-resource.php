<?php

class HeyGovResource {

	public function load_admin_includes() {
		wp_enqueue_style('heygov-admin', HEYGOV_URL . 'assets/css/heygov-admin.css', [], '1.4');
		wp_enqueue_style('heygov-site', HEYGOV_URL . 'assets/css/heygov-site.css', [], '1.4');
		wp_enqueue_script('heygov-admin', HEYGOV_URL . 'assets/heygov-admin.js', [], '1.4', true);		

		wp_localize_script('heygov-admin', 'HeyGov', [
			'apiUrl' => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest')
		]);
	}

	public function load_site_includes() {
		wp_enqueue_style('heygov-site', HEYGOV_URL . 'assets/css/heygov-site.css', [], '1.4');
	}

	public function load_widget() { 
		$heygov_id = get_option('heygov_id');

		if ($heygov_id) :
			$heygov_features = get_option('heygov_features') ?: 'issues';
			$heygov_btn_text = get_option('heygov_btn_text') ?: 'Report an Issue';
			$heygov_btn_position = get_option('heygov_btn_position') ?: 'middle-right';
			$buttonStyle = $heygov_btn_position === 'none' ? '' : 'data-heygov-button-style="' . esc_attr($heygov_btn_position) . '"';
			?>
			<script src="https://files.heygov.com/widget.js" data-heygov-jurisdiction="<?php echo esc_attr($heygov_id); ?>" data-heygov-features="<?php echo esc_attr($heygov_features); ?>" <?php echo $buttonStyle ?> data-heygov-button-text="<?php echo esc_attr($heygov_btn_text); ?>"></script>
			<?php
		endif;
	}

	public function load_apps_banner() { 
		$heygov_id = get_option('heygov_id');
		$heygov_banner = get_option('heygov_banner');

		if ($heygov_id && $heygov_banner) {
			ob_start();
			require_once HEYGOV_DIR . 'includes/view/apps-banner.php';
			$html = ob_get_contents();
			ob_end_clean();
			?>

			<script type="text/javascript">
			const HeyGovBanner = <?php echo json_encode(wp_kses('<div class="heygov-apps-banner-wrapper">' . $html . '</div>', 'post')) ?>;
			jQuery(HeyGovBanner).insertBefore('.footer-main, .footer_wrap')
			</script>
			<?php
		}
	}

	public function heygov_forms_shortcode( $atts = array()) {
		$args = shortcode_atts( array(
			'maxcolumns' => '5',
			'department' => ''
		), $atts );

		$maxcolumns = $args['maxcolumns']; 
		$calc_medium = $maxcolumns - 1; 
		$department = $args['department']; 

        $heygov_id = get_option('heygov_id');
		$forceUpdate = isset($_REQUEST['heygov-refresh-forms']);

		// Get any existing copy of our transient data
		if ( false === ( $forms = get_transient( 'forms' ) ) || $forceUpdate ) {
			// It wasn't there, so regenerate the data and save the transient
			$forms = wp_remote_get('https://api.heygov.com/' . $heygov_id . '/forms?status=public&expand=department');

			if (is_wp_error($forms)) {
				$forms = []; 
			} else {
				$forms = wp_remote_retrieve_body($forms);
				$forms = json_decode($forms);
				set_transient( 'forms', $forms, 12 * HOUR_IN_SECONDS );
			}
		}

		if(!empty($department)) {
			$forms = array_filter($forms, function($form) use($department) {
				return $form->department_id == $department || $form->department->slug == $department || $form->department->name == $department; 
			}); 
		}

		// generate forms HTML
		ob_start();

		require_once HEYGOV_DIR . 'includes/view/show-heygov-muni-forms.php';

		$forms = ob_get_contents();
		ob_end_clean();

		return $forms;
    }

}
