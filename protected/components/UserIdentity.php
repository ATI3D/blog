<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    // ����� ������� id.
    protected $_id;
	
	// ������� ������ �������������
	const ERROR_USER_BANNED = 'banned';
 
    // ������ ����� ���������� ���� ��� ��� �������������� ������������.
    public function authenticate()
	{
        // ���������� ����������� ��������������, ��������� � �����������.
        $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if(($user===null) or (md5($this->password)!==$user->password)) 
            $this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($user->role == User::ROLE_BANNED)
			$this->errorCode = self::ERROR_USER_BANNED;
        else 
		{
            // � �������� �������������� ����� ������������ id, � �� username,
            // ��� ��� ���������� �� ���������. ����������� ����� ��������������
            // ����� getId(��. ����).
            $this->_id = $user->id;
 
            // ����� ����� ��� �� �����������, ���� ��� ����� ����������
            // � ����� ����������. ������������ ��� Yii::app()->user->name.
            // realName ���� � ����� ������. � ��� ��� ����� ���� name, firstName
            // ��� ���-���� ���.
            $this->username = $user->username;
 
            $this->errorCode = self::ERROR_NONE;
        }
		
		return !$this->errorCode;

    }
 
    public function getId(){
        return $this->_id;
    }
	
}