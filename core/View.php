<?php

namespace app\core;

class View
{
    public static function staticRender(string $view, array $params = []): bool|array|string
    {
        return (new View)->renderOnlyView( $view, $params);
    }

    protected function renderOnlyView(string $view, array $params): bool|string
    {
        foreach ($params as $k => $v) {
            $$k = $v;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}