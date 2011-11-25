<?php

/**
 * This is the model class for table "{{post_rating}}".
 *
 * The followings are the available columns in table '{{post_rating}}':
 * @property integer $id
 * @property integer $rating
 * @property integer $post_id
 * @property integer $user_id
 */
class PostRating extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return PostRating the static model class
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
		return '{{post_rating}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rating, post_id, user_id', 'required'),
			array('post_id, user_id', 'numerical', 'integerOnly'=>true),
            array('rating', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, rating, post_id, user_id', 'safe', 'on'=>'search'),
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
			'post_id' => 'Post',
			'user_id' => 'User',
		);
	}

	/**
	 * @return rating post or false.
	 */
    public function getRating($post_id)
    {
        $criteria=new CDbCriteria;
        $criteria->select='SUM(rating) as rating';  // подходит только то имя поля, которое уже есть в модели
        $criteria->condition='post_id=:post_id';
        $criteria->params=array(':post_id'=>$post_id);
        // Получаем общий рейтинг
        $rating = self::model()->find($criteria)->getAttribute('rating');
        // Получаем кол-во записей
        $count = self::model()->count('post_id=:post_id',array(':post_id'=>$post_id));

        if($rating > 0 && $count > 0)
            return $rating / $count; // round($rating / $count)
        else
            return false;
    }

	/**
	 * @return boolean.
	 */
    public function getWhoVoted($post_id, $user_id)
    {
        $count = self::model()->exists(
            'post_id=:post_id AND user_id=:user_id',
            array(
                 ':post_id'=>(int)$post_id,
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
		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}