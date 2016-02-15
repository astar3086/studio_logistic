<?php
namespace Validator\validators;
    /**
     * RequiredValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * RequiredValidator validates that the specified attribute does not have null or empty value.
     *
     * When using the {@link message} property to define a custom error message, the message
     * may contain additional placeholders that will be replaced with the actual content. In addition
     * to the "{attribute}" placeholder, recognized by all validators (see {@link \Validator\Validator}),
     * RequiredValidator allows for the following placeholders to be specified:
     * <ul>
     * <li>{value}: replaced with the desired value {@link requiredValue}.</li>
     * </ul>
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     * @since   1.0
     */
    class RequiredValidator extends \Validator\Validator
    {
        /**
         * @var mixed the desired value that the attribute must have.
         * If this is null, the validator will validate that the specified attribute does not have null or empty value.
         * If this is set as a value that is not null, the validator will validate that
         * the attribute has a value that is the same as this property value.
         * Defaults to null.
         */
        public $requiredValue;
        /**
         * @var boolean whether the comparison to {@link requiredValue} is strict.
         * When this is true, the attribute value and type must both match those of {@link requiredValue}.
         * Defaults to false, meaning only the value needs to be matched.
         * This property is only used when {@link requiredValue} is not null.
         */
        public $strict = false;
        /**
         * @var boolean whether the value should be trimmed with php trim() function when comparing strings.
         * When set to false, the attribute value is not considered empty when it contains spaces.
         * Defaults to true, meaning the value will be trimmed.
         * @since 1.1.14
         */
        public $trim = true;

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
            if($this->requiredValue !== null)
            {
                if(!$this->strict && $value != $this->requiredValue || $this->strict && $value !== $this->requiredValue)
                {
                    $message = $this->message !== null
                        ? $this->message
                        : ['{attribute} must be {value}.',
                            ['{value}' => $this->requiredValue]];
                    $this->addError($object, $attribute, $message);
                }
            }
            elseif($this->isEmpty($value, $this->trim))
            {
                $message = $this->message !== null ? $this->message : '{attribute} cannot be blank.';
                $this->addError($object, $attribute, $message);
            }
        }
    }
