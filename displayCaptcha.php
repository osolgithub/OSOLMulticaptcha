<?php

		session_start();
		require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'OSOLmulticaptcha.php');
		$captcha = new OSOLmulticaptcha();
		$captcha->displayCaptcha();
		$_SESSION['OSOLmulticaptcha_keystring'] = $captcha->keystring;
    

?>