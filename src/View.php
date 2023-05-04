<?php

namespace app\core;

class View
{
    public string $layout = 'main';
    public static string $ROOT_DIR;


    public function __construct(string $ROOT_DIR)
    {
        self::$ROOT_DIR = $ROOT_DIR;
    }

    public function render(string $view): array|false|string
    {
        $layout_content = $this->renderLayout();
        $view_content = $this->renderView($view);

        return str_replace('{{content}}', $view_content, $layout_content);
    }

    protected function renderLayout(): false|string
    {
        ob_start();
        include_once self::$ROOT_DIR . "/views/layouts/{$this->layout}.php";
        return ob_get_clean();
    }

    protected function renderView(string $view): false|string
    {
        ob_start();
        include self::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}