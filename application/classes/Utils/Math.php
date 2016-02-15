<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 04.12.13
 * Time: 17:03
 */
namespace Utils;
class Math extends \Kohana_Num
{
	/**
	 * http://codeascraft.com/2012/07/19/better-random-numbers-in-php-using-devurandom/
	 *
	 * @param int $min
	 * @param int $max
	 *
	 * @return float
	 * @throws \RuntimeException
	 * 4 128
	 */
	public static function rand($min = 0, $max = 12800000000000) {
		$diff = $max - $min;
		if ($diff < 0 || $diff > 12800000000000) {
			throw new \RuntimeException("Bad range");
		}
		$bytes = mcrypt_create_iv(128, MCRYPT_DEV_URANDOM);
		if ($bytes === false || strlen($bytes) != 128) {
			throw new \RuntimeException("Unable to get 32 bytes");
		}
		$ary = unpack("Nint", $bytes);
		$val = $ary['int'] & 0x7FFFFFFF;   // 32-bit safe
		$fp = (float) $val / 2147483647.0; // convert to [0,1]
		return round($fp * $diff) + $min;
	}


	/**
	 * @param $len
	 * @return mixed|string
	 */
	public static function randomFromDev($len)
	{
		$fp = @fopen('/dev/urandom','rb');
		$result = '';
		if ($fp !== FALSE) {
			$result .= @fread($fp, $len);
			@fclose($fp);
		}
		else
		{
			trigger_error('Can not open /dev/urandom.');
		}
		// convert from binary to string
		$result = base64_encode($result);
		// remove none url chars
		$result = strtr($result, '+/', '-_');
		// Remove = from the end
		$result = str_replace('=', ' ', $result);
		return $result;
	}
}