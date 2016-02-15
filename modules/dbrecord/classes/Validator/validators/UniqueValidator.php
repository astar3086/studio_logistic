<?php
namespace Validator\validators;
    /**
     * UniqueValidator class file.
     *
     * @author    Qiang Xue <qiang.xue@gmail.com>
     * @link      http://www.yiiframework.com/
     * @copyright 2008-2013 Yii Software LLC
     * @license   http://www.yiiframework.com/license/
     */


    /**
     * UniqueValidator validates that the attribute value is unique in the corresponding database table.
     *
     * When using the {@link message} property to define a custom error message, the message
     * may contain additional placeholders that will be replaced with the actual content. In addition
     * to the "{attribute}" placeholder, recognized by all validators (see {@link \Validator\Validator}),
     * UniqueValidator allows for the following placeholders to be specified:
     * <ul>
     * <li>{value}: replaced with current value of the attribute.</li>
     * </ul>
     *
     * @author  Qiang Xue <qiang.xue@gmail.com>
     * @package system.validators
     * @since   1.0
     */
    class UniqueValidator extends \Validator\Validator
    {
        /**
         * @var boolean whether the comparison is case sensitive. Defaults to true.
         * Note, by setting it to false, you are assuming the attribute type is string.
         */
        public $caseSensitive = true;
        /**
         * @var boolean whether the attribute value can be null or empty. Defaults to true,
         * meaning that if the attribute is empty, it is considered valid.
         */
        public $allowEmpty = true;
        /**
         * @var string the ActiveRecord class name that should be used to
         * look for the attribute value being validated. Defaults to null, meaning using
         * the class of the object currently being validated.
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
         * @var string the user-defined error message. The placeholders "{attribute}" and "{value}"
         * are recognized, which will be replaced with the actual attribute name and value, respectively.
         */
        public $message;
        /**
         * @var boolean whether this validation rule should be skipped if when there is already a validation
         * error for the current attribute. Defaults to true.
         * @since 1.1.1
         */
        public $skipOnError = true;


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
            $criteria = new DbCriteria();
            if($this->criteria !== [])
            {
                $criteria->mergeWith($this->criteria);
            }
            $tableAlias = empty($criteria->alias) ? $finder->getTableAlias(true) : $criteria->alias;
            $valueParamName = DbCriteria::PARAM_PREFIX.CDbCriteria::$paramCount++;
            $criteria->addCondition($this->caseSensitive ? "{$tableAlias}.{$columnName}={$valueParamName}"
                : "LOWER({$tableAlias}.{$columnName})=LOWER({$valueParamName})");
            $criteria->params[$valueParamName] = $value;

            if(!$object instanceof \Database\ActiveRecord\Record || $object->isNewRecord || $object->tableName() !== $finder->tableName())
            {
                $exists = $finder->exists($criteria);
            }
            else
            {
                $criteria->limit = 2;
                $objects = $finder->findAll($criteria);
                $n = count($objects);
                if($n === 1)
                {
                    //TODO: implement getter
                    if($column->isPrimaryKey) // primary key is modified and not unique
                    {
                        $exists = $object->getOldPrimaryKey() != $object->getPrimaryKey();
                    }
                    else
                    {
                        // non-primary key, need to exclude the current record based on PK
                        $exists = array_shift($objects)->getPrimaryKey() != $object->getOldPrimaryKey();
                    }
                }
                else
                {
                    $exists = $n > 1;
                }
            }

            if($exists)
            {
                $message = $this->message !== null ? $this->message : '{attribute} "{value}" has already been taken.';
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

