<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Announcements;
use App\Models\Company;
use Exception;

class AnnounceController extends Controller {

   
    public function annoncements() {
        $announncements = Announcements::all();
        $companies = Company::all();
        $this -> view('admin/announcements', ['username'=>$_SESSION['user_logged_in_name'], 'announcements' => $announncements, "companies"=>$companies]);

    }

 
    public function create() {
    
    
        if (!isset($_SESSION["csrf_token"]) || $_SESSION["csrf_token"] !== $_POST["csrf_token"]) {
            echo json_encode(["success" => false, "message" => "Invalid CSRF token"]);
            exit;
        }
    
        $title = $_POST["an-title"] ?? '';
        $desc = $_POST["an-desc"] ?? '';
        $category = $_POST["an-category"] ?? '';
        $company = $_POST["an-company"] ?? '';
    
        if (empty($title) || empty($desc) || empty($category) || empty($company)) {
            echo json_encode(["success" => false, "message" => "All fields are required"]);
            exit;
        }
    
        // Handle Image Upload
        if (isset($_FILES["an-image"]) && $_FILES["an-image"]["error"] === UPLOAD_ERR_OK) {
            $imageTmp = $_FILES["an-image"]["tmp_name"];
            $imageName = time() . "_" . basename($_FILES["an-image"]["name"]); // Unique name
            $uploadDir = __DIR__ . "/../../public/uploads/"; // Change this to your upload directory
            $imagePath = "/uploads/" . $imageName;
    
            // Create directory if not exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
    
            // Move file
            if (!move_uploaded_file($imageTmp, $uploadDir . $imageName)) {
                echo json_encode(["success" => false, "message" => "Failed to upload image"]);
                exit;
            }
        } else {
            $imagePath = null; // No image uploaded
        }
    
        try {
            Announcements::create([
                'title' => $title,
                'description' => $desc,
                'job_category' => $category,
                'company_id' => $company,
                'image' => $imagePath // Save image path in database
            ]);
    
            echo json_encode(["success" => true, "message" => "Announcement created successfully"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
        }
    
        exit;
    }
    

   
}