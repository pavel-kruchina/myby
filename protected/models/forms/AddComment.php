<?php
namespace models\forms;

class AddComment extends ExtendedForm
{
	public $text;
	public $offer_id;
	
    public function attributeLabels() {
        return array(
            'text'=>'текст комментария',
            );
    }
    
    public function rules()
	{
		return array(
			array('text, offer_id', 'required'),
		);
	}
    
    protected function beforeValidate() {
        parent::beforeValidate();
        $this->fixAttributes();
        
        return true;
    }
    
    protected function getFixRules() {
        return array(
            array('text', 'cleanTag'),
            array('text', 'magicTags'),
        );
    }

}
