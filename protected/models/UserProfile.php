<?php

/**
 * This is the model class for table "{{user_profile}}".
 *
 * The followings are the available columns in table '{{user_profile}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $birthday
 * @property string $avatar
 * @property integer $level
 * @property integer $last_login
 */
class UserProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_profile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id, first_name, last_name, email, phone, birthday, avatar, level, last_login', 'required', 'on'=>'update'),
			array('email', 'required'),
			array('email', 'email'),
            array('email', 'unique', 'on'=>'insert'),
			array('avatar', 'file', 'types'=>'jpg, gif, png', 'maxSize' => 1048576, 'allowEmpty'=>true, 'on'=>'update'),
			array('birthday', 'date', 'format'=>'yyyy-MM-dd', 'message'=>'Неправильный формат поля День рождения. (Пример: 1970-12-31)', 'on'=>'update'),
			array('user_id, level, last_login', 'numerical', 'integerOnly'=>true, 'on'=>'update'),
			array('first_name, last_name, email, phone, avatar', 'length', 'max'=>255, 'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, first_name, last_name, email, phone, birthday, avatar, level, last_login', 'safe', 'on'=>'search'),
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
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	protected function beforeSave()
	{
		// Перед сохранением модели, сохраним файл
		if($this->avatar instanceof CUploadedFile)
		{
			$documentRoot = Yii::getPathOfAlias('webroot');
			$imageDirectory = '/upload/avatars/' . Yii::app()->user->name . '/';
			
			if(!is_dir($documentRoot . $imageDirectory))
				@mkdir($documentRoot . $imageDirectory, 0755, true);
				
			$filename = date("d_m_Y_H_i_s_") . Yii::app()->user->name . '.' .$this->avatar->getExtensionName();
			Yii::app()->ih
			->load($this->avatar->tempName)
			->thumb(50, 50)
			->save($documentRoot . $imageDirectory . $filename, false, 100);
			
			$this->avatar = $filename;
		}
		return parent::beforeSave();
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#id',
			'user_id' => 'Пользователь',
			'first_name' => 'Имя',
			'last_name' => 'Фамилия',
			'email' => 'Email',
			'phone' => 'Телефон',
			'birthday' => 'День рождения',
			'avatar' => 'Аватар',
			'level' => 'Уровень',
			'last_login' => 'Последний вход',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('last_login',$this->last_login);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}