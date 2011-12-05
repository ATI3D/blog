<?php
$this->breadcrumbs=array(
	'Записи'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Изменение',
);

$this->menu=array(
	//array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
	//array('label'=>'View Post', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Изменение записи &rarr; "<?php echo $model->title; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>