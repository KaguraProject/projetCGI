<?php
class Controller {

    public $request;
    private $vars = array();
    public $layout = 'header';
    private $rendered = false;

    function __construct($request = null){
        if($request) {
            $this->request = $request;
            require ROOT.DS.'config'.DS.'hook.php';
        }
        
    }

    public function render($view){
        if($this->rendered){ return false; }
        extract($this->vars);
        if(strpos(($view),'/')===0){
            $view = ROOT.DS.'view'.$view.'.php';
        }else{
            $view= ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
        }
        ob_start();
        require($view);
        $content = ob_get_clean();
        require ROOT.DS.'view'.DS.$this->layout.'.php';
        $this->rendered=true;
    }

    public function set($key, $value=null){
        if (is_array($key)){
            $this->vars += $key;
        }else{
            $this->vars[$key] = $value;
        }
    }

    function loadModel($name){
    
        if(!isset($this->$name)){
            $file= ROOT.DS.'model'.DS.$name.'.php';
            require_once($file);
            $this->$name = new $name();
            if(isset($this->Form)){
                $this->$name->Form = $this->Form;
            }
            
        } 
    }

  function e404($error){

        header("HTTP/1.0 404 Not Found");
        $this->set('error',$error);
        $this->render('/errors/404');
        die();

  }

  function request ($controller, $action){
    $controller .= 'Controller';
    //die($controller);
    require_once ROOT.DS.'controller'.DS.$controller.'.php';
    $c = new $controller();
    return $c -> $action();
  }

  function redirect($url,$code = null){
    if ($code == 301){
        header("HTTP/1.1 301 Moves Permanently");
    }
    header("Location: ".Router::url($url));
  }

}
?>