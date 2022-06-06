<?php

class HeyGovSettings {

	function add_admin_menu() {
        add_menu_page(
            'HeyGov Settings',
            'HeyGov',
            'manage_options',
            'heygov_settings',
            [$this, 'render_setting_page'],
            'none',
            30
        );
	}

	function render_setting_page() {
		require_once HEYGOV_DIR . '/includes/view/show-heygov-settings.php';
	}

    function heygov_shortcode(){
        ob_start(); ?>

        <div class="heygov-embed"></div>

        <?php
        $outputString = ob_get_contents();
        ob_end_clean();
    
        return $outputString;
    }


    function heygov_forms_shortcode() {
        $forms = wp_remote_get('https://api.heygov.com/heyville.org/forms');
            if (is_wp_error($forms)) {
                return $forms;
            }
            $forms = wp_remote_retrieve_body($forms);
            $forms = json_decode($forms);
        
            $result = '<div class="row align-items-center">';
                $result  .= '<div class="card">'; 
                    $result .= '<div class="card-body p-3">';
                        $result .= '<div class="row row-cols row-cols-2 row-cols-md-3 row-cols-lg-4 mb-3 d-flex">'; 
                            foreach($forms as $form ) {
                                $result .= '<div class="col my-2">'; 
                                    $result .= '<a href="#" class="card card-form text-dark ratio ratio-1x1">' . $form->name . '</a>';
                                $result .= '</div>';
                            }
                    $result .= '</div>'; 
                $result .= '</div>';
            $result .= '</div>'; 
        return $result; 
    }

}