<?php
require('../vendor/autoload.php');
require('../database/database.php');
use database\database;
use src\radical\tables;
use App\model\Table;
use App\model\User;

// $user = new User();
// $user->delete->where('iduser', '=',40 );
// $user->transaction();
// $user->destroy();

// $user->get->all();

// $get1 = $user->get();
// var_dump($get1);

// $user->rollback();
// $user->get->all();

// $get2 = $user->get();
// var_dump($get2);

// $t = new tables();
// $t->id();
// $t->string('nome');
// $t->int('numero');
// $a = database::create('tabela', $t->column);

// $t1 = new table();
// $t1->id();
// $t1->string('nome','50','NOT NULL');
// $t1->int('numero');
// $b = database::create('tabela1', $t1->column);
// var_dump( $b);

// $model = new Table();
// $model->insert->column('nome, numero');
// $model->insert->values(['nome' => 'nome', 'numero' => 1]);
// $model->insert();
//
//$a = database::refresh();
