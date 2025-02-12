<?php

namespace App\Models;

use App\Core\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = ["company_name", "description", "email", "phone", "website"];


}
