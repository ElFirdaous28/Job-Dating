<?php

namespace App\Models;

use App\Core\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = ["title", "description", "job_category", "company_id"];
}
