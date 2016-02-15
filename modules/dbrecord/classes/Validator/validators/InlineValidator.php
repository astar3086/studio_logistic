<?php
    namespace Validator\validators;
    /**
     * InlineValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * InlineValidator represents a validator which is defined as a method in the object being validated.
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     * @since   1.0
     */
    class InlineValidator extends \Validator\Validator
    {
        /**
         * @var string the name of the validation method defined in the active record class
         */
        public $method;
        /**
         * @var array additional parameters that are passed to the validation method
         */
        public $params;
        /**
         * @var string the name of the method that returns the client validation code (See {@link clientValidateAttribute}).
         */
        public $clientValidate;

        /**
         * Validates the attribute of the object.
         * If there is any error, the error message is added to the object.
         *
         * @param \Model $object    the object being validated
         * @param string $attribute the attribute being validated
         */
        protected function validateAttribute($object, $attribute)
        {
            $method = $this->method;
            $object->$method($attribute, $this->params);
        }
    }
