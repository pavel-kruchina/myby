<?php

/**
 * This is the model class for table "shop_user".
 *
 * The followings are the available columns in table 'shop_user':
 * @property integer $id
 * @property string $name
 * @property string $mail
 * @property string $password
 * @property integer $active
 * @property string $last_visit
 * @property string $manager_name
 * @property string $showed_mail
 * @property string $phone
 * @property string $describe
 * @property string $site_name
 * @property string $site_url
 */
class ShopUserModel extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'shop_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, mail, password, active, last_visit, manager_name, showed_mail, phone, describe, site_name, site_url', 'required'),
            array('active', 'numerical', 'integerOnly'=>true),
            array('name, mail, password', 'length', 'max'=>255),
            array('manager_name, showed_mail, phone', 'length', 'max'=>50),
            array('site_name', 'length', 'max'=>100),
            array('site_url', 'length', 'max'=>200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, mail, password, active, last_visit, manager_name, showed_mail, phone, describe, site_name, site_url', 'safe', 'on'=>'search'),
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
            'name' => 'Name',
            'mail' => 'Mail',
            'password' => 'Password',
            'active' => 'Active',
            'last_visit' => 'Last Visit',
            'manager_name' => 'Manager Name',
            'showed_mail' => 'Showed Mail',
            'phone' => 'Phone',
            'describe' => 'Describe',
            'site_name' => 'Site Name',
            'site_url' => 'Site Url',
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
        $criteria->compare('mail',$this->mail,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('active',$this->active);
        $criteria->compare('last_visit',$this->last_visit,true);
        $criteria->compare('manager_name',$this->manager_name,true);
        $criteria->compare('showed_mail',$this->showed_mail,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('describe',$this->describe,true);
        $criteria->compare('site_name',$this->site_name,true);
        $criteria->compare('site_url',$this->site_url,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ShopUser the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function updateLastVisit() {
        $this->last_visit = \helpers\Date::getCurrent();
        $this->save();
    }
    
    public static function getPasswordHash($str) {
        return sha1($str);
    }
    
    public static function getUsersByIds($ids) {
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $ids);
        
        return self::model()->findAll($criteria);
    }
    
    public static function getById($id) {
        return self::model()->findByPk($id);
    }
    
    public static function getAllActive() {
        $criteria = new CDbCriteria();
        $criteria->compare("active", 1);
        
        return self::model()->findAll($criteria);
    }
}