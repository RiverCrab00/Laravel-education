<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table='student';
    protected $primaryKey='stu_id';
    protected $fillable = ['std_name','std_password','std_phone','std_email','std_sex','std_desc','std_birthday','std_pic','qq_id'];
}
