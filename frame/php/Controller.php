<?php
namespace frame\php;

class Controller{
    //持有同名的模型
    protected $model = null;
    
    //自动加载和控制器名称相同的类
    public function __construct(){
        $this->loadModel();
        
    }
    
    public function loadModel(){
        //model类的命名规则,类名Model
        //判断需要加载的模型类文件是否存在,如果存在就自动载入
        $class = CONTROLLER.'Model';
        
        $path = App.'/model/'.$class.'.php';
        
        
        if(file_exists($path)){
            include $path;
            //var_dump(class_exists(IndexModel));die;
            $this->model = new $class();
        }
    }
}