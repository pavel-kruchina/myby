<?php
class BaseModel extends CActiveRecord {
    
    /**
     * @$page number from 0
     */
    static protected function findWithPagination(CDbCriteria $criteria, $page, $countOnPage) {
        $start = $page*$countOnPage;
        $criteria->limit = $countOnPage;
        $criteria->offset = $start;
        
        $records = static::model()->findAll($criteria);
        $count = static::model()->count($criteria);
        return array('records'=>$records, 'count'=>$count);
    }
}