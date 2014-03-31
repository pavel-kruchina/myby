<?php
namespace models\forms;
use \CFormModel;

class ExtendedForm extends CFormModel
{
	protected function getFixRules() {
        /*return array(
            array('title, text', 'required'),
        );*/
    }
    
    public function fixAttributes() {
        foreach($this->getFixRules() as $frule) {
            $this->applyFixRule($frule);
        } 
    }
    
    protected function applyFixRule($frule) {
        list($fields, $validator) = $frule;
        $fields = explode(',', $fields);
        
        foreach ($fields as $field) {
            $field = trim($field);
            $this->$field = $this->$validator($this->$field);
        }
    }

    public function cleanTag($attribute)
	{
        return strip_tags($attribute);
	}
    
    protected function magicTags($value) {
        $value=str_replace("\n", '<br>', $value);
        $value=preg_replace("#(https?|ftp)://\S+[^\s.,> )\];'\"!?]#",'<a class="thisPage" target="_blank" href="\\0">\\0</a>',$value);
        
        return $value;
    }
}
