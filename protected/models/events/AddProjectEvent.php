<?php
namespace models\events;

class AddProjectEvent  extends BaseEvent{
    public $project_id;
    
    public function Process() {
        $project = \Project::getActiveById($this->project_id);
        if (!$project->id)
            return true;
        
        \actionControllers\Mailer::sendToAllActiveManagers('Добавлен новый заказ "'.$project->title.'"- <a href="http://myby.com.ua/shopmanager/project/'.$this->project_id.'">перейти к заказу</a>', 'Новый проект на сайте MyBy', MAIL_TYPE_NEW_PROJECT);
        return true;
    }
}