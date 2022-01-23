<?php
require_once('Models/ExperimentData.php');
require_once('Models/Database.php');
class ExperimentDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllUsers()
    {
        $sqlQuery = 'SELECT * FROM user';
        $statement = $this->_dbHandle->prepare($sqlQuery);

        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ExperimentData($row);
        }
        return $dataSet;
    }
    public function fetchAllExperiments()
    {
        $sqlQuery = 'SELECT * FROM experiment';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ExperimentData($row);
        }
        return $dataSet;
    }
}