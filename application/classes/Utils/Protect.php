<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 04.12.13
 * Time: 15:49
 */
/**
 * Created by StarCOM.
 * Author: Stanislav Tsepenuk Aleksandrovich
 * E-mail: starcomdj@gmail.com
 * Date: 10.02.13
 * Time: 15:27
 */
namespace Utils;
use Database\Exception;

/**
 * Class Protect
 * @package Utils
 */
class Protect extends \Valid{
	/**
	 *
	 */
	const DEFAULT_USERNAME_MIN_LEN = 3;     // Минимальная длина логина.
	/**
	 *
	 */
	const DEFAULT_USERNAME_MAX_LEN = 32;    // Максимальная длина логина.

	/**
	 * secure
	 * @param $var
	 * @param bool $quot
	 * @return array|string
	 */
	public static function secure($var, $quot = true){
		if(is_array($var)){
			$ret = array();
			foreach($var as $key => $val){
				$ret[$key] = Protect::secure($val, $quot);
			}
		}else{
			if($quot){
				$ret = htmlspecialchars(stripslashes(trim($var)), ENT_QUOTES);
			}else{
				$ret = htmlspecialchars(stripslashes(trim($var)));
			}
		}
		return $ret;
	}

	/**
	 * unsecure
	 * @param $var
	 * @param bool $quot
	 * @return array|string
	 */
	public static function unsecure($var, $quot = true){
		if(is_array($var)){
			$ret = array();
			foreach($var as $key => $val){
				$ret[$key] = Protect::unsecure($val, $quot);
			}
		}else{
			if($quot){
				$ret = htmlspecialchars_decode($var, ENT_QUOTES);
			}else{
				$ret = htmlspecialchars_decode($var);
			}
		}
		return $ret;
	}

	/**
	 * Clean
	 * @param $string
	 * @return string
	 */
	public static function Clean($string){
		$str = trim($string);
		$str = nl2br($str);
		$str = stripslashes($str);
		$str = htmlspecialchars($str);
		$str = addslashes($str);
		return $str;
	}

	/**
	 * Str
	 *
	 * @param $string
	 * @return string
	 */
	public static function Str($string){
		$str = htmlspecialchars_decode($string);
		$str = stripslashes($str);
		return $str;
	}


	/**
	 * @param $pass
	 * @param $salt
	 * @return string
	 */
	public static function Crypt($pass, $salt)
	{
		$spec = ['~','!','@','#','$','%','^','&','*','?'];
		$crypted = md5(md5($pass) . md5($salt));
		$c_text = md5($pass);
		$tmp = '';
		for($i = 0; $i < strlen($crypted); $i++)
		{
			if(ord($c_text[$i]) >= 48 and ord($c_text[$i]) <= 57)
			{
				$tmp .= $spec[$c_text[$i]];
			}
			elseif(ord($c_text[$i]) >= 97 and ord($c_text[$i]) <= 100)
			{
				$tmp .= strtoupper($crypted[$i]);
			}
			else
			{
				$tmp .= $crypted[$i];
			}
		}
		return md5($tmp);

	}

	/**
	 * Validate
	 * @param $var
	 * @param $type
	 * @param null $flag
	 * @return mixed
	 */
	public static function Validate($var, $type, $flag = null){
		if(is_array($var)){
			$tmp_arr = [];
			foreach($var as $key => $val){
				$tmp_arr[$key] = Protect::Validate($val, $type);
			}
			return $tmp_arr;
		}else{
			switch($type){
				default:
					$type = FILTER_DEFAULT;
					break;
				case 'bool':
					$type = FILTER_VALIDATE_BOOLEAN;
					break;
				case 'float':
					$type = FILTER_VALIDATE_FLOAT;
					break;
				case 'int':
					$type = FILTER_VALIDATE_INT;
					break;
				case 'ip':
					$type = FILTER_VALIDATE_IP;
					break;
				case 'email':
					$type = FILTER_VALIDATE_EMAIL;
					break;
				case 'url':
					$type = FILTER_VALIDATE_URL;
					break;
				case 'regexp':
					$type = FILTER_VALIDATE_REGEXP;
					break;
				case 'double':
					return is_double($var) ? $var : false;
				case 'array':
					return is_array($var) ? $var : false;
				case 'dir':
					return is_dir($var) ? $var : false;
				case 'upload':
					return is_uploaded_file($var) ? $var : false;
				case 'exec':
					return is_executable($var) ? $var : false;
				case 'file':
					return is_file($var) ? $var : false;
				case 'link':
					return is_link($var) ? $var : false;
				case 'read':
					return is_readable($var) ? $var : false;
				case 'write':
					return is_writable($var) ? $var : false;
				case 'null':
					return is_null($var) ? true : false;
				case 'resource':
					return is_resource($var) ? $var : false;
				case 'login':
					return preg_match("/^[a-zA-Z0-9_\.-]+$/", $var) && strlen($var) >= self::DEFAULT_USERNAME_MIN_LEN && strlen($var) <= self::DEFAULT_USERNAME_MAX_LEN ? $var : false;
			}

			switch($flag){
				default:
					$flag = null;
					break;
				case 'ipv4':
					$flag = $type == 'ip' ? FILTER_FLAG_IPV4 : null;
					break;
				case 'ipv6':
					$flag = $type == 'ip' ? FILTER_FLAG_IPV6 : null;
					break;
				case 'ip_p':
					$flag = $type == 'ip' ? FILTER_FLAG_NO_PRIV_RANGE : null;
					break;
				case 'ip_r':
					$flag = $type == 'ip' ? FILTER_FLAG_NO_RES_RANGE : null;
					break;
				case 'thousand':
					$flag = $type == 'float' ? FILTER_FLAG_ALLOW_THOUSAND : null;
					break;
				case 'octal':
					$flag = $type == 'int' ? FILTER_FLAG_ALLOW_OCTAL : null;
					break;
				case 'hex':
					$flag = $type == 'int' ? FILTER_FLAG_ALLOW_HEX : null;
					break;
				case 'bool_null':
					$flag = $type == 'bool' ? FILTER_NULL_ON_FAILURE : null;
					break;
			}
		}
		return filter_var($var, $type, $flag);
	}

	/**
	 * @param array $array_data
	 * @param array $list
	 * @throws \Database\Exception
	 */
	public static function IssetArray($array_data,$list)
	{
		throw new Exception('TODO! Add function body');
	}
}