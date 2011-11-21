<?php

class DefaultController extends Controller
{
    public function actionConnector()
	{
        $this->layout=false;
        
        Yii::import('elfinder.vendors.*');
        require_once('elFinder.class.php');

        $opts=array(
            'root'=>Yii::getPathOfAlias('webroot.upload'),
            'URL'=>Yii::app()->baseUrl . '/upload/',
            'rootAlias'=>'Корень',
        );

        $fm=new elFinder($opts);
        $fm->run();
	}
}