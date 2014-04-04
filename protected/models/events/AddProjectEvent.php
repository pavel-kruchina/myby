<?php
namespace models\events;

class AddProjectEvent  extends BaseEvent{
    public $project_id;
    
    public function Process() {
        $project = \Project::getActiveById($this->project_id);
        if (!$project->id)
            return true;
        
        \actionControllers\Mailer::sendToAllActiveManagers('Добавлен новый заказ "'.$project->title.'"- <a href="http://myby.com.ua/shopmanager/project/'.$project_id.'">перейти к заказу</a>', 'Новый проект на сайте MyBy');
        return true;
    }
}