<?php
/**
 * \Database\ActiveRecord\Behavior class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * \Database\ActiveRecord\Behavior is the base class for behaviors that can be attached to {@link \Database\ActiveRecord\Record}.
 * Compared with {@link CModelBehavior}, \Database\ActiveRecord\Behavior attaches to more events
 * that are only defined by {@link \Database\ActiveRecord\Record}.
 *
 * @property \Database\ActiveRecord\Record $owner The owner AR that this behavior is attached to.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db.ar
 */
namespace classes\Database\ActiveRecord;
class Behavior extends ModelBehavior
{
	/**
	 * Declares events and the corresponding event handler methods.
	 * If you override this method, make sure you merge the parent result to the return value.
	 * @return array events (array keys) and the corresponding event handler methods (array values).
	 * @see CBehavior::events
	 */
	public function events()
	{
		return array_merge(parent::events(), [
			'onBeforeSave'=>'beforeSave',
			'onAfterSave'=>'afterSave',
			'onBeforeDelete'=>'beforeDelete',
			'onAfterDelete'=>'afterDelete',
			'onBeforeFind'=>'beforeFind',
			'onAfterFind'=>'afterFind',
			'onBeforeCount'=>'beforeCount',
		]);
	}

	/**
	 * Responds to {@link \Database\ActiveRecord\Record::onBeforeSave} event.
	 * Override this method and make it public if you want to handle the corresponding
	 * event of the {@link CBehavior::owner owner}.
	 * You may set {@link CModelEvent::isValid} to be false to quit the saving process.
	 * @param CModelEvent $event event parameter
	 */
	protected function beforeSave($event)
	{
	}

	/**
	 * Responds to {@link \Database\ActiveRecord\Record::onAfterSave} event.
	 * Override this method and make it public if you want to handle the corresponding event
	 * of the {@link CBehavior::owner owner}.
	 * @param CModelEvent $event event parameter
	 */
	protected function afterSave($event)
	{
	}

	/**
	 * Responds to {@link \Database\ActiveRecord\Record::onBeforeDelete} event.
	 * Override this method and make it public if you want to handle the corresponding event
	 * of the {@link CBehavior::owner owner}.
	 * You may set {@link CModelEvent::isValid} to be false to quit the deletion process.
	 * @param CEvent $event event parameter
	 */
	protected function beforeDelete($event)
	{
	}

	/**
	 * Responds to {@link \Database\ActiveRecord\Record::onAfterDelete} event.
	 * Override this method and make it public if you want to handle the corresponding event
	 * of the {@link CBehavior::owner owner}.
	 * @param CEvent $event event parameter
	 */
	protected function afterDelete($event)
	{
	}

	/**
	 * Responds to {@link \Database\ActiveRecord\Record::onBeforeFind} event.
	 * Override this method and make it public if you want to handle the corresponding event
	 * of the {@link CBehavior::owner owner}.
	 * @param CEvent $event event parameter
	 */
	protected function beforeFind($event)
	{
	}

	/**
	 * Responds to {@link \Database\ActiveRecord\Record::onAfterFind} event.
	 * Override this method and make it public if you want to handle the corresponding event
	 * of the {@link CBehavior::owner owner}.
	 * @param CEvent $event event parameter
	 */
	protected function afterFind($event)
	{
	}

	/**
	 * Responds to {@link \Database\ActiveRecord\Record::onBeforeCount} event.
	 * Override this method and make it public if you want to handle the corresponding event
	 * of the {@link CBehavior::owner owner}.
	 * @param CEvent $event event parameter
	 * @since 1.1.14
	 */
	protected function beforeCount($event)
	{
	}
}
