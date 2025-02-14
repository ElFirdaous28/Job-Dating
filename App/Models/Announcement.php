<?php

namespace App\Models;

use App\Core\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;

    protected $table = 'announcements';
    protected $fillable = ['title', 'description', 'job_category', 'company_id', 'image_path'];

    // Define the relationship with the Company model     
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
