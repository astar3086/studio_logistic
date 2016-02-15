<?php
namespace Validator\validators;
    /**
     * BooleanValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * BooleanValidator validates that the attribute value is either {@link trueValue}  or {@link falseValue}.
     *
     * When using the {@link message} property to define a custom error message, the message
     * may contain additional placeholders that will be replaced with the actual content. In addition
     * to the "{attribute}" placeholder, recognized by all validators (see {@link \Validator\Validator}),
     * CBooleanValidator allows for the following placeholders to be specified:
     * <ul>
     * <li>{true}: replaced with value representing the true status {@link trueValue}.</li>
     * <li>{false}: replaced with value representing the false status {@link falseValue}.</li>
     * </ul>
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     */
    class BooleanValidator extends \Validator\Validator
    {
        /**
         * @var mixed the value representing true status. Defaults to '1'.
         */
        public $trueValue = '1';
        /**
         * @var mixed the value representing false status. Defaults to '0'.
         */
        public $falseValue = '0';
        /**
         * @var boolean whether the comparison to {@link trueValue} and {@link falseValue} is strict.
         * When this is true, the attribute value and type must both match those of {@link trueValue} or {@link falseValue}.
         * Defaults to false, meaning only the value needs to be matched.
         */
        public $strict = false;
        /**
         * @var boolean whether the attribute value can be null or empty. Defaults to true,
         * meaning that if the attribute is empty, it is considered valid.
         */
        public $allowEmpty = true;

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
            if(!$this->strict && $value != $this->trueValue && $value != $this->falseValue
                || $this->strict && $value !== $this->trueValue && $value !== $this->falseValue
            )
            {
                $message = $this->message !== null ? $this->message : '{attribute} must be either {true} or {false}.';
                $this->addError($object, $attribute, $message, [
                    '{true}'  => $this->trueValue,
                    '{false}' => $this->falseValue,
                ]);
            }
        }
    }
