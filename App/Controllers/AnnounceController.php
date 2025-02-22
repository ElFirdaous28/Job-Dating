<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Announcement;
use App\Models\Company;
use Exception;
use Symfony\Component\VarDumper\VarDumper;

class AnnounceController extends Controller
{

    public function annoncements()
    {
        $categories = Announcement::select('job_category')->distinct()->get();
        $announncements = Announcement::all();
        $companies = Company::all();
        $this->view('admin/announcements', ['username' => $_SESSION['user_logged_in_name'], 'announcements' => $announncements, "companies" => $companies, "categories" => $categories]);
    }

    public function trashedAnnoncements()
    {
        $announncements = Announcement::all();
        $companies = Company::all();
        $this->view('admin/TrashedAnnouncements', ['username' => $_SESSION['user_logged_in_name'], 'announcements' => $announncements, "companies" => $companies]);
    }

    public function create()
    {
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

        // Default image path in case no image is uploaded
        $imagePath = null;

        // Handle Image Upload
        if (isset($_FILES["an-image"]) && $_FILES["an-image"]["error"] === UPLOAD_ERR_OK) {
            $imageTmp = $_FILES["an-image"]["tmp_name"];
            $imageName = time() . "_" . basename($_FILES["an-image"]["name"]); // Unique name
            $uploadDir = __DIR__ . "/../../public/uploads/";
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
        }

        try {
            Announcement::create([
                'title' => $title,
                'description' => $desc,
                'job_category' => $category,
                'company_id' => $company,
                'image_path' => $imagePath
            ]);

            echo json_encode(["success" => true, "message" => "Announcement created successfully"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
        }

        exit;
    }
    public function updateAnnounce()
    {
        if (!isset($_SESSION["csrf_token"]) || $_SESSION["csrf_token"] !== $_POST["csrf_token"]) {
            echo json_encode(["success" => false, "message" => "Invalid CSRF token"]);
            exit;
        }

        $title = $_POST["an-title"] ?? '';
        $desc = $_POST["an-desc"] ?? '';
        $category = $_POST["an-category"] ?? '';
        $company = $_POST["an-company"] ?? '';
        $id = $_POST["an-id"] ?? '';

        if (empty($title) || empty($desc) || empty($category) || empty($company)) {
            echo json_encode(["success" => false, "message" => "All fields are required"]);
            exit;
        }

        try {
            $announcement = Announcement::find($id);
            if (!$announcement) {
                echo json_encode(["success" => false, "message" => "Announcement not found"]);
                exit;
            }

            $announcement->title = $title;
            $announcement->description = $desc;
            $announcement->job_category = $category;
            $announcement->company_id = $company;
            $announcement->updated_at = time();


            // Handle Image Upload
            if (isset($_FILES["an-image"]) && $_FILES["an-image"]["error"] === UPLOAD_ERR_OK) {
                $imageTmp = $_FILES["an-image"]["tmp_name"];
                $imageName = time() . "_" . basename($_FILES["an-image"]["name"]);
                $uploadDir = __DIR__ . "/../../public/uploads/";
                $imagePath = "/uploads/" . $imageName;

                // Create directory if it does not exist
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Delete old image if it exists
                if ($announcement->image_path) {
                    $oldImagePath = __DIR__ . "/../../public" . $announcement->image_path;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Move the new uploaded file
                if (!move_uploaded_file($imageTmp, $uploadDir . $imageName)) {
                    echo json_encode(["success" => false, "message" => "Failed to upload image"]);
                    exit;
                }

                $announcement->image_path = $imagePath;
            }

            $announcement->save();

            echo json_encode(["success" => true, "message" => "Announcement updated successfully"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
        }

        exit;
    }

    public function getAnnouncements()
    {
        $announcements = Announcement::with('company')->get();
        $role = $_SESSION['user_logged_in_role'] ?? 'student';

        // Send a structured JSON response
        echo json_encode([
            'announcements' => $announcements,
            'role' => $role
        ]);
    }


    public function getDeletedAnnouncements()
    {
        $announcements = Announcement::onlyTrashed()->with('company')->get();
        $role = $_SESSION['user_logged_in_role'] ?? 'student';

        // Send a structured JSON response
        echo json_encode([
            'announcements' => $announcements,
            'role' => $role
        ]);
    }

    public function getSearchedAnnouncements()
    {
        $searchTerm = $_GET['search'] ?? '';
        $role = $_SESSION['user_logged_in_role'] ?? 'student';
        $announcements = Announcement::with('company')
            ->where('title', 'ILIKE', '%' . $searchTerm . '%')
            ->get();

        echo json_encode([
            'announcements' => $announcements,
            'role' => $role
        ]);
    }
    public function getFilteredAnnouncements()
    {
        $category = $_GET['filter'] ?? '';
        $role = $_SESSION['user_logged_in_role'] ?? 'student';
        $announcements = Announcement::with('company')
            ->where('job_category', 'ILIKE', '%' . $category . '%')
            ->get();

        echo json_encode([
            "category" => $category,
            'announcements' => $announcements,
            'role' => $role
        ]);
    }

    public function permanentlyDeleteAnnouncement($id)
    {
        $announcement = Announcement::withTrashed()->find($id);
        if ($announcement) {
            $announcement->forceDelete();
        }
    }
    

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::find($id);

        if ($announcement) {
            $announcement->delete();
        }
    }
    public function restoreAnnouncement($id)
    {
        $announcement = Announcement::withTrashed()->find($id);

        if ($announcement) {
            // Restore the announcement
            $announcement->restore();
        }
    }
    // get data to put in edit form
    public function getEditAnnounce($id)
    {
        try {
            $announce = Announcement::find($id);
            if (!$announce) {
                echo json_encode(["success" => false, "message" => "announce not found"]);
                exit;
            }

            echo json_encode(["success" => true, "announce" => $announce]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
        }

        exit;
    }
}
