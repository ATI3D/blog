<?php $this->beginContent('//layouts/main'); ?>
<div class="container">

	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	
	<?php if(Yii::app()->user->checkAccess(User::ROLE_MODER)): ?>
		<div class="span-5 last">
			<div id="sidebar">
			<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'Главное меню',
				));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>array(
						array('label'=>'Пользователи', 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
						array('label'=>'Группы', 'url'=>array('/userGroup/admin'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
						array('label'=>'Страницы', 'url'=>array('/pages/admin'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
						array('label'=>'Настройки', 'url'=>array('/coreSetting/admin'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
					),
					'htmlOptions'=>array('class'=>'operations'),
				));
				$this->endWidget();
			?>
			</div><!-- sidebar -->
		</div>
	<?php endif; ?>
	
	<div class="span-5 last">
		<div id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Операции',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
		</div><!-- sidebar -->
	</div>
	
</div>
<?php $this->endContent(); ?>