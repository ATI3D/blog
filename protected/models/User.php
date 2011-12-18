<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $role
 */
class User extends CActiveRecord
{

	const ROLE_ADMIN = 'administrator';
	const ROLE_USER = 'user';
	const ROLE_MODER = 'moderator';
	const ROLE_BANNED = 'banned';
	
	public $rememberMe;
	public $password_repeat;
	public $verifyCode;
	public $members;

	private $_identity;

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// username and password are required
			array('group_id, create_time', 'numerical', 'integerOnly'=>true),
			
			array('username, password', 'required', 'on'=>'login, registration'),
			array('username, password, password_repeat', 'length', 'max'=>128, 'on'=>'insert, update, login, registration'),
			array('username','unique','on'=>'insert, update, registration'),
            // /^[A-Za-zА-Яа-яs,]+$/u
            array('username', 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/u', 'message'=>'Можно использовать только латинские буквы и цифры', 'on'=>'insert, registration'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean', 'on'=>'login'),
			// password needs to be authenticated
			array('password', 'authenticate', 'on'=>'login'),
			
			array('username, password, password_repeat', 'required', 'on'=>'insert, registration'),
			array('password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>'insert, update, registration'),
			
			array('username, role', 'required', 'on'=>'update'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'registration'),
            array('verifyCode', 'required', 'on'=>'registration'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, role, create_time', 'safe', 'on'=>'search'),
		);
	}
	
    /**
     * @return array user status names indexed by status IDs
     */
    public function getRoleOptions()
    {
        return array(
			self::ROLE_USER=>'Пользователь',
			self::ROLE_MODER=>'Модератор',
            self::ROLE_ADMIN=>'Администратор',
			self::ROLE_BANNED=>'Заблокирован',
        );
    }
	
    /**
     * @return string the status display for the current user
     */
    public function getRoleText()
    {
        $options=$this->getRoleOptions();  //$options=$this->roleOptions;
        return $options[$this->role];
    }
	
	protected function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->password = md5($this->password);
			$this->create_time = time();
			// для некоторых хостингов $_SERVER['HTTP_X_FORWARDED_FOR']
			//$this->ip = ip2long($_SERVER['REMOTE_ADDR']);
			if(!$this->role)
				$this->role = self::ROLE_USER;
		}
		return parent::beforeSave();
	}

    /*
	protected function afterSave()
	{
		if($this->isNewRecord)
		{
			$model = new UserProfile;
			$model->user_id = $this->id;
			$model->save(false);
		}
		return parent::afterSave();
	}
    */
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'profile'=>array(self::HAS_ONE, 'UserProfile', 'user_id'),
			'group'=>array(self::BELONGS_TO, 'UserGroup', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#id',
			'group_id' => 'Группа',
			'username' => 'Логин',
			'password' => 'Пароль',
			'password_repeat'=>'Повторите пароль',
			'role' => 'Права',
			'rememberMe'=>'Запомнить меня?',
			'create_time'=>'Создан',
			'members'=>'Участники',
            'verifyCode'=>'Капча',
		);
	}
	
	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
			{
				switch($this->_identity->errorCode)
				{
					case UserIdentity::ERROR_USER_BANNED:
						$this->addError('username','Учетная запись заблокирована.');
						break;
					default:
						$this->addError('username','Неправильный логин или пароль.');
						break;
				}
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}