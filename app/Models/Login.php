<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Login extends Model
{
    protected  $connection = 'mysql';
    protected  $table = 'user';
}
