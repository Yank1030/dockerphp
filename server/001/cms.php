<?php

namespace MyCMS;


class CMS
{
    private $template;
    private $length;
    private $variables;
    private $data;

    public function __construct($template, $length)
    {
        $this->template = $template;
        $this->length = $length;
        if (preg_match_all('/{{([^}]+)}}/', $this->template, $p)) {
            $this->variables = $p[1];
        }
        $this->data = array(
            'title' => array('1番目のタイトル', '2番目のタイトル'),
            'body' => array('1番目の本文', '2番目の本文')
        );
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
}