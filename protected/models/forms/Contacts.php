<?php
namespace models\forms;

class Contacts extends ExtendedForm
{
	public $mail;
	public $text;
	
    public function attributeLabels() {
        return array(
            'mail'=>'E-mail:',
            'text'=>'Вопрос'
            );
    }
    
    public function rules()
	{
		return array(
			array('mail, text', 'required'),
		);
	}
    
    protected function beforeValidate() {
        parent::beforeValidate();
        $this->fixAttributes();
        
        return true;
    }
    
    protected function getFixRules() {
        return array(
            array('mail, text', 'cleanTag'),
        );
    }

}
