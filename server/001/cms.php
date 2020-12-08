<?php

namespace MyCMS;


class CMS
{
    private $template;
    private $length;
    private $variables;
    private $data;
    private $password = '123';
    private $storage = './store.json';

    public function __construct($template, $length)
    {
        $this->template = $template;
        $this->length = $length;
        if (preg_match_all('/{{([^}]+)}}/', $this->template, $p)) {
            $this->variables = $p[1];
        }
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->saveData();
        }
        $this->loadData();

        if (isset($_GET['__edit']) && $_GET['__edit'] === $this->password) {
            $this->showForm();
        }
    }

    public function render()
    {
        $body = '';
        for ($i = 0; $i < $this->length; $i++) {
            $row = $this->template;
            foreach ($this->variables as $key) {
                $row = str_replace('{{' . $key . '}}', $this->data[$key][$i], $row);
            }

            $body .= $row;
        }
        echo $body;
    }

    public function loadData()
    {
        if (file_exists($this->storage)) {
            $this->data = json_decode(file_get_contents($this->storage), true);
        }
    }

    public function saveData()
    {
        file_put_contents($this->storage, json_encode($_POST));
    }

    public function showForm()
    {
        echo '<form method="POST">';
        for ($i = 0; $i < $this->length; $i++) {
            echo '<div>';
            foreach ($this->variables as $key) {
                echo $key;
                echo '<textarea name="' . $key . '[]">' . $this->data[$key][$i] . '</textarea>';
            }
            echo '</div>';
        }
        echo '<input type="submit" value="保存">';
        echo '</from>';
    }
}