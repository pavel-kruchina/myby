<?php
namespace models\forms;

class CreateConversationForm extends ExtendedForm
{
	public $offer_id;
	public $message;
	
    public function attributeLabels() {
        return array(
            
            'message' => 'Ваше сообщение',
            );
    }
    
    public function rules()
	{
		return array(
			array('offer_id, message', 'required'),
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
