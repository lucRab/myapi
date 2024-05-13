<?php
namespace App\http\controller;

use App\model\Event;
use stdClass;
use Exception;
class EventController {
    
    protected Event $repository;

    public function __construct() {
        $this->repository = new Event();
    }

    public function index() {}
    
    public function create() {}

    public function store() {}
    
    public function update() {}
    public function show() {}
}