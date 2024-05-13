<?php
namespace App\http\controller;

use App\model\Tickt;
use stdClass;
use Exception;

class TickController {
    protected $repository;
    public function __construct() {
        $this->repository = new Tickt();
    }

    public function index() {}
    
    public function create() {}

    public function store() {}
    
    public function update() {}
    public function show() {}
}