<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace App\Traits;

trait HasLayout
{
    public $layoutData = [];

    public $data = [];

    public $params = [];

    public $title;

    public $model;

    public function layout($layout = 'app')
    {
        return view(sprintf('layouts.%s', $layout));
    }

    public function render(){
        return view($this->view(), array_merge($this->layoutData, $this->data))->layout($this->layout(), $this->layoutData);
    }

    public function view(){
        return sprintf('livewire.%s', strtolower(class_basename($this)));
    }

    protected function layoutData($data = []){
        $this->layoutData = $data;
    }

    protected function data($data = []){
        $this->data = $data;
    }

    protected function setModelProperty($model){
        $this->model = $model;
    }
}