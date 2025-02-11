<?php

class Controller
{
    protected function loadModel($model)
    {
        $modelFile = "../src/Models/" . $model . ".php";
        return new $modelFile;
    }

    protected function renderView(string $viewPath, array $data = [])
    {
          
                extract($data);
                require_once '../Views/layout.php';
            
    }
}