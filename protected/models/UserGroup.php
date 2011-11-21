<?php

/**
 * This is the model class for table "{{user_group}}".
 *
 * The followings are the available columns in table '{{user_group}}':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $level
 */
class UserGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserGroup the static model class
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
		return '{{user_group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, slug', 'required'),
			array('level', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, slug, level', 'safe', 'on'=>'search'),
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
			'users'=>array(self::HAS_MANY, 'User', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#id',
			'name' => 'Группа',
			'slug' => 'Алиас',
			'level' => 'Уровень',
		);
	}
	
	public function getUsers()
	{
		$output = '';
		
		foreach($this->users as $model)
		{
			$output .= CHtml::link($model->username, array('/user/view', 'id'=>$model->id)) . ' ';
		}
		return $output;
	}
	
	/*
	public function getAllPortfolio()
	{
		$output = '';
		foreach($this->portfolio as $model)
		{
			//$url = parse_url(CHtml::link($model->url, $model->url, array('target'=>'_blank')));
			//$output .= $url['path'] . '<br />';
			$output .= CHtml::link($model->url, $model->url, array('target'=>'_blank')) . '<br />';
		}
		return $output;
	}
	*/

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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}