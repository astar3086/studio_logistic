<?php
namespace Validator\validators;
    /**
     * RangeValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * RangeValidator validates that the attribute value is among the list (specified via {@link range}).
     * You may invert the validation logic with help of the {@link not} property (available since 1.1.5).
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     * @since   1.0
     */
    class RangeValidator extends \Validator\Validator
    {
        /**
         * @var array list of valid values that the attribute value should be among
         */
        public $range;
        /**
         * @var boolean whether the comparison is strict (both type and value must be the same)
         */
        public $strict = false;
        /**
         * @var boolean whether the attribute value can be null or empty. Defaults to true,
         * meaning that if the attribute is empty, it is considered valid.
         */
        public $allowEmpty = true;
        /**
         * @var boolean whether to invert the validation logic. Defaults to false. If set to true,
         * the attribute value should NOT be among the list of values defined via {@link range}.
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
         * @throws \Kohana_Exception if given {@link range} is not an array
         */
        protected function validateAttribute($object, $attribute)
        {
            $value = $object->$attribute;
            if($this->allowEmpty && $this->isEmpty($value))
            {
                return;
            }
            if(!is_array($this->range))
            {
                throw new \Kohana_Exception('The "range" property must be specified with a list of values.');
            }
            $result = false;
            if($this->strict)
            {
                $result = in_array($value, $this->range, true);
            }
            else
            {
                foreach($this->range as $r)
                {
                    $result = (strcmp($r, $value) === 0);
                    if($result)
                    {
                        break;
                    }
                }
            }
            if(!$this->not && !$result)
            {
                $message = $this->message !== null ? $this->message : '{attribute} is not in the list.';
                $this->addError($object, $attribute, $message);
            }
            elseif($this->not && $result)
            {
                $message = $this->message !== null ? $this->message : '{attribute} is in the list.';
                $this->addError($object, $attribute, $message);
            }
        }
    }