<?php
    /**
     * ExistValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * ExistValidator validates that the attribute value exists in a table.
     *
     * This validator is often used to verify that a foreign key contains a value
     * that can be found in the foreign table.
     *
     * When using the {@link message} property to define a custom error message, the message
     * may contain additional placeholders that will be replaced with the actual content. In addition
     * to the "{attribute}" placeholder, recognized by all validators (see {@link \Validator\Validator}),
     * CExistValidator allows for the following placeholders to be specified:
     * <ul>
     * <li>{value}: replaced with value of the attribute.</li>
     * </ul>
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     */
    class ExistValidator extends \Validator\Validator
    {
        /**
         * @var boolean whether the comparison is case sensitive. Defaults to true.
         * Note, by setting it to false, you are assuming the attribute type is string.
         */
        public $caseSensitive = true;
        /**
         * @var string the ActiveRecord class name that should be used to
         * look for the attribute value being validated. Defaults to null,
         * meaning using the ActiveRecord class of the attribute being validated.
         * You may use path alias to reference a class name here.
         * @see attributeName
         */
        public $className;
        /**
         * @var string the ActiveRecord class attribute name that should be
         * used to look for the attribute value being validated. Defaults to null,
         * meaning using the name of the attribute being validated.
         * @see className
         */
        public $attributeName;
        /**
         * @var mixed additional query criteria. Either an array or \Database\schema\Criteria.
         * This will be combined with the condition that checks if the attribute
         * value exists in the corresponding table column.
         * This array will be used to instant\Database\schema\Criteriank CDbCriteria} object.
         */
        public $criteria = [];
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
         *
         * @throws \Kohana_Exception if given table does not have specified column name
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

            $className = $this->className === null ? get_class($object) : Yii::import($this->className);
            $attributeName = $this->attributeName === null ? $attribute : $this->attributeName;
            $finder = $this->getModel($className);
            $table = $finder->getTableSchema();
            if(($column = $table->getColumn($attributeName)) === null)
            {
                throw new \Kohana_Exception('Table "{table}" does not have a column named "{column}".',
                    ['{column}' => $attributeName, '{table}' => $table->name]);
            }

            $columnName = $column->rawName;
            $criteria = new DBCriteria();
            if($this->criteria !== [])
            {
                $criteria->mergeWith($this->criteria);
            }
            $tableAlias = empty($criteria->alias) ? $finder->getTableAlias(true) : $criteria->alias;
            $valueParamName = DbCriteria::PARAM_PREFIX.CDbCriteria::$paramCount++;
            $criteria->addCondition($this->caseSensitive ? "{$tableAlias}.{$columnName}={$valueParamName}"
                : "LOWER({$tableAlias}.{$columnName})=LOWER({$valueParamName})");
            $criteria->params[$valueParamName] = $value;

            if(!$finder->exists($criteria))
            {
                $message = $this->message !== null ? $this->message : '{attribute} "{value}" is invalid.';
                $this->addError($object, $attribute, $message, ['{value}' => CHtml::encode($value)]);
            }
        }

        /**
         * Given active record class name returns new model instance.
         *
         * @param string $className active record class name.
         *
         * @return \Database\ActiveRecord\Record active record model instance.
         *
         * @since 1.1.14
         */
        protected function getModel($className)
        {
            return \Database\ActiveRecord\Record::model($className);
        }
    }
