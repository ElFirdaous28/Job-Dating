<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Announcements;
use App\Models\Company;
use Exception;

class AnnounceCont extends Controller {

   
    public function annoncements() {
        $announncements = Announcements::all();
        $companies = Company::all();
        $this -> view('admin/announcements', ['username'=>$_SESSION['user_logged_in_name'], 'announcements' => $announncements, "companies"=>$companies]);

    }

 
    public function create() {
        
            if (!isset($_SESSION["csrf_token"]) || $_SESSION["csrf_token"] !== $_GET["csrf_token"]) {
                echo json_encode(["success" => false, "message" => "Invalid CSRF token"]);
                exit;
            }
            $title = $_GET["an-title"] ?? '';
            $desc = $_GET["an-desc"] ?? '';
            $category = $_GET["an-category"] ?? '';
            $company = $_GET["an-company"] ?? '';
        
            if (empty($title) || empty($desc) || empty($category) || empty($company)) {
                echo json_encode(["success" => false, "message" => "All fields are required"]);
                exit;
            }
        
            try {
                Announcements::create([
                    'title' => $title,
                    'description' => $desc,
                    'job_category' => $category,
                    'company_id' => $company,
                ]);
        
                echo json_encode(["success" => true, "message" => "Announcement created successfully"]);
            } catch (Exception $e) {
                echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
            }
        
            exit;
        
    }

   
}