<?php
if($_POST['fbpay_hidden']) {
	//Form data sent
	$fbpay_id = $_POST['fbpay_id'];
	update_option('fbpay_id', $fbpay_id);

	$fbpay_class = $_POST['fbpay_class'];
	update_option('fbpay_class', $fbpay_class);

	$fbpay_img = $_POST['fbpay_img'];
	update_option('fbpay_img', $fbpay_img);

    $fbpay["id"] = $fbpay_id;  
    $fbpay["class"] = $fbpay_class;
    $fbpay["img"] = $fbpay_img;  
?>
<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
<?php
} else {
	//Normal page display  
    $fbpay["id"] = get_option('fbpay_id');  
    $fbpay["class"] = get_option('fbpay_class');
    $fbpay["img"] = get_option('fbpay_img');  
}
?>
<div class="wrap">
	<?php echo "<h2>" . __( 'Pay With A Facebook Post Options', 'fbpay_trdom' ) . "</h2>"; ?>
	<?php echo "<h4>" . __( 'Pay With A Facebook Post Settings', 'fbpay_trdom' ) . "</h4>"; ?>
	<form name="fbpay_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="fbpay_hidden" value="true">
		<table>
		<tr>
			<td><?php _e("Pay With FB ID: " ); ?></td>
			<td><input type="text" name="fbpay_id" value="<?php echo $fbpay["id"]; ?>" size="20"></td>
			<td><?php _e(" ex: 123456789" ); ?></td>
		</tr>
		<tr>
			<td><?php _e("Pay With FB Link Class: " ); ?></td>
			<td><input type="text" name="fbpay_class" value="<?php echo $fbpay["class"]; ?>" size="20"></td>
			<td><?php _e(" ex: fbpay" ); ?></td>
		</tr>
		<tr>
			<td><?php _e("Pay With FB Image: " ); ?></td>
			<td>
				<select id="fbpay_img" name="fbpay_img">
					<option value="1" <?php selected($fbpay['img'], '1'); ?>>Yes</option>
					<option value="0" <?php selected($fbpay['img'], '0'); ?>>No</option>
				</select>
			</td>			
			<td>&nbsp;</td>
		</tr>
		</table>
		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Update Options', 'fbpay_trdom' ) ?>" />
		</p>
	</form>
</div>
