<?php
class QuickForm extends CFormModel
{
    public $name;
    public $phone;
    public $timeToCall;
  
    public function rules()
    {
        return array(
            array('name, phone', 'required'),
            array('timeToCall', 'safe'),
        );
    }
  
    public function attributeLabels()
    {
        return array(
            'name'=>'Ваше имя',
            'phone'=>'Телефон',
            'timeToCall'=>'Время звонка',
        );
    }
}
