<?php

namespace helpers;

class DataExtractor {
    public static function extractColumn($arrayOfObjects, $column) {
        $result = array();
        
        foreach($arrayOfObjects as $obj) {
            $result[] = $obj->$column;
        }
        
        return $result;
    }
    
    public static function transformArrayToColumnIndexedArray($arrayOfObjects, $column='id') {
        $result = array();
        
        foreach($arrayOfObjects as $obj) {
            $result[$obj->$column] = $obj;
        }
        
        return $result;
    }
    
    public static function transformArrayToGroupedColumnIndexedArray($arrayOfObjects, $groupColumn, $indexColumn='id') {
        $result = array();
        
        foreach($arrayOfObjects as $obj) {
            $result[$obj->$groupColumn][$obj->$indexColumn] = $obj;
        }
        
        return $result;
    }
}