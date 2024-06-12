<?php

namespace gift\appli\Infrastructure;

use Illuminate\Database\Capsule\Manager as DB;

class Eloquent{

function init(String $conf) {
    $db = new DB();
    $db -> addConnection(parse_ini_file($conf));
    $db->setAsGlobal();
    $db->bootEloquent();
}

}