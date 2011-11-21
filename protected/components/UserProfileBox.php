<?php

class UserProfileBox extends Portlet
{
	
	public $title = '';
	public $visible = true; // виден ли портлет
	
	public function getProfile()
	{
		return User::model()->findByPk(Yii::app()->user->id);
	}
	
	protected function renderContent()
	{
		$this->render('UserProfileBox',
			array('model'=>$this->getProfile())
		);
	}
	
}