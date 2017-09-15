<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
class Manager extends Authenticable
{
    protected $table='manager';

}
