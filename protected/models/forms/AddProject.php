<?php
namespace models\forms;

class AddProject extends ExtendedForm
{
	public $title;
	public $describe;
	
    public function attributeLabels() {
        return array(
            'title'=>'Укажите тип товара, Ваш бюджет',
            'describe'=>'Уточните модель и Ваши пожелания'
            );
    }
    
    public function rules()
	{
		return array(
			array('title, describe', 'required'),
            array('title, describe', 'length', 'min'=>4),
		);
	}
    
    protected function beforeValidate() {
        parent::beforeValidate();
        $this->fixAttributes();
        
        return true;
    }
    
    protected function getFixRules() {
        return array(
            array('title, describe', 'cleanTag'),
            array('describe', 'magicTags'),
        );
    }

}
