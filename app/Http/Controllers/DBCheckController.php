<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DBCheckController extends Controller
{
    public function index($database_hostname, $database_name, $database_username, $database_password)
    {
        $connection = @mysqli_connect($database_hostname, $database_username, $database_password, $database_name);
        if (!$connection) {
            $res = 'fail';
        } else {
            $res = 'success';
        }

        return $res;
    }
}
