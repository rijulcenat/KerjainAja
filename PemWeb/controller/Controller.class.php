<?php 
class Controller { 
    function model($model) {
        require_once("model/Model.class.php");  
        require_once("model/$model.class.php"); 
        return new $model;                      
    }

    function view($view, $data = []){
        foreach($data as $key => $value)         
        $$key = $value;
    include("view/$view");                       
    }
}