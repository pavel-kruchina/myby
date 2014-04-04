<?php
namespace models\events;
abstract class BaseEvent {
    public function __construct($params = null) {
        $this->setParams($params);
    }
    
    public function setParams($params) {
        if (is_object($params))
            $params = get_object_vars($params);
        
        if (!is_array($params))
            return;
        
        foreach($params as $paramName=>$paramValue){
            if (property_exists($this, $paramName)) {
                $this->$paramName = $paramValue;
            }
        }
    }
    
    public function create() {
        $params = get_object_vars($this);
        
        $event = new \Event();
        $event->create_date = \helpers\Date::getCurrent();
        $event->name = get_class($this);
        $event->data = json_encode($params);
        $event->save();
    }
    
}