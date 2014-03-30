<?php

/**
 * This is the model class for table "offer".
 *
 * The followings are the available columns in table 'offer':
 * @property integer $id
 * @property integer $shop_user_id
 * @property integer $project_id
 * @property string $date
 * @property string $text
 */
class Offer extends CActiveRecord
{
    public $offersCount;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'offer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('shop_user_id, project_id, date, text', 'required'),
            array('shop_user_id, project_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, shop_user_id, project_id, date, text, offersCount', 'safe', 'on'=>'search'),
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
            'shop_user_id' => 'Shop User',
            'project_id' => 'Project',
            'date' => 'Date',
            'text' => 'Text',
            'offersCount' => 'offersCount',
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
        $criteria->compare('shop_user_id',$this->shop_user_id);
        $criteria->compare('project_id',$this->project_id);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('text',$this->text,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Offer the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public static function getOffersForProject($project_id) {
        $offers = self::model()->findAll(array('condition'=>'project_id=:project_id', 'order'=>'date DESC', 'params'=>array('project_id'=>$project_id)));
        
        return $offers;
    }
    
    public static function getOffersCountByProjectIds($projectIds) {
        $criteria = new CDbCriteria();
        $criteria->select = 'count(*) as offersCount, project_id';
        $criteria->group='project_id';
        $criteria->addInCondition("project_id", $projectIds);
        
        return self::model()->findAll($criteria);
    }
    
    public static function getOffersByManager($manager_id) {
        $criteria = new CDbCriteria();
        $criteria->compare("shop_user_id", $manager_id);
        
        return self::model()->findAll($criteria);
    }
    
    public static function getById($id) {
        return self::model()->findByPk($id);
    }
}
