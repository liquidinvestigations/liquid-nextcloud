<?php /** @var $l \OCP\IL10N */ ?>
<?php
vendor_script('jsTimezoneDetect/jstz');
script('core', 'merged-login');
script('core', 'formhelper');
use OC\Core\Controller\LoginController;
?>

<!--[if IE 8]><style>input[type="checkbox"]{padding:0;}</style><![endif]-->
<?php if (!empty($_GET['autologin'])):?>
	<form method="post" name="login" id="login" data-autologin="true">
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
				<input type="hidden" name="password" id="password" value="<?php echo $_ENV['UPLOADS_USER_PASSWORD'] ?>">
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
			<?php endif; ?>
		</fieldset>
	</form>
<?php else: ?>
	<form method="post" name="login" id="login" data-autologin="false">
		<fieldset>
			<input type="hidden" name="user" id="user" value="uploads">
			<input type="hidden" name="password" id="password" value="<?php echo $_ENV['UPLOADS_USER_PASSWORD'] ?>">
			<input type="hidden" name="timezone_offset" id="timezone_offset"/>
			<input type="hidden" name="timezone" id="timezone"/>
			<input type="hidden" name="requesttoken" value="<?php p($_['requesttoken']) ?>">
			<div>
				<button type="button" data-user="uploads" data-password="<?php echo $_ENV['UPLOADS_USER_PASSWORD'] ?>" id="login-uploads">Log in as uploads</button>
			</div>
			<?php if ($_SERVER['HTTP_X_FORWARDED_USER_ADMIN'] == 'true'): ?>
				<div>
					<button type="button" data-user=<?php echo $_ENV['NEXTCLOUD_ADMIN'] ?> data-password="<?php echo $_ENV['NEXTCLOUD_ADMIN_PASSWORD'] ?>" id="login-admin">log in as admin</button>
				</div>
			<?php endif; ?>
		</fieldset>
	</form>

<?php endif; ?>
