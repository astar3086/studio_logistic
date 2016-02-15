<?php
namespace Validator\validators;
    /**
     * RegularExpressionValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * RegularExpressionValidator validates that the attribute value matches to the specified {@link pattern regular expression}.
     * You may invert the validation logic with help of the {@link not} property (available since 1.1.5).
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     * @since   1.0
     */
    class RegularExpressionValidator extends \Validator\Validator
    {
        /**
         * @var string the regular expression to be matched with
         */
        public $pattern;
        /**
         * @var boolean whether the attribute value can be null or empty. Defaults to true,
         * meaning that if the attribute is empty, it is considered valid.
         */
        public $allowEmpty = true;
        /**
         * @var boolean whether to invert the validation logic. Defaults to false. If set to true,
         * the regular expression defined via {@link pattern} should NOT match the attribute value.
         * @since 1.1.5
         **/
        public $not = false;

        /**
         * Validates the attribute of the object.
         * If there is any error, the error message is added to the object.
         *
         * @param \Model $object    the object being validated
         * @param string $attribute the attribute being validated
         *
         * @throws \Kohana_Exception if given {@link pattern} is empty
         */
        protected function validateAttribute($object, $attribute)
        {
            $value = $object->$attribute;
            if($this->allowEmpty && $this->isEmpty($value))
            {
                return;
            }
            if($this->pattern === null)
            {
                throw new \Kohana_Exception('The "pattern" property must be specified with a valid regular expression.');
            }
            // reason of array checking explained here: https://github.com/yiisoft/yii/issues/1955
            if(is_array($value) ||
                (!$this->not && !preg_match($this->pattern, $value)) ||
                ($this->not && preg_match($this->pattern, $value))
            )
            {
                $message = $this->message !== null ? $this->message : '{attribute} is invalid.';
                $this->addError($object, $attribute, $message);
            }
        }
    }