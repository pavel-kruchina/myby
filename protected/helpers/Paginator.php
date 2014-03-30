<?php

namespace helpers;

class Paginator {
    public static function getPageList($count, $selectedPage, $itemsPerPage) {
        $pages = array();
        $pageCount = ((int)($count/$itemsPerPage)) + ($count%$itemsPerPage?1:0);
        
        for($i=0; $i<$pageCount; $i++) {
            if (self::isPageShowed($i, $pageCount, $selectedPage))
                $pages[] = array('text'=>$i+1, 'page'=>($selectedPage==$i)?null:($i));
        }
        
        return array('items'=>self::addSymbols($pages), 'count'=>$pageCount);
    }
    
    protected static function addSymbols($pages) {
        $result = array();
        $prevPage = null;
        
        foreach($pages as $page) {
            
            if ($prevPage===null) {
                $prevPage = $page;
                $result[] = $page;
                continue;
            }
            
            if($prevPage['text']==$page['text']-1) {
                $prevPage = $page;
                $result[] = array('text'=>',');
                $result[] = $page;
            } else {
                $prevPage = $page;
                $result[] = array('text'=>'...');
                $result[] = $page;
            }
        }
        
        return $result;
    }
    
    protected static function isPageShowed($page, $count, $selectedPage) {
        if ($page<2)
            return true;
        
        if ($selectedPage == 5 && $page == 3)
            return true;
        
        if ($page > $count-2)
            return true;
        
        if (($selectedPage == $count-4) && ($page == $count-2))
            return true;
        
        if ($page<=$selectedPage+1 && $page>=$selectedPage-1)
            return true;
        
        return false;
    }
}