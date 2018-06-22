<?php
namespace frame\php;
/*作用:自动加载指定目录里面的所拥有的类
 * 1,使用该类的时候,使用的类名必须是.class.php结尾的后缀
 * 2,传入的参数必须是类可能在的所有的目录
 * 3,使用的时候需要这个加载这个文件
 * 4,传入数组参数的时候最好是命中率高的文件夹名称放在前面
 */

//测试
// AutoLoads::setDirs('a','b');
// $p  = new A();
// var_dump($p);

//自动加载函数是php里面提供的一种加载机制,当php里面使用到未被加载的类时,会在设置的自动加载函数里面加载.
class AutoLoads{
	//需要被加载的所有类所在的目录
	private static $dirs = null;
	
	//设置所有的目录,并定义和注册所有的函数
	public static function setDirs($dirs){
		self::$dirs = &$dirs;
		self::loads();
	}
	
	//定义出所有的函数并注册进去
	private static function loads(){
		
		foreach (self::$dirs as $key=>$dir){
		//1,将所有的加载函数字符串定义出来
$fun =<<< heredoc
		function autoload_{$key}(\$cls){
		//当含有命名空间的时候需要这一句
		\$cls = basename(\$cls);
		\$file = "$dir/{\$cls}.php";
		if(is_file(\$file)){
			include \$file;
		}
		}
heredoc;
		//1,定义出函数来,这里定义出来的函数实际上是在类的外面的
		eval($fun);
		
		}
		//注册所有的函数
		$len = count(self::$dirs);
		for($i=0; $i<$len; $i++){
			//因为是定义的全局的函数,所有直接使用函数名注册就可以了
			spl_autoload_register("autoload_{$i}");
		}
		
	}
	
	
	
	
}
