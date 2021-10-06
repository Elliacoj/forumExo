<?php

namespace App\Controller\Traits;

trait RenderController {

    /**
     * Change html content into main page
     * @param string $view
     * @param string $title
     * @param array|null $data
     * @param string|null $value
     */
    public function render(string $view, string $title, array $data = null, string $value = null) {
        ob_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . "/View/$view.view.php";
        $html = ob_get_clean();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/_partials/base.view.php';
    }
}