<?php /** @var $l \OCP\IL10N */ ?>
<?php
vendor_script('jsTimezoneDetect/jstz');
script('core', 'merged-login');
script('core', 'submitlog');  // add js/script.js
script('core', 'changeuser');  // add js/script.js
use OC\Core\Controller\LoginController;
?>

<!--[if IE 8]><style>input[type="checkbox"]{padding:0;}</style><![endif]-->
<?php if (!empty($_GET['autologin'])):?>
	<form method="post" name="login" id="login">
		<fieldset>
		<?php if (!empty($_['redirect_url'])) {
			print_unescaped('<input type="hidden" name="redirect_url" value="' . \OCP\Util::sanitizeHTML($_['redirect_url']) . '">');
		} ?>
			<?php if (isset($_['apacheauthfailed']) && $_['apacheauthfailed']): ?>
				<div class="warning">
					<?php p($l->t('Server side authentication failed!')); ?><br>
					<small><?php p($l->t('Please contact your administrator.')); ?></small>
				</div>
			<?php endif; ?>
			<?php foreach($_['messages'] as $message): ?>
				<div class="warning">
					<?php p($message); ?><br>
				</div>
			<?php endforeach; ?>
			<?php if (isset($_['internalexception']) && $_['internalexception']): ?>
				<div class="warning">
					<?php p($l->t('An internal error occurred.')); ?><br>
					<small><?php p($l->t('Please try again or contact your administrator.')); ?></small>
				</div>
			<?php endif; ?>
			<?php if ($_GET['autologin'] == 'uploads'): ?>
				<input type="hidden" name="user" id="user" value="uploads">
				<input type="hidden" name="password" id="password" value="<?php echo $_ENV['OC_PASS'] ?>">
				<input type="hidden" name="timezone_offset" id="timezone_offset"/>
				<input type="hidden" name="timezone" id="timezone"/>
				<input type="hidden" name="requesttoken" value="<?php p($_['requesttoken']) ?>">
			<?php elseif ($_GET['autologin'] == 'admin'): ?>
				<?php if ($_SERVER['HTTP_X_FORWARDED_USER_ADMIN'] == 'true'): ?>
					<input type="hidden" name="user" id="user" value="<?php echo $_ENV['NEXTCLOUD_ADMIN'] ?>">
					<input type="hidden" name="password" id="password" value="<?php echo $_ENV['NEXTCLOUD_ADMIN_PASSWORD'] ?>">
					<input type="hidden" name="timezone_offset" id="timezone_offset"/>
					<input type="hidden" name="timezone" id="timezone"/>
					<input type="hidden" name="requesttoken" value="<?php p($_['requesttoken']) ?>">
				<?php endif; ?>

		</fieldset>
	</form>
	<script src="submitlog.js"></script>
<?php else: ?>
	<form method="post" name="login" id="login">
	<fieldset>
		<input type="hidden" name="user" id="user" value="uploads">
		<input type="hidden" name="password" id="password" value="<?php echo $_ENV['OC_PASS'] ?>">    
		<input type="hidden" name="timezone_offset" id="timezone_offset"/>
		<input type="hidden" name="timezone" id="timezone"/>
		<input type="hidden" name="requesttoken" value="<?php p($_['requesttoken']) ?>">
		<div id="submit-wrapper">
			<input type="submit" id="submit" class="login primary" title="" value="<?php p($l->t('Log in')); ?>" disabled="disabled" />
			<div class="submit-icon icon-confirm-white"></div>
		</div>

	</fieldset>
	</form>
<?php endif; ?>
