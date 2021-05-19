<?php

// HeyGov ID
$heygov_id = get_option('heygov_id');

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
		update_option('heygov_id', $id);

		echo '<div class="notice notice-success"><p>HeyGov ID is saved.</p></div>';
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
				<th class="heygov-py-0"></th>
				<td class="heygov-py-0">
					<p class="submit"><input type="submit" name="heygov_submit" id="heygov_submit" class="button button-primary" value="Update HeyGov ID"></p>
				</td>
			</tr>
		</table>


	<?php if ($heygov_id) : ?>
