<?php

/**
 * This is the model class for table "series".
 *
 * The followings are the available columns in table 'series':
 * @property integer $id
 * @property integer $season_id
 * @property string $series
 * @property string $description
 */
class Series extends CActiveRecord
{
    public $name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'series';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('season_id, series, description', 'required'),
			array('season_id', 'numerical', 'integerOnly'=>true),
			array('series', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, season_id, series, description, name', 'safe', 'on'=>'qwerty'),
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
            'season' => [self::BELONGS_TO,'Season','season_id']
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'season_id' => 'Сезон',
			'series' => 'Серия',
			'description' => 'Описание',
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
		$criteria->compare('season_id',$this->season_id);
		$criteria->compare('series',$this->series,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function qwerty(){

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('season_id',$this->season_id);
        $criteria->compare('series',$this->series,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('name',$this->name,true);

        $criteria->select = 't.*,
            season.id season_id,
            season.season season,
            serial.name name,
            serial.id serial_id
        ';
        $criteria->join = '
          LEFT JOIN season
          ON t.season_id=season.id
          LEFT JOIN serial
          ON serial.id=season.serial_id';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Series the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
