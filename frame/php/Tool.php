<?php
namespace frame\php;

class Tool{
    
    /*
     * 获取到配置数组
     */
    public static function getConfig(){
        $config = include Frame.'/config/config.php';
        return $config;
    }
    
    
    //自动获取指定app/classes类里面的对象
    public static function getObj($className,$data=[]){
        include App.'/classes/'.$className.'.php';
        $paras = implode(',', $data);
        return new $className($paras);
    }
    
    //加载模板文件,如果有指定的话就加载指定的模板文件,如果没有指定的话就加载与方法名一致的模板文件
    public static function loadTemplate($fileName=''){
        //定义模板文件的存储在app目录下面的view目录下面对应的控制器方法的对应的名称下面
        $path = App.'/view/'.strtolower(CONTROLLER);
        if($fileName){
            $path .= '/'.$fileName.'.html';
        }
        else{
            $path .= '/'.ACTION.'.html';
        }
        include $path;
    }
    
    //当需要连表查询的时候,就需要使用到单独的MyPdo对象
    public static function getMyPdo(){
        $config = Tool::getConfig();
        return new MyPdo($config['mysql']);
    }
}