<?php

class Controller
{
    protected function loadModel($model)
    {
        $modelFile = "../src/Models/" . $model . ".php";
        return new $model;
    }

    protected function renderView(string $viewPath, array $data = [])
    {
        $viewFile = "../src/Views/" . $viewPath . ".php";

        if (file_exists($viewFile)) {
            if (!empty($data) && is_array($data)) {
                extract($data);
            }
            require_once $viewFile;
        } else {
            throw new \Exception("View $viewFile tidak ditemukan.");
        }
    }
}

