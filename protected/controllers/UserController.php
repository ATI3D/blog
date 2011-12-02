<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
                'width'=>90,
                'height'=>40,
                'minLength'=>3,
                'maxLength'=>5,
                'testLimit'=>1,
			),
		);
	}	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login','index','view','registration','captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('logout'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array('@'),
				'expression'=>'$user->id == ' . Yii::app()->getRequest()->getQuery('id'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update'),
				'roles'=>array(User::ROLE_MODER),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array(User::ROLE_ADMIN),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadUserModel($id),
		));
	}

    /**
   	 * Creates a new model.
   	 * If registration is successful, the browser will be redirected to the 'homeUrl' page.
   	 */
   	public function actionRegistration()
   	{
   		$user=new User;
        $profile=new UserProfile;

   		// scenario registration
        $user->scenario = 'registration';

        if(isset($_POST['User'], $_POST['UserProfile']))
        {
            $user->attributes=$_POST['User'];
            $profile->attributes=$_POST['UserProfile'];

             // validate BOTH $user and $profile
             $valid = $user->validate();
             $valid = $profile->validate() && $valid;

            if($valid)
            {
                $profile->user_id = $user->id;

                $user->save(false);
            	$profile->save(false);
                Yii::app()->user->setFlash('success','Спасибо, Вы успешно зарегистрированы в системе, можете войти под своим логином.');
            	$this->redirect(Yii::app()->homeUrl);
            }

        }

   		// display the registration form
   		$this->render('registration',array(
               'user'=>$user,
               'profile'=>$profile,
        ));
   	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$user=new User;
		$profile=new UserProfile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User'], $_POST['UserProfile']))
		{
			$user->attributes=$_POST['User'];
            $profile->attributes=$_POST['UserProfile'];

            // validate BOTH $user and $profile
            $valid = $user->validate();
            $valid = $profile->validate() && $valid;

			if($user->save())
            {
                $user->save(false);
            	$profile->save(false);
                $this->redirect(array('view','id'=>$user->id));
            }
		}

		$this->render('create',array(
			'user'=>$user,
			'profile'=>$profile,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$user = $this->loadUserModel($id);
		$profile = $this->loadUserProfileModel($user->id);
		
		$password = $user->password;
		
		//var_dump($_POST); exit();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['User'], $_POST['UserProfile']))
		{
			$user->attributes = $_POST['User'];
			$profile->attributes = $_POST['UserProfile'];
			
			$profile->avatar = CUploadedFile::getInstance($profile,'avatar');
			
			// validate BOTH $a and $b
			$valid = $user->validate();
			$valid = $profile->validate() && $valid;
			
			// Был ли введен пароль?!
			if($user->password)
				$user->password=md5($user->password);
			elseif(!$user->password)
				$user->password = $password;
			
			if($valid)
			{
				Yii::app()->user->setFlash('success','Изменения успешно внесены!');
				$user->save(false);
				$profile->save(false);
				$this->redirect(array('update','id'=>$user->id));
			}
		}
		//else
			//throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

		$this->render('update',array(
			'user'=>$user,
			'profile'=>$profile,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadUserModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new User;
		$model->scenario = 'login';
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadUserModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadUserProfileModel($user_id)
	{
		$model=UserProfile::model()->find('user_id=:user_id', array(':user_id'=>$user_id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
