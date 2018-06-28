<?php
namespace app\index\controller;
use frame\php\Controller;
use frame\php\Tool;

class IndexController extends Controller{
    
    public function index(){
        Tool::loadTemplate();
        
    }
    
}