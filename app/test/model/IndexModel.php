<?php
use frame\php\Model;

class IndexModel extends Model{
    
    public function index(){
        $sql = 'select * from user';
        return $this->mysql->fetchAll($sql);
    }
}