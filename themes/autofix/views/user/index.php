<?php
$this->breadcrumbs=array(
	'Участники',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Участники</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
