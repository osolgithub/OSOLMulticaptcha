<?php
require_once('OSOLmulticaptcha.php');
$captcha = new OSOLmulticaptcha();
//$captcha->displayCaptcha();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Preview Captcha</title>
<script>
						function previewOSOLCaptcha(e,text){
							var image = new Image();
							image.onload = function() { // always fires the event.
								document.getElementById('ToolTip').innerHTML=  text;
							};
							image.src = getOSOSLCaptchaPreviewImageURL();
							//alert(e.clientX+20+document.body.scrollLeft + \" : \" + e.clientY+document.body.scrollTop);
							ajaxLoaderURL = 'utils/ajax-loader-big.gif';
							document.getElementById('ToolTip').innerHTML=  '<div><img src=\"'+ajaxLoaderURL+'\" style=\"float:left\" /></div><div>Please wait while captcha preview is loaded</div>';
							
							ToolTip.style.visibility="visible";
							//alert(e.clientY);
							ToolTip.style.left = (e.clientX)+'px';
							ToolTip.style.top = (e.clientY-($('jform_params_letterSize').value * 3)) + 'px';
							//alert(ToolTip.style.left  + \" : \"  + ToolTip.style.top  + ' : ' + ToolTip.style.visibility);
						}
						function hidePreviewOSOLCaptcha(){
							ToolTip.style.visibility="hidden";
						}
						function $(elementId)
						{
							var elementObj = document.getElementById(elementId);
							//alert(elementObj.id + " : " +elementObj.type);
							if(elementObj.type != 'select-one')
							{
								return elementObj;
							}
							else
							{
								return elementObj.options[elementObj.selectedIndex]
							}
						}
						function getOSOSLCaptchaPreviewImageURL()
						{
							formFieldPrefix = 'jform_params_'
							var formFields = {bgColor:'osolcaptcha_bgColor',textColor:'osolcaptcha_textColor',allowedSymbols:'osolcaptcha_symbolsToUse',imageFunction:'osolcaptcha_imageFunction',fontFile:'osolcaptcha_font_ttf',white_noise_density:'white_noise_density',black_noise_density:'black_noise_density',letterSize:'osolcaptcha_font_size'}
						
							qVars = 'previewCaptcha=True&';
							for(var i in formFields)
							{
								qVars = qVars +formFields[i]+'='+encodeURIComponent($(formFieldPrefix+i).value)+'&';
							}
							return imageURL = 'displayCaptcha.php?'+qVars;;
						}
						function OSOLCaptchPreviewHTML()
						{
							imageURL = getOSOSLCaptchaPreviewImageURL();
							liveCaptchaURL = currentURLPath+imageURL.replace('previewCaptcha=True&','');
							$('test_captcha_div').innerHTML = "<a href=\"testOSOLmulticaptcha.php?displayCaptchaURL="+encodeURIComponent(liveCaptchaURL)+"\" target=\"_blank\">Test Captcha  with current settings</a>";
							$('captcha_url_div').innerHTML = "<a href=\""+liveCaptchaURL+"\" target=\"_blank\">"+liveCaptchaURL+"</a>";
						//previewCaptcha=True&osolcaptcha_imageFunction=Adv&osolcaptcha_font_ttf=BookmanOldStyle.TTF&osolcaptcha_font_size=72&osolcaptcha_bgColor=%232c8007&osolcaptcha_textColor=%23ffffff&white_noise_density=.2&black_noise_density=.2&osolcaptcha_symbolsToUse=ABCDEFGHJKLMNPQRSTWXYZ23456789
							return  '<img src="'+imageURL+'" style=\"float:left\" />';
						}
						var currentURLPath = "http://<?php echo $_SERVER["HTTP_HOST"];?>/<?php echo dirname($_SERVER["PHP_SELF"]);?>/";
						</script>
						<style>
						#ToolTip {
						  position:fixed;
						 
						  visibility:hidden;
						   z-index:10000;
						  background-color:#dee7f7;
						  border:1px solid #337;
						  width:auto; padding:4px;
						  height:auto;
						  color:#000; font-size:11px; line-height:1.3;
						  font-family:verdana;
						}
						</style>
</head>

<body>
<ul>
  <li>
    <label id="jform_params_bgColor-lbl" for="jform_params_bgColor" title="">Background Color</label>
    <input name="jform[params][bgColor]" id="jform_params_bgColor" value="#2c8007" size="25" type="text" />
  </li>
</ul>
<ul>
  <li>
    <label id="jform_params_textColor-lbl" for="jform_params_textColor" title="">Text Color</label>
    <input name="jform[params][textColor]" id="jform_params_textColor" value="#ffffff" size="25" type="text" />
  </li>
</ul>
<ul>
  <li>
    <label id="jform_params_white_noise_density-lbl" for="jform_params_white_noise_density" title="">Noise in BG color</label>
    <select name="jform[params][white_noise_density]" id="jform_params_white_noise_density">
	<option selected="selected" value="0">0</option>
	<option value="0.1">0.1</option>
	<option value="0.2">0.2</option>
	<option value="0.3">0.3</option>
</select>
  </li>
</ul>
<ul>
  <li>
    <label id="jform_params_black_noise_density-lbl" for="jform_params_black_noise_density" title="">Noise in Text color</label>
    <select name="jform[params][black_noise_density]" id="jform_params_black_noise_density">
	<option selected="selected" value="0">0</option>
	<option value="0.1">0.1</option>
	<option value="0.2">0.2</option>
	<option value="0.3">0.3</option>
</select>
  </li>
</ul>
<?php
		    $defaultFont = $captcha->font_ttf;//'AdLibBT.TTF';
			$ttfPath =dirname(__FILE__)."/utils/ttfs"."/";
			$ttfsAvailable = "";
			if ($handle = opendir($ttfPath)) {
				
			
				
				while (false !== ($entry = readdir($handle))) {
					if(preg_match("@.*\.(ttf|otf)@i",$entry))
					{
						$selected = "";
						if($defaultFont == $entry)
						{
							$selected = " selected=\"selected\"";
						}
						$ttfsAvailable .=  "<option value=\"".$entry."\" $selected>".$entry."</option>\n";	
					}
				}
			
				
			
				closedir($handle);
			}
			if($ttfsAvailable != ''){
		?>
<ul>
  <li>
    <label id="jform_params_allowedSymbols-lbl" for="jform_params_allowedSymbols" title="">Allowed Symbols</label>
    <input name="jform[params][allowedSymbols]" id="jform_params_allowedSymbols" value="<?php echo $captcha->symbolsToUse;?>" size="50" type="text" />
  </li>
</ul>
<ul>
  <li>
    <label id="jform_params_imageFunction-lbl" for="jform_params_imageFunction" title="">Select Letter Type</label>
    <select name="jform[params][imageFunction]" id="jform_params_imageFunction" class="" aria-invalid="false">
	<option value="Plane">Plane letters</option>
	<option selected="selected" value="Adv">Distorted letters</option>
</select>
  </li>
</ul>

<ul>
  <li>
    <label id="jform_params_fontFile-lbl" for="jform_params_fontFile" title="">Select font</label>
    <select id="jform_params_fontFile" name="jform[params][fontFile]" class="" aria-invalid="false">
		
  <?php echo $ttfsAvailable;?>
	</select>
  </li>
</ul>
<ul>
  <li>
    <label id="jform_params_letterSize-lbl" for="jform_params_letterSize" title="">Select letter size</label>
    <select name="jform[params][letterSize]" id="jform_params_letterSize">
	<option value="24">24</option>
	<option selected="selected" value="36">36</option>
	<option value="48">48</option>
	<option value="72">72</option>
</select>
  </li>
</ul>
<?php }
else
{
	
	?>
    <ul>
        <li>
       <h1> To use more options, save required fonts(.TTF/.OTF)s in the folder utils/ttfs</h1>
        Adanced options available with ttfs are 
        <ol>
            <li>Letter Type (Plane or distorted)</li>
            <li>Allowed symbols</li>
            <li>Font</li>
            <li>Letter size</li>
        </ol>
        <input type="hidden" id="jform_params_imageFunction" name="jform[params][imageFunction]" value="<?php echo $captcha->imageFunction;?>" />
        <input type="hidden" id="jform_params_allowedSymbols" name="jform[params][allowedSymbols]" value="<?php echo $captcha->symbolsToUse;?>" />
        <input type="hidden" id="jform_params_fontFile"  name="jform[params][fontFile]" value="<?php echo $defaultFont;?>" />
        <input type="hidden" id="jform_params_letterSize"  name="jform[params][letterSize]" value="<?php echo $captcha->font_size;?>" />
       </li>
      </ul>
    
    <?php
}
?>


<ul>
  <li>
    <label id="jform_params__-lbl" for="jform_params__">Preview Captcha</label>
    <div id="ToolTip"></div>
    <span onmouseover="javascript:previewOSOLCaptcha(event,OSOLCaptchPreviewHTML())" onmouseout="javascript:hidePreviewOSOLCaptcha()"> Hover Mouse here to preview Captcha with entered settings </span></li>
</ul>
<ul>
	<li>
   <label id="jform_params__-lbl" for="jform_params__">Captcha URL with current settings:</label>
   <div id="captcha_url_div"   /></div>
   <p></p>
   </li>
   <li>
   
   <div id="test_captcha_div"   />Test Captcha  with current settings</div>
   </li>
</ul>
</body>
</html>