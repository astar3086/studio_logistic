<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 18.03.14
 * Time: 14:05
 */

namespace Utils;

/**
 * Class BitMask
 * @package Utils
 */
abstract class BitMask {

	/**
	 * @var int
	 */
	private $value;

	/**
	 * @param int $value
	 */
	public function __construct($value=0) {
		$this->value = $value;
	}

	/**
	 * @return int
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param $n
	 * @return bool
	 */
	public function get($n) {
		return ($this->value & $n) == $n;
	}

	/**
	 * @param $n
	 */
	public function set($n) {
		$this->value |= $n;
	}

	/**
	 * @param $n
	 */
	public function clear($n) {
		$this->value &= ~$n;
	}
}