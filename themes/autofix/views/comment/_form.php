<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>array(
        'class'=>'comment-form',
    ),
    'action'=>CHtml::normalizeUrl(array('comment/create','id'=>Yii::app()->getRequest()->getQuery('id'),'pid'=>Yii::app()->getRequest()->getQuery('pid'))),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
            <?php if(Yii::app()->getRequest()->getQuery('pid') > 0): ?>
                <p class="hint">
                    Вы пишите ответ на комментарий <?php echo CHtml::link('#'.Yii::app()->getRequest()->getQuery('pid'), '#c'.Yii::app()->getRequest()->getQuery('pid')); ?>
                    <?php echo CHtml::link('Отмена', array('post/view', 'id'=>Yii::app()->getRequest()->getQuery('id'), '#'=>'comment-form')); ?>
                </p>
            <?php endif; ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->