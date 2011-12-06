<?php
/*
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);
*/

$this->pageTitle=$model->title;

$this->menu=array(
	//array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Создать', 'url'=>array('create')),
    array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<div class="post">
    <?php $this->renderPartial('_view', array(
        'data'=>$model,
    )); ?>
</div>

<div id="comments">
    <?php $this->renderPartial('/comment/_view',array(
        'data'=>$comments,
        //'model'=>$comment,
    )); ?>
</div>

<?php if(Yii::app()->user->checkAccess(User::ROLE_USER)): ?>
    <div>
        <?php $this->renderPartial('/comment/_form',array(
            'model'=>$comment,
        )); ?>
    </div>
<?php endif; ?>

