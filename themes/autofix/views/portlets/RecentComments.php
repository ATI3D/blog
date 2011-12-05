<div id="comments">
    <div class="s1">
        <div class="s2">
            <span class="s_title">Последние комментарии</span>
        </div>
    </div>
    <div class="s">
        <div class="s2b">
        <?php foreach($comments as $comment): ?>
            <dl class="comment">
            <dt class="kto"><?php echo CHtml::link($comment->user->username, array('user/view','id'=>$comment->user->id)); ?>&nbsp;&rarr;</dt>
                <dd>
                    <dl>
                        <!--<dt><a class="gde" href="">Toyota</a>&nbsp;&rarr;</dt>-->
                        <dd>
                            <?php echo CHtml::link($comment->post->title, array('post/view', 'id'=>$comment->post->id, 'title'=>urldecode($comment->post->title)), array('class'=>'topic')); ?>
                            <!--&nbsp;<span class="total">39</span>-->
                        </dd>
                    </dl>
                </dd>
            </dl>
        <?php endforeach; ?>
        </div>
    </div><!-- s s2b -->
    <div class="s3">
        <div class="s4">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spacer.gif" height="7" />
        </div>
    </div>
</div>