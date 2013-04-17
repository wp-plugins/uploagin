<?php
# 직접 접근을 막는다요
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) die ('Please do not load this page directly. Thanks!');

$key = get_option("sj-uploagin-key");
$auth = get_option("sj-uploagin-auth");
?>
<div class="wrap sjUploagin">
	<div class="icon32" id="icon-options-general"><br></div><h2><?php _e('Uploagin', $sjUploagin->text_domain); ?></h2>

	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="donation">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>

	<form method="post" id="sjUploaginForm">
		<input type="hidden" value="uploagin-options" name="option_page">
		<input type="hidden" value="update" name="action">

		<div class="col_wrapper">
			<div>
				<input type="radio" id="auth-none" class="" name="auth" value="none" <?php if (!$auth || $auth == "none") echo 'checked="checked"' ?> />
				<label for="auth-none"><?php _e('Do not use this plugin', $sjUploagin->text_domain); ?></label>
			</div>

			<div>
				<input type="radio" id="auth-admin" class="" name="auth" value="admin" <?php if ($auth == "admin") echo 'checked="checked"' ?> />
				<label for="auth-admin"><?php _e('Set Uploagin only for administrator', $sjUploagin->text_domain); ?></label>
			</div>

			<div>
				<input type="radio" id="auth-all" class="" name="auth" value="all" <?php if ($auth == "all") echo 'checked="checked"' ?> />
				<label for="auth-all"><?php _e('Set Uploagin for all type of user', $sjUploagin->text_domain); ?></label>
			</div>
		</div>

		<div class="submit">
			<input type="submit" value="<?php _e('Save Changes', $sjUploagin->text_domain); ?>" class="button button-primary" id="submit" name="submit">
			<a href="<?php echo $_SERVER['REQUEST_URI'] ?>" class="button"><?php _e('Cancel', $sjUploagin->text_domain); ?></a>
		</div>
	</form>
</div>
