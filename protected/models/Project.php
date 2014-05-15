<?php
define('OFFERS_ON_PAGE', 10);
define('OFFERS_ON_PAGE_FEW', 2);
/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $title
 * @property string $describe
 * @property integer $user_id
 * @property string $date
 * @property integer $response_count
 * @property integer $active
 * @property string $deleted
 */
class Project extends BaseModel
{
    
    static public function getActiveRecords($page=0) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('active'=>1));
        $criteria->order = 'id desc';
        
        return self::findWithPagination($criteria, $page, OFFERS_ON_PAGE);
    }
    
    static public function getActiveRecordsByIds($ids, $page) {
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $ids);
        $criteria->order = 'id desc';
        
        return self::findWithPagination($criteria, $page, OFFERS_ON_PAGE);
    }
    
    static public function getActiveRecordsSmallPortion($page) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('active'=>1));
        $criteria->order = 'id desc';
        
        return self::findWithPagination($criteria, $page, OFFERS_ON_PAGE_FEW);
    }
    
    static public function getActiveRecordsCount() {
        return self::model()->count(array('condition'=>'active=1'));
    }
    
    static public function getActiveRecordsForUserId($userId) {
        return self::model()->findAll(array('condition'=>'active=1 and user_id=:uid', 'params'=>array('uid'=>$userId), 
                                            'order'=>'id desc', 'limit'=>OFFERS_ON_PAGE));
    }
    
    static public function getActiveRecordsForUserIdSmallPortion($userId, $page=0) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('active'=>1, 'user_id'=>$userId));
        $criteria->order = 'id desc';
        
        return self::findWithPagination($criteria, $page, OFFERS_ON_PAGE_FEW);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'project';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, describe, user_id, date', 'required'),
            array('user_id, response_count, active', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>255),
            array('deleted', 'length', 'max'=>3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, describe, user_id, date, response_count, active, deleted', 'safe', 'on'=>'search'),
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
            'title' => 'Title',
            'describe' => 'Describe',
            'user_id' => 'User',
            'date' => 'Date',
            'response_count' => 'Response Count',
            'active' => 'Active',
            'deleted' => 'Deleted',
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
        $criteria->compare('title',$this->title,true);
        $criteria->compare('describe',$this->describe,true);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('response_count',$this->response_count);
        $criteria->compare('active',$this->active);
        $criteria->compare('deleted',$this->deleted,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public static function getRandom() {
        $rows = self::model()->findAll(array('condition'=>'active=1', 'limit'=>'3', 'order'=>'id DESC'));
        
        return $rows[array_rand($rows)];
    }
    
    /**
     * @return Project 
     */
    public static function getActiveById($id) {
        $row = self::model()->find(array('condition'=>'active=1 and id=:id', 'params'=>array('id'=>$id)));
        
        return $row;
    }
}
