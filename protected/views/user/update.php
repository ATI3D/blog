<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$user->username=>array('view','id'=>$user->id),
	'Изменение',
);

$this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
	//array('label'=>'View User', 'url'=>array('view', 'id'=>$user->id)),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Профиль пользователя &rarr; <?php echo $user->username; ?></h1>

<?php echo $this->renderPartial('_form', array('user'=>$user,'profile'=>$profile)); ?>