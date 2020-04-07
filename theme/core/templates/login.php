<?php /** @var $l \OCP\IL10N */ ?>
<?php
#script('core', 'merged-login');
script('core', 'formhelper');

use OC\Core\Controller\LoginController;
?>

<!--[if IE 8]><style>input[type="checkbox"]{padding:0;}</style><![endif]-->
<form method="post" name="login">
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
		<div id="message" class="hidden">
			<img class="float-spinner" alt=""
				src="<?php p(image_path('core', 'loading-dark.gif'));?>">
			<span id="messageText"></span>
			<!-- the following div ensures that the spinner is always inside the #message div -->
			<div style="clear: both;"></div>
		</div>

                <?php if ($_GET['autologin'] == 'admin' && $_SERVER['HTTP_X_FORWARDED_USER_ADMIN'] == 'true'): ?>
                        <input readonly type="text" name="user" id="user" value="<?php echo $_ENV['NEXTCLOUD_ADMIN'] ?>">
                        <input readonly type="hidden" name="password" id="password" value="<?php echo $_ENV['NEXTCLOUD_ADMIN_PASSWORD'] ?>">
                <?php else: ?>
                        <input readonly type="text" name="user" id="user" value="upload">
                        <input readonly type="hidden" name="password" id="password" value="<?php echo $_ENV['UPLOADS_USER_PASSWORD'] ?>">
                <?php endif; ?>

		<div id="submit-wrapper">
			<input type="submit" id="submit" class="login primary" title="" value="<?php p($l->t('Log in')); ?>" />
			<div class="submit-icon icon-confirm-white"></div>
		</div>

		<?php if (!empty($_[LoginController::LOGIN_MSG_INVALIDPASSWORD])) { ?>
			<p class="warning wrongPasswordMsg">
				<?php p($l->t('Wrong username or password.')); ?>
			</p>
		<?php } else if (!empty($_[LoginController::LOGIN_MSG_USERDISABLED])) { ?>
			<p class="warning userDisabledMsg">
				<?php p(\OC::$server->getL10N('lib')->t('User disabled')); ?>
			</p>
		<?php } ?>

		<?php if ($_['throttle_delay'] > 5000) { ?>
			<p class="warning throttledMsg">
				<?php p($l->t('We have detected multiple invalid login attempts from your IP. Therefore your next login is throttled up to 30 seconds.')); ?>
			</p>
		<?php } ?>

		<input type="hidden" name="timezone_offset" id="timezone_offset"/>
		<input type="hidden" name="timezone" id="timezone"/>
		<input type="hidden" name="requesttoken" value="<?php p($_['requesttoken']) ?>">
	</fieldset>
</form>
