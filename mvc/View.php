<?php

namespace MVC;

class View
{
    public static string $viewsPath;
    public static string $layoutPath;

    public static function init(string $viewsPath, string $layoutPath): void
    {
        self::$viewsPath = rtrim($viewsPath, '/\\');
        self::$layoutPath = $layoutPath;
    }

    public static function render(string $view, array $data = []): void
    {
        // Extraer variables
        extract($data, EXTR_SKIP);

        ob_start();
        require self::$viewsPath . '/' . trim($view, '/\\') . '.php';
        $contenido = ob_get_clean();

        require self::$layoutPath;
    }

    public static function load(string $view, array $data = []): string
    {
        extract($data, EXTR_SKIP);

        ob_start();
        require self::$viewsPath . '/' . trim($view, '/\\') . '.php';
        return ob_get_clean();
    }

    public static function json(array $payload, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload);
    }
}
