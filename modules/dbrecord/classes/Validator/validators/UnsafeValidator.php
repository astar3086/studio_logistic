<?php
namespace Validator\validators;
    /**
     * UnsafeValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * UnsafeValidator marks the associated attributes to be unsafe so that they cannot be massively assigned.
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     * @since   1.0
     */
    class UnsafeValidator extends \Validator\Validator
    {
        /**
         * @var boolean whether attributes listed with this validator should be considered safe for massive assignment.
         * Defaults to false.
         * @since 1.1.4
         */
        public $safe = false;

        /**
         * Validates the attribute of the object.
         * This validator does not do any validation as it is meant
         * to only mark attributes as unsafe.
         *
         * @param \Model $object    the object being validated
         * @param string $attribute the attribute being validated
         */
        protected function validateAttribute($object, $attribute)
        {
        }
    }

