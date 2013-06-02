<?php
session_start();
if(!isset($_REQUEST['displayCaptchaURL']))
{
	$_REQUEST['displayCaptchaURL'] ="http://{$_SERVER['HTTP_HOST']}/".dirname($_SERVER["PHP_SELF"])."/displayCaptcha.php?osolcaptcha_bgColor=%232c8007&osolcaptcha_textColor=%23ffffff&osolcaptcha_symbolsToUse=ABCDEFGHJKLMNPQRTWXY346789&osolcaptcha_imageFunction=Adv&osolcaptcha_font_ttf=BookmanOldStyle.TTF&white_noise_density=0&black_noise_density=0&osolcaptcha_font_size=24&";
}
?>
<form action="" method="post">
<p>Enter text shown below:</p>
<p><img src="<?php echo $_REQUEST['displayCaptchaURL'];?>"></p>
<p><input type="text" name="keystring"></p>
<p><input type="submit" value="Check"></p>
</form>
<?php
if(count($_POST)>0){
	if(isset($_SESSION['OSOLmulticaptcha_keystring']) && $_SESSION['OSOLmulticaptcha_keystring'] === $_POST['keystring']){
		echo "Correct";
	}else{
		echo "Wrong";
	}
}
unset($_SESSION['OSOLmulticaptcha_keystring']);
?>