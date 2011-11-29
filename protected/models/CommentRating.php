<?php

/**
 * This is the model class for table "{{comment_rating}}".
 *
 * The followings are the available columns in table '{{comment_rating}}':
 * @property integer $id
 * @property integer $rating
 * @property integer $comment_id
 * @property integer $user_id
 */
class CommentRating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CommentRating the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comment_rating}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rating, comment_id, user_id', 'required'),
			array('rating, comment_id, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, rating, comment_id, user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'rating' => 'Rating',
			'comment_id' => 'Comment',
			'user_id' => 'User',
		);
	}

	/**
	 * @return rating post or false.
	 */
    public function getRating($comment_id)
    {
        $criteria=new CDbCriteria;
        $criteria->select='SUM(rating) as rating';  // подходит только то имя поля, которое уже есть в модели
        $criteria->condition='comment_id=:comment_id';
        $criteria->params=array(':comment_id'=>$comment_id);
        // Получаем общий рейтинг
        $rating = self::model()->find($criteria)->getAttribute('rating');

        if($rating)
            return CHtml::tag('span', array('style'=>$rating > 0 ? 'color: green;' : 'color: red'), $rating > 0 ? '+'.$rating : ''.$rating);
        else
            return 0;
    }

	/**
	 * @return boolean.
	 */
    public function getWhoVoted($comment_id, $user_id)
    {
        $count = self::model()->exists(
            'comment_id=:comment_id AND user_id=:user_id',
            array(
                 ':comment_id'=>(int)$comment_id,
                 ':user_id'=>$user_id
            )
        );

        if($count)
            return true;
        else
            return false;
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}