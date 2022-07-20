<?php

class Util
{

	//implementamos nuestro constructor
	public function __construct()
	{
	}

function encrypt_decrypt($action, $string)
	{
		$output = false;

		$encrypt_method = "AES-256-CBC";
		$secret_key = 'This is my secret key';
		$secret_iv = 'This is my secret iv';

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a
		// warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		if ($action == 'encrypt') {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else {
			if ($action == 'decrypt') {
				$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
			}
		}

		return $output;
	}

	function getRealIP()
	{

		if (isset($_SERVER["HTTP_CLIENT_IP"]))
		{
			return $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
			return $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
		{
			return $_SERVER["HTTP_X_FORWARDED"];
		}
		elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
		{
			return $_SERVER["HTTP_FORWARDED_FOR"];
		}
		elseif (isset($_SERVER["HTTP_FORWARDED"]))
		{
			return $_SERVER["HTTP_FORWARDED"];
		}
		else
		{
			return $_SERVER["REMOTE_ADDR"];
		}

	}

	function validateExpiredSession()
	{
		$time_session_seconds = 60000; //tiempo de session en segundos (10minutos)
		$result = false;
		if(time()-$_SESSION["login_time_stamp"] > $time_session_seconds) 
		{
			$result = true;
		}
		return $result;
	}


	function xss_clean($data)
	{
		// Fix &entity\n;
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

		// Remove any attribute starting with "on" or xmlns
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

		// Remove javascript: and vbscript: protocols
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

		// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

		do
		{
			// Remove really unwanted tags
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		}
		while ($old_data !== $data);


		$return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $data );
		$return_str = str_ireplace( '%3Cscript', '', $return_str );
		return $return_str;

		// we are done...
		//return $data;

	}

}
