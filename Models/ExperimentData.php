<?php

class ExperimentData
{
    private $expID, $type, $name, $totalTime, $date, $description, $linkForm;

    public function __construct($dbRow)
    {
        $this->expID = $dbRow['id'];
        $this->type = $dbRow['type'];
        $this->name = $dbRow['name'];
        $this->totalTime = $dbRow['totaltime'];
        $this->date = $dbRow['date'];
        $this->description = $dbRow['description'];
        $this->linkForm = $dbRow['formHtml'];
    }

public function getID(){
    return $this->expID;
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
    public function getLinkForm(){
        return $this->linkForm;
    }


}