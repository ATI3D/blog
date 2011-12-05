<div id="in">
    <div class="s1">
        <div class="s2">
            <span class="s_title">Личный кабинет</span>
        </div>
    </div>
    <div class="s">
        <div class="s2b">
            <span class="name">
                <?php echo $model->username; ?>
            </span>
            <span class="ava">
                 <?php if($model->profile->avatar): ?>
                        <?php echo CHtml::image(Yii::app()->baseUrl . '/upload/avatars/' . $model->username . '/' . $model->profile->avatar, $model->username, array(
                            'title'=>$model->username,
                            'width'=>35,
                            'height'=>35,
                        ));
                        ?>
                    <?php else: ?>
                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/' . 'default_avatar.gif', $model->username, array(
                            'title'=>$model->username,
                            'width'=>35,
                            'height'=>35,
                        ));
                        ?>
                    <?php endif; ?>
            </span>
            <ul>
                <li><?php echo CHtml::link('Профиль', array('/user/update', 'id'=>$model->id)); ?></li>
                <li><?php echo CHtml::link('Выход', array('/user/logout')); ?></li>
            </ul>
        </div>
    </div><!-- s s2b -->
    <div class="s3">
        <div class="s4">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spacer.gif" height="7" />
        </div>
    </div>
</div>