<?php 
class Dispatcher {

    var $request;

    function __construct(){
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        $action = $this->request->action;
        if($this->request->prefix){
            $action = $this->request->prefix.'_'.$action;
        }
        if (!in_array($action,array_diff(get_class_methods($controller), 
            get_class_methods('Controller')))){
            $this->error("Cette page n'existe pas.");
            
        }
        call_user_func_array(array($controller,$action),$this->request->params);
        $controller->render($action);
    }

    function error($message){
        $controller = new Controller($this->request);
        $controller->e404($message);
    }

    function loadController(){
        $name = ucfirst($this->request->controller).'Controller';
        $file = ROOT.DS.'controller'.DS.$name.'.php';
        if(!file_exists($file)){
            $this->error("Cette page n'existe pas.");
        }
        require $file;
        $controller = new $name ($this->request);
        return $controller;
        }
    
} 



