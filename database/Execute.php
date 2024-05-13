<?php
require "../vendor/autoload.php";
require "Database.php";
use Database\Database;
use src\radical\tables;

//--------------------------------------------|| START ||----------------------------------------------//
    Database::start();
//-----------------------------------------|| TABLE  USER||--------------------------------------------//
    // $user = new tables();
    // $user->id('user_id');
    // $user->string('name', '100');
    // $user->string('email', '80','UNIQUE');
    // $user->string('password','100');
    // Database::create('user',$user);

    //  $event = new tables();
    //  $event->id('event_id');
    //  $event->string('name', '100');
    //  $event->string('description', '300');
    //  $event->string('status');
    //  $event->int('vagas');
    //  $event->decimal('preco');
    //  $event->addcolumn('date','DATETIME');
    //  Database::create('event', $event);

    //  $tickt = new tables();
    //  $tickt->id('tickt_id');
    //  $tickt->addcolumn('buy_date', 'DATETIME',null,'NOT NULL DEFAULT CURRENT_TIMESTAMP');
    //  $tickt->int('user_id');
    //  $tickt->int('event_id');
    //  $tickt->addcolumn('id', 'binary(16)');
    //  Database::create('tickt', $tickt);
//----------------------------------------------------------------------------------------------------//

//------------------------------------------|| REFRESH ||---------------------------------------------//
//  Database::refresh();
//----------------------------------------------------------------------------------------------------//

//-------------------------------------------|| DROP ||-----------------------------------------------//
//  Database::drop('user');
//  Database::dropAll();
//---------------------------------------------------------------------------------------------------//
    