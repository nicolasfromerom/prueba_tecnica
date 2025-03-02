<?php
namespace Nicolasfromerom\PruebaTecnica\Core;

class Controller {
    protected function jsonResponse($data, $status = 200) {
        http_response_code($status);
        echo json_encode($data);
    }
}
