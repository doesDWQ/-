<?php
//类的命名空间的命名规则,根据目录命名
namespace frame\php;

class Frame{
    
    //设置浏览器解析编码
    private static function setCharacter(){
        header('Content-Type:text/html;charset=utf-8');
    }
    
    
    //定义目录常量
    private static function define_dir(){
        //定义frame目录常量
        define('Frame', '../frame');
        //定义app目录常量
        define('App', '../app');
        
    }
    
    //载入控制器基类,模型基类,工具类等
    private static function auto_load(){
        include Frame.'/php/Controller.php';
        include Frame.'/php/Model.php';
        include Frame.'/php/Tool.php';
        include Frame.'/php/MyPdo.php';
        
        //使用自动加载类自动加载extend目录里面的类
        include Frame.'/php/AutoLoads.php';
        //如果其他某个目录里面的类也需要全部加载,在里面在加一个目录名就可以了
        $dirs = array(
            Frame.'/extend'
            
        );
        AutoLoads::setDirs($dirs);
    }
    
    //分发请求
    private static function detacheRequest(){
        //得到请求的路径,此处规定请求的路径必须是_p=控制器名-方法名
        $path = $_REQUEST['_p'];
        $data = explode('-', $path);
        
        if(count($data)!=2){
           exit('你填写的路径有问题!');
        }
        
        //new出控制器,此时控制器名称第一个字母可以小写
        $class = ucfirst($data[0]);
        //定义类名常量供Controller类使用
        define('CONTROLLER', $class);
        define('ACTION',$data[1]);
        //控制器命名规则为,控制器名Controller.php,这样的命名规则主要是为了避免类里面的方法和类名一致,就是避免默认构造生效
        $class .= 'Controller';
        
        //要求app里面的所有类不能有命名空间否则新建对象失败
        include App.'/controller/'.$class.'.php';
        //include '../app/controller/Index.php';
        //var_dump(App.'/controller/'.$class.'.php');die;
        
        $obj = new $class();
        
        //调用方法
        $obj->$data[1]();
    }
    
    public static function run(){
        self::setCharacter();
        self::define_dir();
        self::auto_load();
        self::detacheRequest();

    }
}

Frame::run();