<?php

/**
 * This is the model class for table "conversation_message".
 *
 * The followings are the available columns in table 'conversation_message':
 * @property integer $id
 * @property string $message
 * @property string $author_type
 * @property integer $conversation_id
 * @property string $create_date
 */
class ConversationMessage extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'conversation_message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('conversation_id', 'numerical', 'integerOnly'=>true),
            array('author_type', 'length', 'max'=>9),
            array('message, create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, message, author_type, conversation_id, create_date', 'safe', 'on'=>'search'),
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
            'message' => 'Message',
            'author_type' => 'Author Type',
            'conversation_id' => 'Conversation',
            'create_date' => 'Create Date',
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
        $criteria->compare('message',$this->message,true);
        $criteria->compare('author_type',$this->author_type,true);
        $criteria->compare('conversation_id',$this->conversation_id);
        $criteria->compare('create_date',$this->create_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ConversationMessage the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * @return ConversationMessage
     */
    public static function getById($id) {
        return static::model()->findByPk($id); 
    }
    
    public static function getMessagesByConversationId($convId) {
        $criteria = new CDbCriteria();
        $criteria->compare('conversation_id', $convId);
        $criteria->order = 'id';
        return static::model()->findAll($criteria);
    }
}