<?php

namespace Nicolasfromerom\PruebaTecnica\App\Controllers;

use Nicolasfromerom\PruebaTecnica\Core\Controller;

class HomeController extends Controller {
    public function index() {
        $this->jsonResponse(["message" => "Hello, world!"]);
    }

    public function about() {
        $this->jsonResponse(["message" => "About us"]);
    }
}
