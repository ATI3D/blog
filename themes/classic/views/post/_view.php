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
        -->
        <?php echo CHtml::link("Комментарии ({$data->commentCount})",$data->url.'#comments'); ?> |

        Последнее обновление <?php echo EDate::timeAgo(date('d.m.Y H:i:s',$data->update_time)); ?>

        <?php if((int)$_GET['id'] && !Yii::app()->user->isGuest): ?>
            <span style="float: right;">
                <?php echo $this->renderPartial('_rating', array('data'=>$data)); ?>
            </span>
        <?php endif; ?>

    </div>
    
</div>