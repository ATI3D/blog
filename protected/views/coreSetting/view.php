<?php
$this->breadcrumbs=array(
	'Core Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CoreSetting', 'url'=>array('index')),
	array('label'=>'Create CoreSetting', 'url'=>array('create')),
	array('label'=>'Update CoreSetting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CoreSetting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CoreSetting', 'url'=>array('admin')),
);
?>

<h1>View CoreSetting #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group',
		'key',
		'value',
	),
)); ?>
