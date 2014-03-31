<?php
namespace models\forms;

class AddProjectOffer extends ExtendedForm
{
	public $offer;
    
	
    public function attributeLabels() {
        return array(
            'offer'=>'Укажите ваше предложение',
            );
    }
    
    public function rules()
	{
		return array(
			array('offer', 'required'),
		);
	}
    
    protected function beforeValidate() {
        parent::beforeValidate();
        $this->fixAttributes();
        
        return true;
    }
    
    protected function getFixRules() {
        return array(
            array('offer', 'cleanTag'),
            array('offer', 'magicTags'),
        );
    }

}
