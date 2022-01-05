<?php

class App {
    // properti untuk menentukan controller, method, dan parameter default
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct () {
        $url = $this->parseURL();

        // cek ada ga sebuah file di dalam folder controllers yang namanya sesuai dengan nama yang ditulis di URL
        if(file_exists('../app/controllers/'. $url[0] . '.php')){
            $this->controller = $url[0];
            // kita hilangkan controllernya dari elemen array nya ini supaya kita bisa apus parameternya
            unset($url[0]);
        }

        // panggil controllernya
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // bikin logic yang sama buat method
        if( isset($url[1]) ) {
            // cek method dari controller yang baru di instance
            if( method_exists($this->controller, $url[1]) ) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // kelola parameternya
        if( !empty($url) ) {
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // membuat method yang bertugas untuk mengambil URL dan memecah sesuai keinginan kita
    public function parseURL() {
        if( isset($_GET['url']) ){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}