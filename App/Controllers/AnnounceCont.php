<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Announcements;
use App\Models\Company;

class AnnounceCont extends Controller {

   
    public function index() {
        $announncements = Announcements::all();
        $companies = Company::all();
        $this -> view('admin/announcements', ['username'=>$_SESSION['user_logged_in_name'], 'announcements' => $announncements, "companies"=>$companies]);

    }

 
    public function create() {
        if (isset($_GET["add-ann"])){
            $title = $_GET["an-title"];
            $desc = $_GET["an-desc"];
            $category = $_GET["an-category"];
            $company = $_GET["an-company"];
            Announcements::create([
                'title' => $title,
                'description' => $desc,
                'job_category' => $category,
                'company_id' => $company,
            ]);
            echo 'Announcement created successfully';die;
        }
        

    }

   
}