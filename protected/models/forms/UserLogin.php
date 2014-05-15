<?php
namespace models\forms;

class UserLogin extends ExtendedForm
{
	public $mail;
	public $password;
	
    public function attributeLabels() {
        return array(
            'mail'=>'Почта (e-mail)',
            'password'=>'пароль',
            );
    }
    
    public function rules()
	{
		return array(
			array('mail, password', 'required'),
		);
	}
    
    protected function beforeValidate() {
        parent::beforeValidate();
        $this->fixAttributes();
        
        return true;
    }
    
    protected function getFixRules() {
        return array();
    }

}
