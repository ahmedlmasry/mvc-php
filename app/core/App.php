<?php



class App
{


    protected $controller = "HomeController";
    protected $action = "index";
    protected $params = [];

    public function __construct()

    {
        $this->prepareUrl($_SERVER['REQUEST_URI']);
        $this->render();
    }


    private function prepareUrl($url)
    {
        // $url = $_SERVER['QUERY_STRING'];
        $url = trim($url, "/");
        if (!empty($url)) {
            $url = explode("/", $url);
            $this->controller = isset($url[0]) ? ucwords($url[0]) . "controller" : "homecontroller";
            $this->action = isset($url[1]) ? $url[1] : "index";
            unset($url[0], $url[1]);
            $this->params = !empty($url) ? array_values($url) : [];
        }
    }
    private function render()
    {
        if (class_exists($this->controller)) {
            $controller = new $this->controller;
            if (method_exists($controller, $this->action)) {

                call_user_func_array([$controller, $this->action], $this->params);
            } else {
                echo 'method dosent exists';
            }
        } else {
            echo "this controller : " . $this->controller . " not exists";
        }
    }
}
