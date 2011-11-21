<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    // Будем хранить id.
    protected $_id;
	
	// Учетная запись заблокирована
	const ERROR_USER_BANNED = 'banned';
 
    // Данный метод вызывается один раз при аутентификации пользователя.
    public function authenticate()
	{
        // Производим стандартную аутентификацию, описанную в руководстве.
        $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if(($user===null) or (md5($this->password)!==$user->password)) 
            $this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($user->role == User::ROLE_BANNED)
			$this->errorCode = self::ERROR_USER_BANNED;
        else 
		{
            // В качестве идентификатора будем использовать id, а не username,
            // как это определено по умолчанию. Обязательно нужно переопределить
            // метод getId(см. ниже).
            $this->_id = $user->id;
 
            // Далее логин нам не понадобится, зато имя может пригодится
            // в самом приложении. Используется как Yii::app()->user->name.
            // realName есть в нашей модели. У вас это может быть name, firstName
            // или что-либо ещё.
            $this->username = $user->username;
 
            $this->errorCode = self::ERROR_NONE;
        }
		
		return !$this->errorCode;

    }
 
    public function getId(){
        return $this->_id;
    }
	
}