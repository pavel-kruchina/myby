<?php
namespace models\forms;

class UserRegistrationForm extends ExtendedForm
{
	public $mail;
	public $password;
    public $name;
    public $sname;
	
    protected function getFixRules() {
        return array(
            array('name, sname', 'trimStr'),
        );
    }
    
    public function attributeLabels() {
        return array(
            'mail'=>'Почта (e-mail)',
            'password'=>'Пароль',
            'name'=>'Имя',
            'sname'=>'Фамилия',
            );
    }
    
    public function rules()
	{
		return array(
			array('mail, password, name', 'required'),
            array('mail, password, name, sname', 'safe'),
		);
	}
    
    protected function beforeValidate() {
        parent::beforeValidate();
        $this->fixAttributes();
        
        return true;
    }
    
}
