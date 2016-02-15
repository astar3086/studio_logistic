<?php
namespace Validator\validators;
    /**
     * NumberValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * NumberValidator validates that the attribute value is a number.
     *
     * In addition to the {@link message} property for setting a custom error message,
     * NumberValidator has a couple custom error messages you can set that correspond to different
     * validation scenarios. To specify a custom message when the numeric value is too big,
     * you may use the {@link tooBig} property. Similarly with {@link tooSmall}.
     * The messages may contain additional placeholders that will be replaced
     * with the actual content. In addition to the "{attribute}" placeholder, recognized by all
     * validators (see {@link \Validator\Validator}), CNumberValidator allows for the following placeholders
     * to be specified:
     * <ul>
     * <li>{min}: when using {@link tooSmall}, replaced with the lower limit of the number {@link min}.</li>
     * <li>{max}: when using {@link tooBig}, replaced with the upper limit of the number {@link max}.</li>
     * </ul>
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     * @since   1.0
     */
    class NumberValidator extends \Validator\Validator
    {
        /**
         * @var boolean whether the attribute value can only be an integer. Defaults to false.
         */
        public $integerOnly = false;
        /**
         * @var boolean whether the attribute value can be null or empty. Defaults to true,
         * meaning that if the attribute is empty, it is considered valid.
         */
        public $allowEmpty = true;
        /**
         * @var integer|float upper limit of the number. Defaults to null, meaning no upper limit.
         */
        public $max;
        /**
         * @var integer|float lower limit of the number. Defaults to null, meaning no lower limit.
         */
        public $min;
        /**
         * @var string user-defined error message used when the value is too big.
         */
        public $tooBig;
        /**
         * @var string user-defined error message used when the value is too small.
         */
        public $tooSmall;
        /**
         * @var string the regular expression for matching integers.
         * @since 1.1.7
         */
        public $integerPattern = '/^\s*[+-]?\d+\s*$/';
        /**
         * @var string the regular expression for matching numbers.
         * @since 1.1.7
         */
        public $numberPattern = '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/';


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
            if(!is_numeric($value))
            {
                // https://github.com/yiisoft/yii/issues/1955
                // https://github.com/yiisoft/yii/issues/1669
                $message = $this->message !== null ? $this->message : '{attribute} must be a number.';
                $this->addError($object, $attribute, $message);

                return;
            }
            if($this->integerOnly)
            {
                if(!preg_match($this->integerPattern, "$value"))
                {
                    $message = $this->message !== null ? $this->message : '{attribute} must be an integer.';
                    $this->addError($object, $attribute, $message);
                }
            }
            else
            {
                if(!preg_match($this->numberPattern, "$value"))
                {
                    $message = $this->message !== null ? $this->message : '{attribute} must be a number.';
                    $this->addError($object, $attribute, $message);
                }
            }
            if($this->min !== null && $value < $this->min)
            {
                $message = $this->tooSmall !== null ? $this->tooSmall : '{attribute} is too small (minimum is {min}).';
                $this->addError($object, $attribute, $message, ['{min}' => $this->min]);
            }
            if($this->max !== null && $value > $this->max)
            {
                $message = $this->tooBig !== null ? $this->tooBig : '{attribute} is too big (maximum is {max}).';
                $this->addError($object, $attribute, $message, ['{max}' => $this->max]);
            }
        }
    }
