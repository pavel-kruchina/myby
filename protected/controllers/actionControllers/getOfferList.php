<?php
namespace actionControllers;

use \Controller;
use \Project;

class getOfferList extends Controller
{
	public static function getListSmallPortion($page=0) {
        $projects = Project::getActiveRecordsSmallPortion($page);
        return array('projects'=>$projects);
    }
    
    public static function getUserListSmallPortion($userId, $page=0) {
        $projects = Project::getActiveRecordsForUserIdSmallPortion($userId, $page);
        return array('projects'=>$projects);
    }
    
    public static function getList($page=0) {
        $projects = Project::getActiveRecords($page);
        return array('projects'=>$projects);
    }
    
    public static function getUserList($userId) {
        $projects = Project::getActiveRecordsForUserId($userId);
        return array('projects'=>$projects);
    }
    
}