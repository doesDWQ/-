<?php

//这个分页类只是负责显示线面的下一页等按钮的

//分页类,这个类需要被写的相对的独立,但是此时还是不具有独自操作数据库的能力
/*
 * $allDateCount:总页数
 * $currentPage:当前页数
 * $btnMaxCount:最大按钮个数
 * $dataCount:每页显示多少条数据
 * 
 * 返回的数据是一个控制按钮边界的数组
 * $data = [
 * 	//第一按钮的标号
	'first'=>$first,
	//最后一个按钮的标号
	'end'=>$end,
	//当前页面标号
	'current'=>$this->currentPage,
	//最后一个页面的标号
	'endPage'=>$this->allPage
	];
 */
class DetachPage{
	//总页数
	private $allPage = 0;
	
	//当前页数
	private $currentPage = 0;
	
	//每页显示多少条数据
	private $dataCount = 0;
	
	//最大按钮个数
	private $btnMaxCount = 0;
	
	
	/**
	* $allDateCount:总页数
	* $currentPage:当前页数
	* $btnMaxCount:最大按钮个数
	* $dataCount:每页显示多少条数据
	*/
	public function __construct($allDateCount,$currentPage,$btnMaxCount,$dataCount){
		//$allDateCount:总的数据的条数
		$this->allPage = ceil($allDateCount/$dataCount);
		
		//当前页数不能是0,也不能是负数
		if($currentPage<1){
			$currentPage=1;
		}
		
// 		var_dump($this->allPage);echo '<br />';
		//当前页数不能超过最大的页数
		if($currentPage>$this->allPage){
			$currentPage=$this->allPage;
		}
		$this->currentPage = $currentPage;
		$this->btnMaxCount=$btnMaxCount;
		$this->dataConunt=$dataCount;
	}
	
	//返回当前按钮组开始的数字和结尾的数字
	public function getBtnDate(){
		
		$first = 0;
		$end   = 0;
		//如果得到总页数小于等于最大按钮的个数,那么就显示所有页数
		if($this->allPage <= $this->btnMaxCount){
			$first=1;
			$end = $this->allPage;
		}
		else{
			//否则只显示最大个数的按钮
			$halfBtnCount = floor($this->btnMaxCount/2);
			$rightLeftCount = $this->btnMaxCount-$halfBtnCount;
// 			8 6 11
			
			//当前页面小于等于一半按钮数的时候,就是左半部分按钮不够的时候
			if($this->currentPage<=$halfBtnCount){
				$first=1;
				$end = $this->btnMaxCount;
			}else if($this->allPage - $this->currentPage <= $rightLeftCount){
				//当有半部分按钮不够用的时候
				$end = $this->allPage;
				$first = $this->allPage-$this->btnMaxCount+1;
			}else{
				$first = $this->currentPage - $rightLeftCount+1;
				$end = 	$this->currentPage + $halfBtnCount;
			}
			
		}
		
		
		//控制边界
		//$first = $first<1?1:$first;
		//$end = $end>$this->allPage?$this->allPage:$end;
		
		$data = [
			'first'=>$first,
			'end'=>$end,
			'current'=>$this->currentPage,
			'endPage'=>$this->allPage
		];
		
		return $data;
	}
}


/*
	分页总结:
	1,当页数不足按钮数时,如何操作?
	2,当左边界不够时如何操作?
	3,当右边界按钮不够时如何操作?
	4,当前页数不能是小于1的数,也不能是大于最大页数的数.
*/