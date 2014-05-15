<?php
namespace models\forms;

class AddMessageForm extends ExtendedForm
{
	public $message;
	
    public function attributeLabels() {
        return array(
            
            'message' => 'Ваше сообщение',
            );
    }
    
    public function rules()
	{
		return array(
			array('message', 'required'),
		);
	}
    
    protected function beforeValidate() {
        parent::beforeValidate();
        $this->fixAttributes();
        
        return true;
    }
    
    protected function getFixRules() {
        return array(
            array('message', 'cleanTag'),
        );
    }

}
