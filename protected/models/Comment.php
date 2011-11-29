<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property integer $post_id
 * @property integer $user_id
 * @property string $content
 * @property integer $create_time
 */
class Comment extends CActiveRecord
{

    //public $parentId;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
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
		return '{{comment}}';
	}

    public function behaviors()
    {
        return array(
            'NestedSetBehavior'=>array(
                'class'=>'ext.trees.NestedSetBehavior',
                'hasManyRoots'=>true,
                //'rootAttribute'=>'post_id',
                'leftAttribute'=>'lft',
                'rightAttribute'=>'rgt',
                'levelAttribute'=>'level',
            )
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            /*
			array('lft, rgt, level, post_id, user_id, content, create_time', 'required'),
			array('level, post_id, user_id, create_time', 'numerical', 'integerOnly'=>true),
			array('root, lft, rgt', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, root, lft, rgt, level, post_id, user_id, content, create_time', 'safe', 'on'=>'search'),
            */
            array('post_id, user_id, create_time', 'safe'),
            array('content','safe','on'=>'root'),
            array('content','required', 'on'=>'insert'),
            array('content', 'length', 'max'=>1000, 'on'=>'insert'),
		);
	}

    protected function beforeSave()
    {
        parent::beforeSave();

        if($this->isNewRecord)
        {
            $this->user_id = Yii::app()->user->id;
            $this->create_time = time();
        }
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
            'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'post_id' => 'Post',
			'user_id' => 'User',
			'content' => 'Комментарий',
			'create_time' => 'Create Time',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('root',$this->root,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_time',$this->create_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}