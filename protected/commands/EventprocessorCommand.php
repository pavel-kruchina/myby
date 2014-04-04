<?php
class EventprocessorCommand extends CConsoleCommand {
    public function run($args) {
        $events = Event::getUnProcessedEvents();
        
        foreach ($events as $event) {
            $eventName = $event->name;
            $eventController = new $eventName(json_decode($event->data));
            
            if ($eventController->process()) {
                $event->processed='yes';
                $event->save();
            }
        }
    }
}