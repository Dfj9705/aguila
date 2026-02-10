<?php

use MVC\View;

function render(string $view, array $data = []): void
{
    View::render($view, $data);
}

function load_view(string $view, array $data = []): string
{
    return View::load($view, $data);
}

function json_response(array $payload, int $status = 200): void
{
    View::json($payload, $status);
}
