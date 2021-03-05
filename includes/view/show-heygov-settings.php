<?php

	if(isset($_POST['heygov'])){
		$heygov_id      	= $_POST['heygov']['id'];
		$heygov_btn_text	= $_POST['heygov']['text'];
		$heygov_btn_position = $_POST['heygov']['position'];
		update_option('heygov_id', $heygov_id);
		update_option('heygov_btn_text', $heygov_btn_text);
		update_option('heygov_btn_position', $heygov_btn_position);
	}else{
		$heygov_id          = get_option('heygov_id') ? : get_option( 'siteurl');
		$heygov_btn_text    = get_option('heygov_btn_text') ? : 'Report an Issue';
		$heygov_btn_position     = get_option('heygov_btn_position') ? :'bottom-right';
	}
?>

<div class="wrap">

	<h1 class="wp-heading-inline">HeyGov Settings</h1>
	<hr class="wp-header-end">

	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">HeyGov Shortcode</th>
					<td>
						<div class="twd-subscribe-shortcode larger">[heygov-widget]</div>
					</td>
				</tr>

				<tr>
					<th><label for="heygov_id">HeyGov ID</label></th>
					<td>
						<input type="text" name="heygov[id]" class="regular-text" id="heygov_id" value="<?php echo $heygov_id?:''; ?>" />
						<p class="description">Example: `town.com`</p>
					</td>
				</tr>

				<tr>
					<th><label for="heygov_btn_position">Button Position</label></th>
					<td>
						<select class="regular-text" name="heygov[position]" id="heygov_btn_position">
							<option value="none" <?php selected($heygov_btn_position, 'none'); ?>>None</option>
							<option value="bottom-right" <?php selected($heygov_btn_position, 'bottom-right'); ?>>Bottom right</option>
							<option value="middle-right" <?php selected($heygov_btn_position, 'middle-right'); ?>>Middle right</option>
							<option value="random" <?php selected($heygov_btn_position, 'random'); ?>>Random</option>
						</select>
						<p class="description">Example: `middle-right`, `bottom-right`, `none`</p>
					</td>
				</tr>

				<tr>
					<th><label for="heygov_btn_text">Button Text</label></th>
					<td>
						<input type="text" name="heygov[text]" class="regular-text" id="heygov_btn_text" value="<?php echo $heygov_btn_text; ?>" />
						<p class="description">Example: `Report City Issue` or `Report Town Issue`</p>
					</td>
				</tr>

			</tbody>
		</table>

        <p class="submit"><input type="submit" name="heygov_submit" id="heygov_submit" class="button button-primary" value="Save Changes"></p>
    </form>
</div>