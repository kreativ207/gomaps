<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $created
 * @property integer $ban
 * @property integer $role
 * @property string $email
 */
class User extends CActiveRecord
{

    const ROLE_ADMIN = 'admin';
    const ROLE_MODER = 'user';
    const ROLE_BANNED = 'banned';

    public $verifyCode;
    public $compare_password;
    public $password;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, ban, role, email','required','on' => 'update'),
            array('username, password, email, compare_password', 'required', 'on' => 'registration'),
            array('email','email'),
            array('username', 'unique'),
            array('username','match','pattern' => '/^([A-Za-z0-9 ]+)$/u','message' => 'Допустимые символы A-Za-z0-9 '),
            array('password','compare','compareAttribute' => 'compare_password', 'on' => 'registration'),
            array('created, ban, role', 'numerical', 'integerOnly'=>true),
            array('username, password, email', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on' => 'registration'),
            array('id, username, password, created, ban, role, email', 'safe', 'on'=>'search'),
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
            'username' => 'Имя',
            'password' => 'Пароль',
            'compare_password' => 'Подтвердите пароль',
            'created' => 'Зарегистрирован',
            'ban' => 'Бан',
            'role' => 'Роль',
            'email' => 'Email',
            'verifyCode' => 'Код с картинки'
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
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('created',$this->created);
        $criteria->compare('ban',$this->ban);
        $criteria->compare('role',$this->role);
        $criteria->compare('email',$this->email,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * @return bool|void
     */
    public function beforeSave(){

        if($this->isNewRecord){
            $this->role = 1;
            $this->created = time();
        }

        $this->password = $this->hashPassword($this->password);
        return parent::beforeSave();
    }

    /**
     * @return array
     */
    public static function all(){

        return CHtml::listData(self::model()->findAll(),'id','username'); //Специальный хелпер для создание массива, идентично записи снизу
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
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }

    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
