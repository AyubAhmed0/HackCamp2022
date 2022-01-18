<?php

class ExperimentData
{
    protected $type, $name, $totalTime, $date, $description;

    public function __construct($dbRow)
    {
        $this->type = $dbRow['type'];
        $this->name = $dbRow['name'];
        $this->totalTime = $dbRow['totaltime'];
        $this->date = $dbRow['date'];
        $this->description = $dbRow['description'];
    }
//type survey , poll etc
    public function getType(){
    return $this->type;
}
    public function getName(){
        return $this->name;
    }
    public function getTotalTime(){
        return $this->totalTime;
    }
    public function getDate(){
        return $this->date;
    }
    public function getDescription(){
        return $this->description;
    }


}