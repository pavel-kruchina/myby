<?php

/**
 * This is the model class for table "quick_links".
 *
 * The followings are the available columns in table 'quick_links':
 * @property integer $id
 * @property string $link
 * @property string $code
 * @property string $create_date
 * @property integer $user_id
 */
class QuickLink extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'quick_link';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'numerical', 'integerOnly'=>true),
            array('link, code', 'length', 'max'=>255),
            array('create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, link, code, create_date, user_id', 'safe', 'on'=>'search'),
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
            'link' => 'Link',
            'code' => 'Code',
            'create_date' => 'Create Date',
            'user_id' => 'User',
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
        $criteria->compare('link',$this->link,true);
        $criteria->compare('code',$this->code,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('user_id',$this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return QuickLinks the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public static function createLink($link, $userId) {
        $ql = new QuickLink();
        $ql->create_date = helpers\Date::getCurrent();
        $ql->link = $link;
        $ql->user_id = $userId;
        $ql->code = $userId.static::createCode();
        
        $ql->save();
        
        return 'ql/'.$ql->code;
    }
    
    public static function CreateCode() {
        return sha1(microtime.uniqid());
    }
    
    /**
     * @return QuickLink 
     */
    public static function getByCode($code) {
        $criteria = new CDbCriteria();
        $criteria->compare("code", $code);
        
        return self::model()->find($criteria);
    }
}