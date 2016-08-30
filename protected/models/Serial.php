<?php

/**
 * This is the model class for table "serial".
 *
 * The followings are the available columns in table 'serial':
 * @property integer $id
 * @property string $name
 * @property string $datestart
 * @property string $country
 * @property string $genre
 * @property string $description
 * @property string $img
 */
class Serial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'serial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, datestart, country, genre, description', 'required'),
            array('img', 'file', 'types'=>'jpg, gif, png'),
			array('name, country, genre', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, datestart, country, genre, description', 'safe', 'on'=>'search'),
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
     * @return array
     */
    public static function all(){

        return CHtml::listData(self::model()->findAll(),'id','name'); //Специальный хелпер для создание массива, идентично записи снизу
        /*
        $models = self::model()->findAll();
        $array = [];

        foreach($models as $model){
            $array[$model->id] = $model->title;
        }
        return $array;
        */
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название Сериала',
			'datestart' => 'Дата начала',
			'country' => 'Страна',
			'genre' => 'Жанр',
			'description' => 'Описание',
			'img' => 'Картинка на главную',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('datestart',$this->datestart,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('genre',$this->genre,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function beforeSave()
    {
        if (parent::beforeSave()) {
            $this->img = CUploadedFile::getInstance($this, 'img');
            if ($this->img) {
                $tempName = uniqid().'.'.$this->img->getExtensionName();
                $dir = Yii::getPathOfAlias('webroot.img').DIRECTORY_SEPARATOR;
                $this->img->saveAs($dir.$tempName);
                $this->img = '/img/'.$tempName;
            }
            return true;
        } else
            return false;
    }


    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Serial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
