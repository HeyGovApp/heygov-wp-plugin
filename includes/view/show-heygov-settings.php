<?php

// HeyGov ID
$heygov_id = get_option('heygov_id');
$heygov_features = explode(',', get_option('heygov_features') ?: 'issues');

// widget info
$heygov_btn_text = get_option('heygov_btn_text') ?: 'Report an Issue';
$heygov_btn_position = get_option('heygov_btn_position') ?: 'middle-right';

// apps banner info
$heygov_banner = get_option('heygov_banner') ?: 0;
$heygov_banner_bg_color = get_option('heygov_banner_bg_color') ?: '#EEF4FE';
$heygov_banner_img_big = get_option('heygov_banner_img_big') ?: HEYGOV_URL . 'assets/img-banner-example.png';
$heygov_banner_img_small = get_option('heygov_banner_img_small') ?: HEYGOV_URL . 'assets/img-banner-mobile-example.png';


// validate & save HeyGov ID
if (isset($_POST['heygov'])) {
	$id = heygov_validate_id($_POST['heygov']['id']);

	if (is_wp_error($id)) {
		echo '<div class="notice notice-error"><p>' . $id->get_error_message() . '</p></div>';
	} else {
		$heygov_id = $id;
		$heygov_features = $_POST['heygov']['features'];

		update_option('heygov_id', $id);
		update_option('heygov_features', join(',', $heygov_features));

		echo '<div class="notice notice-success"><p>HeyGov ID and apps have been saved.</p></div>';
	}
}

// save widget settings
if (isset($_POST['heygov_widget'])) {
	$heygov_btn_text	= $_POST['heygov_widget']['text'];
	$heygov_btn_position = $_POST['heygov_widget']['position'];
	update_option('heygov_btn_text', $heygov_btn_text);
	update_option('heygov_btn_position', $heygov_btn_position);

	echo '<div class="notice notice-success"><p>HeyGov widget is updated.</p></div>';
}

// save banner settings
if (isset($_POST['heygov_banner'])) {
	$heygov_banner = isset($_POST['heygov_banner']['heygov_banner']) && $_POST['heygov_banner']['heygov_banner'] === 'on' ? 1 : 0;
	$heygov_banner_bg_color = $_POST['heygov_banner']['bg_color'];
	$heygov_banner_img_big = $_POST['heygov_banner']['image_big'];
	$heygov_banner_img_small = $_POST['heygov_banner']['image_small'];

	update_option('heygov_banner', $heygov_banner);
	update_option('heygov_banner_bg_color', $heygov_banner_bg_color);
	update_option('heygov_banner_img_big', $heygov_banner_img_big);
	update_option('heygov_banner_img_small', $heygov_banner_img_small);

	echo '<div class="notice notice-success"><p>HeyGov apps banner is updated.</p></div>';
}

?>

<div class="wrap">

	<h1 class="wp-heading-inline">HeyGov</h1>
	<hr class="wp-header-end">

	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

		<table class="form-table">
			<tr>
				<th><label for="heygov_id">HeyGov ID</label></th>
				<td>
					<input type="text" name="heygov[id]" class="regular-text" id="heygov_id" value="<?php echo $heygov_id?:''; ?>" />
					<p class="description">Usually the website domain, ex: <code>town.com</code></p>
				</td>
			</tr>
			<tr>
				<th><label for="heygov_id">Active apps</label></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>HeyGov apps to enable </span></legend>
						<p>
							<label><input name="heygov[features][]" type="checkbox" value="issues" <?php checked(in_array('issues', $heygov_features)) ?>> HeyGov 311</label><br>
							<label><input name="heygov[features][]" type="checkbox" value="forms" <?php checked(in_array('forms', $heygov_features)) ?>> HeyLicense</label>
						</p>
						<p class="description">
							Which HeyGov apps should be displayed in the widget.
						</p>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th class="heygov-py-0"></th>
				<td class="heygov-py-0">
					<p class="submit"><input type="submit" name="heygov_submit" id="heygov_submit" class="button button-primary" value="Update HeyGov settings"></p>
				</td>
			</tr>
		</table>

	</form>

	<?php if ($heygov_id) : ?>
		<div class="heygov-feature">
			<h3>Report Issue widget</h3>

			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="heygov_btn_position">Widget button position</label></th>
							<td>
								<select class="regular-text" name="heygov_widget[position]" id="heygov_btn_position">
									<option value="none" <?php selected($heygov_btn_position, 'none'); ?>>None</option>
									<option value="bottom-right" <?php selected($heygov_btn_position, 'bottom-right'); ?>>Bottom right</option>
									<option value="middle-right" <?php selected($heygov_btn_position, 'middle-right'); ?>>Middle right</option>
									<option value="random" <?php selected($heygov_btn_position, 'random'); ?>>Random</option>
								</select>
								<p class="description">Select widget position, or turn off widget</p>
							</td>
						</tr>

						<tr>
							<th><label for="heygov_btn_text">Widget button text</label></th>
							<td>
								<input type="text" name="heygov_widget[text]" class="regular-text" id="heygov_btn_text" value="<?php echo $heygov_btn_text; ?>" />
								<p class="description">Example: `Report a City Issue` or `Report a Town Issue`</p>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="heygov_widget_shortcode">Widget Shortcode</label></th>
							<td>
								<input type="text" class="regular-text" id="heygov_widget_shortcode" value="[heygov-widget]" readonly />
								<p class="description">Use this schortcode to include the HeyGov widget on any page</p>
							</td>
						</tr>

						<tr>
							<th class="heygov-py-0"></th>
							<td class="heygov-py-0">
								<p class="submit"><input type="submit" name="heygov_submit" id="heygov_submit" class="button button-primary" value="Update widget"></p>
							</td>
						</tr>
					</tbody>
				</table>

			</form>
		</div>

		<div class="heygov-feature">
			<h3>Apps banner</h3>
		
			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
				<p><label><input type="checkbox" name="heygov_banner[heygov_banner]" id="heygov_banner_toggle" <?php checked($heygov_banner) ?> /> Enable footer banner with HeyGov apps download info</label></p>

				<div class="heygov-apps-banner-options <?php if (!$heygov_banner) echo 'hidden' ?>">
					<table class="form-table">
						<tbody>
							<tr>
								<th><label for="heygov_banner_bg">Banner background color</label></th>
								<td>
									<input type="color" name="heygov_banner[bg_color]" id="heygov_banner_bg" value="<?php echo $heygov_banner_bg_color ?>" />
								</td>
							</tr>

							<tr>
								<th><label for="heygov_banner_image_big">Banner desktop image</label></th>
								<td>
									<input type="file" id="heygov_banner_image_big" />
									<input type="hidden" name="heygov_banner[image_big]" id="heygov_banner_image_big_inp" value="<?php echo $heygov_banner_img_big ?>" />
								</td>
							</tr>

							<tr>
								<th><label for="heygov_banner_image_small">Banner mobile image</label></th>
								<td>
									<input type="file" name="heygov_banner[image_small]" id="heygov_banner_image_small" />
									<input type="hidden" name="heygov_banner[image_small]" id="heygov_banner_image_small_inp" value="<?php echo $heygov_banner_img_small ?>" />
								</td>
							</tr>
						</tbody>
					</table>

					<h5>Desktop preview</h5>
					<div class="heygov-banner-big-frame">
						<?php require HEYGOV_DIR . 'includes/view/apps-banner.php' ?>
					</div>

					<h5>Mobile preview</h5>
					<div class="heygov-banner-phone-frame">
						<?php require HEYGOV_DIR . 'includes/view/apps-banner.php' ?>
					</div>
				</div>

				<p class="submit"><input type="submit" name="heygov_submit" id="heygov_submit" class="button button-primary" value="Update banner"></p>
			</form>

		</div>

		<script>
		const $banners = document.querySelectorAll('.heygov-apps-banner')

		jQuery('#heygov_banner_toggle').change(() => {
			jQuery('.heygov-apps-banner-options').toggleClass('hidden')
		})

		// change banner bg color
		const $bannerBgColor = document.getElementById('heygov_banner_bg')
		$bannerBgColor.addEventListener('change', event => {
			[ ...$banners ].forEach(banner => {
				banner.style.backgroundColor = $bannerBgColor.value
			})
		})

		jQuery('#heygov_banner_image_small, #heygov_banner_image_big').change(event => {
			const lastImage = event.target.id.split('_').pop()
			heyGovUploadFile(event.target.files[0]).then(re => {
				console.log('OK', re.source_url)

				jQuery(`#${event.target.id}_inp`).val(re.source_url)
				jQuery(`.heygov-apps-banner-image-${lastImage}`).attr('src', re.source_url)
			}, error => {
				alert(`Error uploading file ~ ${error}`)
			})
		})
		</script>
	<?php endif ?>

</div>
