<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $viewer_id
 * @property string $name
 * @property string $sname
 * @property string $pname
 * @property string $last_visit
 * @property string $create_date
 * @property string $extra_data
 */
class User extends CActiveRecord
{
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
            array('name, create_date', 'required'),
            array('viewer_id', 'numerical', 'integerOnly'=>true),
            array('name, sname, pname', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, viewer_id, name, sname, pname, last_visit, create_date, extra_data', 'safe', 'on'=>'search'),
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
            'viewer_id' => 'Viewer',
            'name' => 'Name',
            'sname' => 'Sname',
            'pname' => 'Pname',
            'last_visit' => 'Last Visit',
            'create_date' => 'Create Date',
            'extra_data' => 'Extra Data',
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
        $criteria->compare('viewer_id',$this->viewer_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('sname',$this->sname,true);
        $criteria->compare('pname',$this->pname,true);
        $criteria->compare('last_visit',$this->last_visit,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('extra_data',$this->extra_data,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
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
    
    public function updateLastVisit() {
        $this->last_visit = \helpers\Date::getCurrent();
        $this->save();
    }
    
    /**
     * @return User
     */
    public static function getById($id) {
        $row = self::model()->find(array('condition'=>'id=:id', 'params'=>array('id'=>$id)));
        
        return $row;
    }
    
    public static function getInfoByIds($ids) {
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $ids);
        $users = self::model()->findAll($criteria);
        
        return helpers\DataExtractor::transformArrayToColumnIndexedArray($users, 'id');
    }
}