<?php

/**
 * This is the model class for table "{{Page}}".
 *
 * The followings are the available columns in table '{{Page}}':
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property integer $update_time
 */
class Page extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Page the static model class
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
		return '{{page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slug, name, title, description, keywords, text', 'required'),
			array('slug','ext.ETranslitFilter','translitAttribute'=>'slug', 'on'=>'insert, update'),
			array('update_time', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('description, keywords', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, slug, title, description, keywords, text, update_time', 'safe', 'on'=>'search'),
		);
	}

	protected function beforeSave()
	{
		$this->update_time = time();
		return true;
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
			'id' => '#id',
			'slug' => 'Алиас',
			'name' => 'Название',
			'title' => 'Заголовок',
			'description' => 'Описание',
			'keywords' => 'Ключевые слова',
			'text' => 'Текст',
			'update_time' => 'Изменен',
		);
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
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('update_time',$this->update_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}