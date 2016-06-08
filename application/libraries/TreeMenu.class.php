<?php

/**
 * Description of TreeMenu
 *
 * @author ali sharifi 
 * alisharifi01@gmail.com
 */
/*
 *  this class make a nested unordered list (ul li) from an array that store hierarchical data
 * if you dont know what is hierarchical data , check this http://www.sitepoint.com/hierarchical-data-database-2/  
 */
class TreeMenu{
    private $array,$style;
    public function __construct($array,$style){
        $this->array=$array;
        $this->style=$style;
        $this->makeListFromArray();
    }
    private function displayWithChildren($rootID){
        foreach($this->array as $item){
            if($item['parent']==$rootID){
                echo "<ul>";
                echo "<li data-options=\"state:'closed'\">".
                     "<span>".   
                     $item['name'].
                      "</span>";
                $this->displayWithChildren($item['id'],$this->array);
                echo "</li>";
                echo "</ul>";
            }
        }
    }
    private function makeListFromArray(){
        echo "<ul class='".$this->style."'>";
        foreach($this->array as $item){
            if($item['parent']==0){
                echo "<li data-options=\"state:'closed'\">".
                     "<span>".
                     $item['name'].
                     "</span>";
                echo $this->displayWithChildren($item['id'],$this->array);
                echo "</li>";
            }
        }
        echo "</ul>";
    }
}

?>