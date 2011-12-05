<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Создание',
);

$this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Создание пользователя</h1>

<?php echo $this->renderPartial('_form', array('user'=>$user,'profile'=>$profile)); ?>