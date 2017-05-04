<?php

//$recaptcha = $_POST('g-recaptcha-response');
//
//	if(!$recaptcha){
//		$secret ='6Ld6hB0UAAAAABPnKhEohOkSSzGekbEZmESA90Wz';
//		$ip = $_SERVER['REMOTE_ADDR'];
//		$sicaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
//		$respuesta = json_decode($sicaptcha, true);
//
//		if($respuesta['success']){
//			return $respuesta;
//		}else{
//			return $respuesta;
//		}
//	}else {
//		return $respuesta;
//	}

	require_once('recaptchalib.php');
 $privatekey = "6Ld6hB0UAAAAABPnKhEohOkSSzGekbEZmESA90Wz";
 $resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
 
 if (!$resp->is_valid) {
      //ERROR EN EL CAPTCHA
      echo 0;
 }else{
      //CAPTCHA CORRECTO
      echo 1;
 }
?>