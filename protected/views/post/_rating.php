<?php
$this->widget('CStarRating',array(
        'name'=>'rating',
        'cssFile'=>Yii::app()->baseUrl . '/css/jquery.rating.css',
        'callback'=>'
            function(){
                $.ajax({
                    type: "POST",
                    url: "' . Yii::app()->createUrl('post/rating') . '",
                    data: "id=' . $data->id . '&rate=" + $(this).val(),
                    success: function(msg){
                        $("#rating").html(msg);  // alert( "Data Saved: " + msg );
                    }
                })
            }',
        'value'=>PostRating::getRating($data->id),
        //'ratingStepSize'=>0.5,
        //'starCount'=>5,
        //'starWidth'=>10,
        //'maxRating'=>5,
        //'minRating'=>0.5,
        'minRating' => '1',
        'maxRating' => '5',
        'starWidth'=>'15',
        'ratingStepSize' => '1',
        'allowEmpty' => false,
        //'titles'=>RatingDesc::GetArray(),
        //'resetText'=>'Отмена',
        //'resetValue'=>'Отмена',
        'readOnly'=>PostRating::getWhoVoted($data->id, Yii::app()->user->id),
    ));
?>
<?php // echo PostRating::getRating($data->id); ?>