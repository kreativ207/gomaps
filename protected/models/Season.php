<?php

/**
 * This is the model class for table "season".
 *
 * The followings are the available columns in table 'season':
 * @property integer $id
 * @property integer $serial_id
 * @property string $datestart
 * @property string $dateend
 * @property string $season
 */
class Season extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serial_id, datestart, dateend, season', 'required'),
			array('serial_id', 'numerical', 'integerOnly'=>true),
			array('datestart, dateend', 'length', 'max'=>4),
			array('season', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, serial_id, datestart, dateend, season', 'safe', 'on'=>'search'),
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
            'serial' => [self::BELONGS_TO,'Serial','serial_id']
        );
    }

    public static function all(){

        return CHtml::listData(self::model()->findAll(),'id','season'); //Специальный хелпер для создание массива, идентично записи снизу
        /*
        $models = self::model()->findAll();
        $array = [];

        foreach($models as $model){
            $array[$model->id] = $model->title;
        }
        return $array;
        */
    }

    public static function season_name($id){

        return Season::model()->findByPk($id); //Специальный хелпер для создание массива, идентично записи снизу
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
			'serial_id' => 'Сериал',
			'datestart' => 'Дата начала сезона',
			'dateend' => 'Дата окончания сезона',
			'season' => 'Какой Сезон',
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
		$criteria->compare('serial_id',$this->serial_id);
		$criteria->compare('datestart',$this->datestart,true);
		$criteria->compare('dateend',$this->dateend,true);
		$criteria->compare('season',$this->season,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Season the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
