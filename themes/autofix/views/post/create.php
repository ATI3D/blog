<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Создание',
);

$this->menu=array(
	//array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Создание записи</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>