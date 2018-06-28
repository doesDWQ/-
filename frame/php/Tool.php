<?php
namespace frame\php;

class Tool{
    private static $mysql = null;
    private static $objs = [];
    private static $config = [];
    
    /*
     * 获取到配置数组
     */
    public static function getConfig($name=''){
        //一定作用起到了单例的作用
        if(!(self::$config)){
            self::$config = include Frame.'/config/config.php';
        }
        
        if($name!=''){
            return self::$config[$name];
        }
        
        return self::$config;
    }
    
    
    //自动获取指定app/classes类里面的对象,形成了一个工厂单例
    public static function getObj($className,$data=[]){
        if(!(self::$objs[$className])){
            include App.'/classes/'.$className.'.php';
            $paras = implode(',', $data);
            self::$obj[$className] = new $className($paras);
        }
        return self::$obj[$className];
    }
    
    //加载模板文件,如果有指定的话就加载指定的模板文件,如果没有指定的话就加载与方法名一致的模板文件
    public static function loadTemplate($fileName=''){
        //定义模板文件的存储在app目录下面的view目录下面对应的控制器方法的对应的名称下面
        $path = App.'/'.DIR.'/view/'.strtolower(CONTROLLER);
        if($fileName){
            $path .= '/'.$fileName.'.html';
        }
        else{
            $path .= '/'.ACTION.'.html';
        }
        include $path;
    }
    
    //当需要连表查询的时候,就需要使用到单独的MyPdo对象,形成一个mysql工厂单例
    public static function getMyPdo(){
        if(!self::$mysql){
            $config = Tool::getConfig('mysql');
            self::$mysql = new MyPdo($config);
        }
        return self::$mysql;
    }
}