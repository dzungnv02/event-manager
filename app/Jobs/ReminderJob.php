<?php
namespace App\Jobs;

use App\Event;

class ReminderJob {

    protected $logFile;
    protected $eventModel;

    public function __construct($db)
    {
        $this->eventModel = new Event($db);
        $this->logFile = dirname(dirname(__DIR__)).'/logs/reminder.log';
    }

    public function reminder()
    {
        $events = $this->eventModel->getEventToReminder(5);
        
        if (count($events) > 0) {
            $fh = fopen($this->logFile, 'a+');
            fwrite($fh, '['.date("Y-m-d H:i:s").'] - ' .var_export($events, true) . "\n");
            fclose($fh);
        }
    }
}