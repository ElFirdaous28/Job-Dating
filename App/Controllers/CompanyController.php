<?php

namespace App\Controllers;

use App\Core\Session;
use App\Models\Company;
use App\Core\Controller;
use App\Core\Security;
use App\Core\Validator;
use Exception;

class CompanyController extends Controller
{

    public function index()
    {
        $this->view('Admin/Companies');
    }

    public function createCompany()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $company_name = $_POST["company_name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $website = $_POST["website"];
            $description = $_POST["description"];

            $imagePath = null;

            if (isset($_FILES["company_image"]) && $_FILES["company_image"]["error"] === UPLOAD_ERR_OK) {
                $imageTmp = $_FILES["company_image"]["tmp_name"];
                $imageName = time() . "_" . basename($_FILES["company_image"]["name"]);
                $uploadDir = __DIR__ . "/../../public/uploads/";
                $imagePath = "/uploads/" . $imageName;
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                if (!move_uploaded_file($imageTmp, $uploadDir . $imageName)) {
                    echo json_encode(["success" => false, "message" => "Failed to upload image"]);
                    exit;
                }
            }

            $rules = [
                'company_name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'phone' => 'required|numeric|min:10|max:17',
                'website' => 'required|url',
                'description' => 'required',
                'image_path' => 'required'
            ];

            $data = [
                'company_name' => $company_name,
                'email' => $email,
                'phone' => $phone,
                'website' => $website,
                'description' => $description,
                'image_path' => $imagePath
            ];

            $errors = Validator::validate($data, $rules);
            if (!empty($errors)) {
                echo json_encode(["success" => false, "message" => $errors]);
                exit;
            } 
            else {
                if (Company::where('company_name', $company_name)->exists()) {
                    $errors = "This company name is already registered!";
                    echo json_encode(["success" => false, "message" => $errors]);
                    exit;
                }
            }
            try {
                Company::create([
                    'company_name' => $company_name,
                    'email' => $email,
                    'phone' => $phone,
                    'website' => $website,
                    'description' => $description,
                    'image_path' => $imagePath
                ]);

                echo json_encode(["success" => true, "message" => "Company created successfully"]);
            } catch (Exception $e) {
                echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
            }

            exit;
        }
    }


    public function getEditCompany($id) {
        try {
            $company = Company::find($id);
            if (!$company) {
                echo json_encode(["success" => false, "message" => "Company not found"]);
                exit;
            }
    
            echo json_encode(["success" => true, "company" => $company]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
        }
    
        exit;
    }
    

    public function updateCompany() {

        if (!isset($_SESSION["csrf_token"]) || $_SESSION["csrf_token"] !== $_POST["csrf_token"]) {
            echo json_encode(["success" => false, "message" => "Invalid CSRF token"]);
            exit;
        }
    
        $id = $_POST["company_id"];
        $name = $_POST["company_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $website = $_POST["website"];
        $description = $_POST["description"];

        if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($website) || empty($description)) {
            echo json_encode(["success" => false, "message" => "All fields are required"]);
            exit;
        }

        try {
            $company = Company::find($id);
            if (!$company) {
                echo json_encode(["success" => false, "message" => "Company not found"]);
                exit;
            }

            if (isset($_FILES["company_image"]) && $_FILES["company_image"]["error"] === UPLOAD_ERR_OK) {
                $imageTmp = $_FILES["company_image"]["tmp_name"];
                $imageName = time() . "_" . basename($_FILES["company_image"]["name"]);
                $uploadDir = __DIR__ . "/../../public/uploads/";
                $imagePath = "/uploads/" . $imageName;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (!empty($company->image_path)) {
                    $oldImagePath = __DIR__ . "/../../public" . $company->image_path;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                if (!move_uploaded_file($imageTmp, $uploadDir . $imageName)) {
                    echo json_encode(["success" => false, "message" => "Failed to upload image"]);
                    exit;
                }
    
                $company->image_path = $imagePath;
            }

            $company->company_name = $name;
            $company->email = $email;
            $company->phone = $phone;
            $company->website = $website;
            $company->description = $description;
            $company->updated_at = time();
    
            $company->save();
    
            echo json_encode(["success" => true, "message" => "Company updated successfully"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
        }
    
        exit;
    }
    
    

    public function delete($id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->delete();
            return true;
        }
        return false;
    }


    public function getCompany()
    {
        $companies = Company::all();
        $role = $_SESSION['user_logged_in_role'] ?? 'user'; // Ensure role is always set
        echo json_encode([
            'companies' => $companies,
            'role' => $role
        ]);
    }
    public function companiesPage()
    {
        $this->view('Admin/companies', ['username' => $_SESSION['user_logged_in_name']]);
    }

    public function deleteCompany($id)
    {
        $company = Company::find($id);

        if ($company) {
            $company->delete();
        }
    }
}