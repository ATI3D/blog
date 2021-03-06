<?php if(!$data): ?>
    <h3>Комментариев нет</h3>
<?php else: ?>
    <h3>Комментарии:</h3>

    <?php $level=0; ?>

    <?php foreach($data as $n=>$comment): ?>
        <?php if($comment->level==$level): ?>
            <?php echo CHtml::closeTag('li')."\n"; ?>
        <?php elseif($comment->level>$level): ?>
            <?php echo CHtml::openTag('ul')."\n"; ?>
        <?php else: ?>
            <?php echo CHtml::closeTag('li')."\n"; ?>

            <?php for($i=$level-$comment->level;$i;$i--): ?>
                <?php echo CHtml::closeTag('ul')."\n"; ?>
                <?php echo CHtml::closeTag('li')."\n"; ?>
            <?php endfor; ?>
        <?php endif; ?>

        <?php echo CHtml::openTag('li'); ?>
            <div name="c<?php echo $comment->id; ?>" class="comment" style="background-color: <?php echo $comment->id == Yii::app()->getRequest()->getQuery('pid') ? '#F5F5F5' : ''; ?>">

                <span class="avatar">
                    <?php echo CHtml::image(Yii::app()->baseUrl . '/upload/avatars/' . $comment->user->username . '/' . $comment->user->profile->avatar, $comment->user->username, array(
                        'title'=>$comment->user->username,
                        'width'=>30,
                        'height'=>30,
                        //'align'=>'middle',
                    ));
                    ?>
                </span>

                <span class="author">
                    <?php echo CHtml::link($comment->user->username, array('user/view', 'id'=>$comment->user->id)); ?>
                </span>

                <span class="time">
                    <?php echo Yii::app()->getDateFormatter()->format("d MMMM yyyy, HH:mm", $comment->create_time); ?>
                </span>

                <span class="rating">
                    <?php echo CommentRating::getRating($comment->id); ?>

                    <?php echo CHtml::ajaxLink(CHtml::image(Yii::app()->theme->baseUrl . '/images/plus.png', 'Плюсануть'),
                                               Yii::app()->createUrl('comment/rating'),
                                               array(
                                                   'type' => 'POST',
                                                   'data' => array('id' => $comment->id, 'rating' => 1),
                                                   'dataType'=>'json',
                                                   //'update' => '.rating',
                                                   'success' => 'function(data){
                                                       if(data.status == "success")
                                                       {
                                                            $("#voteplus' . $comment->id . '").parent("span.rating").text(data.message);
                                                       }
                                                       else
                                                       {
                                                            $("#voteplus' . $comment->id . '").parent("span.rating").text(data.message);
                                                       }
                                                   }'
                                               ),
                                               array('id'=>'voteplus'.$comment->id)
                                            );
                    ?>

                    <?php echo CHtml::ajaxLink(CHtml::image(Yii::app()->theme->baseUrl . '/images/minus.png', 'Минусануть'),
                                               Yii::app()->createUrl('comment/rating'),
                                               array(
                                                   'type' => 'POST',
                                                   'data' => array('id' => $comment->id, 'rating' => -1),
                                                   'dataType'=>'json',
                                                   //'update' => '.rating',
                                                   'success' => 'function(data){
                                                       if(data.status == "success")
                                                       {
                                                            $("#voteplus' . $comment->id . '").parent("span.rating").text(data.message);
                                                       }
                                                       else
                                                       {
                                                            $("#voteplus' . $comment->id . '").parent("span.rating").text(data.message);
                                                       }
                                                   }'
                                               ),
                                               array('id'=>'voteminus'.$comment->id)
                                            );
                    ?>
                </span>

                <span class="answer">
                    <?php echo CHtml::link('Ответить', array('post/view','id'=>$_GET['id'], 'pid'=>$comment->id, '#'=>'comment-form')); ?>
                </span>

                <div class="content">
                    <?php echo nl2br(CHtml::encode($comment->content)); ?>
                </div>

            </div>
        <?php $level=$comment->level; ?>
    <?php endforeach; ?>

    <?php for($i=$level;$i;$i--): ?>
        <?php echo CHtml::closeTag('li')."\n"; ?>
        <?php echo CHtml::closeTag('ul')."\n"; ?>
    <?php endfor; ?>

<?php endif; ?>