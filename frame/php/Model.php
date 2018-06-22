<?php
//继承了这个类之后就具有了操作数据库的能力
namespace frame\php;

class Model{
    protected $mysql = null;
    
    public function __construct(){
        
        $this->mysql = Tool::getMyPdo();
    }
}