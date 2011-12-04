<?php

class CommentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','rating'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'roles'=>array(User::ROLE_USER),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
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
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Comment;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

        //print_r($_POST['Comment']); print_r($_GET); exit();
        
		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];

            $model->post_id = (int)$_GET['id'];

            if(!empty($_GET['pid']) && $_GET['pid'] != 0)
                $root = Comment::model()->findByPk((int)$_GET['pid']);
            elseif(!empty($_GET['id']))
            {
                $root = Comment::model()->find(
                    'post_id = :post_id AND level = 1',
                    array(
                         ':post_id'=>(int)$_GET['id']
                    )
                );
            }
            else
                throw new CHttpException(404,'The requested page does not exist.');

            if($model->appendTo($root))
            {
                Yii::app()->user->setFlash('success','Комментарий успешно добавлен');
                $this->redirect(array('post/view','id'=>$_GET['id']));
            }
           // else
               // throw new CHttpException(404,'The requested page does not exist.');
		}

		$this->render('create',array(
			'model'=>$model,
		));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        /*
        $root = Comment::model()->findByPk(8);
        $model->appendTo($root);
        */

        /*
        $model->post_id = 1;
        $model->user_id = 1;
        $model->content = 'Hello World!';
        $model->saveNode();
        */
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
			$this->loadModel($id)->delete();

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
        /*
		$dataProvider=new CActiveDataProvider('Comment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
        */

        $categories = Comment::model()->findAll(array(
			'condition'=>'post_id = 1',
            'order'=>'lft',
		));

        foreach($categories as $n=>$category)
        {
            echo '<span style="padding-left: 1'.$category->level.' ">' . $category->content . '</span><br />';
        }

        /*
        $level=0;
        foreach($categories as $n=>$category)
        {
            if($category->level==$level)
                echo CHtml::closeTag('li')."\n";
            else if($category->level>$level)
                echo CHtml::openTag('ul')."\n";
            else
            {
                echo CHtml::closeTag('li')."\n";

                for($i=$level-$model->level;$i;$i--)
                {
                    echo CHtml::closeTag('ul')."\n";
                    echo CHtml::closeTag('li')."\n";
                }
            }

            echo CHtml::openTag('li');
            echo CHtml::encode($category->content);
            $level=$category->level;
        }

        for($i=$level;$i;$i--)
        {
            echo CHtml::closeTag('li')."\n";
            echo CHtml::closeTag('ul')."\n";
        }
        */

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function actionRating()
    {
        // наращиваем количество просмотров поста
        // $post->saveCounters(array('rating'=>(int)$_POST['rate']));

        //print_r($_POST); exit();

		if(Yii::app()->request->isPostRequest)
		{
            $model = new CommentRating;
            $model->rating = $_POST['rating'];
            $model->comment_id = $_POST['id'];
            $model->user_id = Yii::app()->user->id;

            $count = CommentRating::model()->exists(
                'comment_id=:comment_id AND user_id=:user_id',
                array(
                     ':comment_id'=>$_POST['id'],
                     ':user_id'=>Yii::app()->user->id
                )
            );

            if($count)
            {
                echo CJSON::encode(array(
                    'status' => 'error',
                    'message' => 'Вы уже голосовали'
                ));
                // exit;
                Yii::app()->end();
            }

            elseif($model->save())
            {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'message' => 'Спасибо, ваш голос учтен'
                ));
                // exit;
                Yii::app()->end();
            }

            else
            {
                echo CJSON::encode(array(
                    'status' => 'error',
                    'message' => 'Только авторизованные пользователи могут голосовать'
                ));
                // exit;
                Yii::app()->end();
            }
        }
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

    }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
