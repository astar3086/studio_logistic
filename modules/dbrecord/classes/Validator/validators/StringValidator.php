<?php
namespace Validator\validators;
    /**
     * StringValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * StringValidator validates that the attribute value is of certain length.
     *
     * Note, this validator should only be used with string-typed attributes.
     *
     * In addition to the {@link message} property for setting a custom error message,
     * StringValidator has a couple custom error messages you can set that correspond to different
     * validation scenarios. For defining a custom message when the string is too short,
     * you may use the {@link tooShort} property. Similarly with {@link tooLong}. The messages may contain
     * placeholders that will be replaced with the actual content. In addition to the "{attribute}"
     * placeholder, recognized by all validators (see {@link \Validator\Validator}), CStringValidator allows for the following
     * placeholders to be specified:
     * <ul>
     * <li>{min}: when using {@link tooShort}, replaced with minimum length, {@link min}, if set.</li>
     * <li>{max}: when using {@link tooLong}, replaced with the maximum length, {@link max}, if set.</li>
     * <li>{length}: when using {@link message}, replaced with the exact required length, {@link is}, if set.</li>
     * </ul>
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     * @since   1.0
     */
    class StringValidator extends \Validator\Validator
    {
        /**
         * @var integer maximum length. Defaults to null, meaning no maximum limit.
         */
        public $max;
        /**
         * @var integer minimum length. Defaults to null, meaning no minimum limit.
         */
        public $min;
        /**
         * @var integer exact length. Defaults to null, meaning no exact length limit.
         */
        public $is;
        /**
         * @var string user-defined error message used when the value is too short.
         */
        public $tooShort;
        /**
         * @var string user-defined error message used when the value is too long.
         */
        public $tooLong;
        /**
         * @var boolean whether the attribute value can be null or empty. Defaults to true,
         * meaning that if the attribute is empty, it is considered valid.
         */
        public $allowEmpty = true;
        /**
         * @var string the encoding of the string value to be validated (e.g. 'UTF-8').
         * This property is used only when mbstring PHP extension is enabled.
         * The value of this property will be used as the 2nd parameter of the
         * mb_strlen() function. If this property is not set, the application charset
         * will be used.
         * If this property is set false, then strlen() will be used even if mbstring is enabled.
         * @since 1.1.1
         */
        public $encoding;

        /**
         * Validates the attribute of the object.
         * If there is any error, the error message is added to the object.
         *
         * @param \Model $object    the object being validated
         * @param string $attribute the attribute being validated
         */
        protected function validateAttribute($object, $attribute)
        {
            $value = $object->$attribute;
            if($this->allowEmpty && $this->isEmpty($value))
            {
                return;
            }

            if(is_array($value))
            {
                // https://github.com/yiisoft/yii/issues/1955
                $this->addError($object, $attribute, '{attribute} is invalid.');

                return;
            }

            /*if(function_exists('mb_strlen') && $this->encoding !== false)
            {
                $length = mb_strlen($value, $this->encoding ? $this->encoding : Yii::app()->charset);
            }
            else
            {

            }*/
	        $length = strlen($value);

            if($this->min !== null && $length < $this->min)
            {
                $message = $this->tooShort !== null ? $this->tooShort
                    : '{attribute} is too short (minimum is {min} characters).';
                $this->addError($object, $attribute, $message, ['{min}' => $this->min]);
            }
            if($this->max !== null && $length > $this->max)
            {
                $message = $this->tooLong !== null ? $this->tooLong
                    : '{attribute} is too long (maximum is {max} characters).';
                $this->addError($object, $attribute, $message, ['{max}' => $this->max]);
            }
            if($this->is !== null && $length !== $this->is)
            {
                $message = $this->message !== null ? $this->message
                    : '{attribute} is of the wrong length (should be {length} characters).';
                $this->addError($object, $attribute, $message, ['{length}' => $this->is]);
            }
        }
    }

