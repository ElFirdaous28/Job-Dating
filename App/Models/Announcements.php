<?php

namespace App\Models;

use App\Core\Model;

class Announcements extends Model
{
    protected $table = 'announcements';
    protected $fillable = ['title', 'description', 'job_category', 'admin_id',"company_id"];
}
