<div class="post">

	<div class="title">
		<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
	</div>

	<div class="author">
		добавил <?php echo CHtml::link($data->user->username, array('user/view','id'=>$data->user->id)) . ' ' . Yii::app()->getDateFormatter()->format("d MMMM yyyy в HH:mm", $data->create_time); ?>
        <?php if(Yii::app()->user->checkAccess(User::ROLE_MODER)): ?>
            <span class="status_<?php echo $data->status; ?>" style="float: right;"><?php echo Lookup::item("PostStatus",$data->status); ?></span>
        <?php endif; ?>
    </div>

	<div class="content">
        <?php echo (int)$_GET['id'] ? $data->content : $data->short_content; ?>
	</div>

	<div class="nav">
		<b>Теги:</b>
		<?php echo implode(', ', $data->tagLinks); ?>
		<br/>
        <!--
		<?php // echo CHtml::link('Permalink', $data->url); ?> |
		<?php // echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
		-->
		Последнее обновление <?php echo Yii::app()->getDateFormatter()->format("d MMMM yyyy в HH:mm", $data->update_time); ?>

        <span style="float: right;">
            <?php if((int)$_GET['id']): ?>
                <?php
                $this->widget('CStarRating',array(
                        'name'=>'rating',
                        'callback'=>'
                            function(){
                                $.ajax({
                                    type: "POST",
                                    url: "' . Yii::app()->createUrl('post/rating') . '",
                                    data: "id=' . $data->id . '&rate=" + $(this).val(),
                                    success: function(msg){
                                        alert( "Data Saved: " + msg );
                                    }
                                })
                            }',
                        'value'=>PostRating::getRating($data_id),
                        'ratingStepSize'=>1,
                        'maxRating'=>5,
                        //'resetText'=>'',
                        //'resetValue'=>'',
                        //'readOnly'=>true,
                    ));
                ?>
            <?php endif; ?>
        </span>

	</div>

</div>