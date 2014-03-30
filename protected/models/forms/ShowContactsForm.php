<?php
namespace models\forms;

class ShowContactsForm extends ExtendedForm
{
	public $manager_id;
	public $phone;
    public $email;
    public $comment;
    public $user_id;
    public $project_id;
	
    public function attributeLabels() {
        return array(
            'phone'=>'Телефон',
            'email'=>'Электронная почта',
            'comment'=>'Комментарий',
            );
    }
    
    public function rules()
	{
		return array(
			array('manager_id, user_id, project_id', 'required'),
            array('manager_id, user_id, email, comment, phone, project_id', 'safe')
		);
	}
    
    protected function beforeValidate() {
        parent::beforeValidate();
        $this->fixAttributes();
        
        return true;
    }
    
    protected function getFixRules() {
        return array(
            array('phone, email, comment', 'cleanTag'),
        );
    }

}
