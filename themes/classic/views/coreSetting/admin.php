<?php
$this->breadcrumbs=array(
	'Core Settings'=>array('index'),
	'Manage',
);
$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Настройки сайта</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'core-setting-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'group',
		'key',
		'value',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
		),
	),
)); ?>
