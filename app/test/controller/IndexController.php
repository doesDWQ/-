<?php

use frame\php\Controller;
use frame\php\Tool;

class IndexController extends Controller{
    
    public function index(){
        var_dump(Tool::getMyPdo());
    }
    
}