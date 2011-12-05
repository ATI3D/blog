<?php
$this->breadcrumbs=array(
	'Core Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Создание настройки</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>