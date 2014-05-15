<?php
define('CONVERSATIONS_ON_PAGE', 30);

/**
 * This is the model class for table "conversation".
 *
 * The followings are the available columns in table 'conversation':
 * @property integer $id
 * @property integer $user_id
 * @property integer $shop_user_id
 * @property string $title
 * @property string $create_date
 * @property string $user_unread
 * @property string $shop_user_unread
 */
class Conversation extends BaseModel
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'conversation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_unread, shop_user_unread', 'required'),
            array('user_id, shop_user_id', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>255),
            array('user_unread, shop_user_unread', 'length', 'max'=>3),
            array('create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, shop_user_id, title, create_date, user_unread, shop_user_unread', 'safe', 'on'=>'search'),
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
            'user_id' => 'User',
            'shop_user_id' => 'Shop User',
            'title' => 'Title',
            'create_date' => 'Create Date',
            'user_unread' => 'User Unread',
            'shop_user_unread' => 'Shop User Unread',
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
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('shop_user_id',$this->shop_user_id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('user_unread',$this->user_unread,true);
        $criteria->compare('shop_user_unread',$this->shop_user_unread,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Conversation the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * @return Conversation 
     */
    public static function getById($id) {
        return static::model()->findByPk($id);
    }
    
    /**
     * @return Conversation 
     */
    public static function getByIdForUserId($id, $userId) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('id'=>$id, 'user_id'=>$userId));
        return static::model()->find($criteria);
    }
    
    /**
     * @return Conversation 
     */
    public static function getByIdForShopUserId($id, $userId) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('id'=>$id, 'shop_user_id'=>$userId));
        return static::model()->find($criteria);
    }
    
    /**
     * @return boolean 
     */
    public static function isUnreadConversationForUserId($userId) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_unread'=>'yes', 'user_id'=>$userId));
        $model = static::model()->find($criteria);
        
        if ($model)
            return true;
        
        return false;
    }
    
    /**
     * @return boolean 
     */
    public static function isUnreadConversationForShopUserId($userId) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('shop_user_unread'=>'yes', 'shop_user_id'=>$userId));
        $model = static::model()->find($criteria);
        if ($model)
            return true;
        
        return false;
    }
    
    static public function getConversationsForUserId($userId, $page=0) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id'=>$userId));
        $criteria->order = 'id desc';
        
        return self::findWithPagination($criteria, $page, CONVERSATIONS_ON_PAGE);
    }
    
    static public function getConversationsForShopUserId($shopUserId, $page=0) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('shop_user_id'=>$shopUserId));
        $criteria->order = 'id desc';
        
        return self::findWithPagination($criteria, $page, CONVERSATIONS_ON_PAGE);
    }
    
    public function setUserUnread() {
        $this->user_unread = 'yes';
    }
    
    public function setUserRead() {
        $this->user_unread = 'no';
    }
    
    public function setShopUserUnread() {
        $this->shop_user_unread = 'yes';
    }
    
    public function setShopUserRead() {
        $this->shop_user_unread = 'no';
    }
    
}