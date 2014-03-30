<?php

/**
 * This is the model class for table "showed_contacts".
 *
 * The followings are the available columns in table 'showed_contacts':
 * @property integer $id
 * @property integer $user_id
 * @property integer $manager_id
 * @property string $phone
 * @property string $mail
 * @property string $comment
 * @property integer $project_id
 */
class ShowedContacts extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'showed_contacts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, manager_id, phone, mail, comment, project_id', 'required'),
            array('user_id, manager_id, project_id', 'numerical', 'integerOnly'=>true),
            array('phone, mail', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, manager_id, phone, mail, comment, project_id', 'safe', 'on'=>'search'),
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
            'manager_id' => 'Manager',
            'phone' => 'Phone',
            'mail' => 'Mail',
            'comment' => 'Comment',
            'project_id' => 'Project',
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
        $criteria->compare('manager_id',$this->manager_id);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('mail',$this->mail,true);
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('project_id',$this->project_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ShowedContacts the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public static function getAllContactsByProjectId($project_id) {
        $criteria = new CDbCriteria();
        $criteria->compare("project_id", $project_id);
        $criteria->compare("manager_id", Yii::app()->user->getId());
        $contacts = self::model()->findAll($criteria);
        return $contacts;
    }
    
    public static function getContactsByProjectId($project_id) {
        $criteria = new CDbCriteria();
        $criteria->compare("project_id",$project_id);
        $criteria->compare("user_id",yii::app()->user->getId());
        
        return self::model()->findAll($criteria);
    }
}
