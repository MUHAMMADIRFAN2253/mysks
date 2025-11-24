<?php

class Controller
{
    public function view($view, $data = [])
    {
        require_once ROOT . '/app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once ROOT . '/app/models/' . $model . '.php';
        return new $model();
    }
}
