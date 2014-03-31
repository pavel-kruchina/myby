<?php
include "dbl_config.php";

class DBL {
    protected $dbHandler;

    function loadSql() {
        try {
                $this->init();
                $sqlList = $this->getSqlList();
                $this->checkAndPutInDB($sqlList);
                $this->finishedSuccessfull();

        } catch (Exception $exception) {
                $this->finishedUnsuccessfull($exception->getMessage());

        }
    }

    function init() {
        $this->dbInit();
        $this->checkDblTable();
    }

    function checkDblTable() {
        $sql = file_get_contents("dbl-table.sql");
        if (!$this->dbHandler->query($sql)) {
            $this->throwDbException();
        }
    }

    function throwDbException() {
        throw new Exception($this->dbHandler->error);
    }

    function dbInit() {
        global $config;
        $db = $config['db']['params'];

        $this->dbHandler = new mysqli($db['host'], $db['user'], $db['pass'], $db['dbname']);

        if ($this->dbHandler->connect_errno) {
            throw new Exception($mysqli->connect_error);
        }
    }

    function getSqlList() {
        $result = array();

        $dirHandler = opendir('sql');
        for ($file = readdir($dirHandler); $file !== false; $file = readdir($dirHandler)) {
            if (filetype('sql/'.$file) == "file") {
                $result[] = $file;
            }
        }
        sort($result);
        return $result;
    }

    function checkAndPutInDB($sqlList) {
        $registredFiles = $this->getRegistredFiles();
        foreach ($sqlList as $file) {
            if (!isset($registredFiles[$file])) {
                $this->addSql($file);
            }
        }
    }

    function addSql($file) {
        $sql = file_get_contents('sql/'.$file);
        if (!$this->dbHandler->multi_query($sql)) {
            echo 'error';
            $this->throwDbException();
        }

        $this->flushResults();
        if (!$this->dbHandler->query('INSERT INTO `dbl_log` set `file_name`="'.$file.'", `status`="add"')) {
            $this->throwDbException();
        }
    }

    function flushResults() {
        while ($this->dbHandler->next_result()) {;}
    }

    function getRegistredFiles() {
        $registeredFiles = array();

        $res = $this->getResFromDB('SELECT * FROM dbl_log;');
        while ($row = $res->fetch_assoc()) {
            $registeredFiles[$row['file_name']] = $row['status'];
        }

        return $registeredFiles;
    }

    function getResFromDB($query) {
        $res = $this->dbHandler->query($query);

        if (!$res) {
            $this->throwDbException();
        }

        return $res;
    }

    function finishedSuccessfull() {
        echo 'allOk';
    }

    function finishedUnsuccessfull($message) {
        echo "\r\nWe have some problems here: \r\n".$message;
    }
}

$dbLoader = new DBL();
$dbLoader->loadSql();