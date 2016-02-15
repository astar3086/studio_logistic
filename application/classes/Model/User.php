<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $iduser
 * @property integer $gender
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $login
 * @property string $email
 * @property string $pass
 * @property string $salt
 * @property string $avatar
 * @property integer $last_login
 * @property integer $access_level
 *
 * The followings are the available model relations:
 * @property Questions[] $questions
 * @property Questions[] $questions1
 * @property ULogin[] $uLogins
 * @property UserCards[] $userCards
 * @property UserCredit[] $userCredits
 * @property UserPersonal[] $userPersonals
 * @property UserSession[] $userSessions
 */
class User extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gender, last_login, access_level', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, email', 'length', 'max'=>45),
			array('phone', 'length', 'max'=>15),
			array('login', 'length', 'max'=>20),
			array('pass', 'length', 'max'=>100),
			array('salt', 'length', 'max'=>120),
			array('avatar', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iduser, gender, first_name, last_name, phone, login, email, pass, salt, avatar, last_login, access_level', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'questions' => array(self::HAS_MANY, 'Questions', 'receiver_id'),
			'questions1' => array(self::HAS_MANY, 'Questions', 'sender_id'),
			'uLogins' => array(self::HAS_MANY, 'ULogin', 'iduser'),
			'userCards' => array(self::HAS_MANY, 'UserCards', 'iduser'),
			'userCredits' => array(self::HAS_MANY, 'UserCredit', 'iduser'),
			'userPersonals' => array(self::HAS_MANY, 'UserPersonal', 'iduser'),
			'userSessions' => array(self::HAS_MANY, 'UserSession', 'iduser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iduser' => 'Iduser',
			'gender' => 'Gender',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'phone' => 'Phone',
			'login' => 'Login',
			'email' => 'Email',
			'pass' => 'Pass',
			'salt' => 'Salt',
			'avatar' => 'Avatar',
			'last_login' => 'Last Login',
			'access_level' => 'Access Level',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('last_login',$this->last_login);
		$criteria->compare('access_level',$this->access_level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return bool|\Model\UserSession
	 */
	public function isGuest()
	{
		$status = \Auth\Base::Check();

		if( $status == false )
		{
			return true;

		} else {
			$data = User::model()->findByPk( $status->iduser );
			\Registry::setCurrentUser($data);
			return false;
		}

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
