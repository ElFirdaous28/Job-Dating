<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Announcements;

class AnnounceCont extends Controller {

   
    public function index() {
        $announncements = Announcements::all();
        $this -> view('admin/announcements', ['username'=>$_SESSION['user_logged_in_name'], 'announcements' => $announncements]);

    }

 
    public function create() {

        Announcements::create([
            'title' => 'New Announcement 2',
            'description' => 'This is a new announcement 2',
            'location' => 'Cairo - Egypt',
            'job_requirments' => 'PHP, Laravel, MySQL, HTML, CSS, JS',
            'company_id' => 5,
        ]);
        echo 'Announcement created successfully';

    }

   
}