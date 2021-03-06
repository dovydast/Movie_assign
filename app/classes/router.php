<?php
    class router{

        private $routes;

        function __construct(){
            $this->routes = $GLOBALS["config"]["routes"];
            $route = $this->findRoute();
            if(class_exists($route["controller"])){
                $controller = new $route["controller"]();
                if(method_exists($controller,$route['method'])){
                      $controller->$route["method"]();
                }
                else {
                    url::redir("/Movie_assign",3);
                }
            }
            else{
                url::redir("/Movie_assign",3);
            }
        }
        private function routePart($route){
            if(is_array($route)){
                $route = $route["url"];
            }
            $parts = explode("/",$route);
            return $parts;
        }
        static function uri($part) {

            return url::part($part);
        }
        private function findRoute(){
            foreach($this->routes as $route) {
                $parts = $this->routePart($route);
                $allMatch = true;
                foreach($parts as $key => $value) {
                    if($value != "*"){
                        if(router::uri($key) != $value){
                            $allMatch = false;
                        }
                    }
                }
                if($allMatch){
                    return $route;
                }

            }

            $uri_1 = router::uri(1);
            $uri_2 = router::uri(2);
            if($uri_1 == ""){
                $uri_1 = $GLOBALS["config"]["default"]["controller"];
            }
            if($uri_2 == ""){
                $uri_2 = $GLOBALS["config"]["default"]["method"];
            }
            $route = array(
                "controller" => $uri_1,
                "method" => $uri_2
            );
            return $route;
        }
    }