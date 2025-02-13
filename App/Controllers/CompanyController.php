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

            $rules = [
                'company_name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'phone' => 'required|numeric|min:10|max:17',
                'website' => 'required|url',
                'description' => 'required'
            ];

            $data = [
                'company_name' => $company_name,
                'email' => $email,
                'phone' => $phone,
                'website' => $website,
                'description' => $description

            ];

            $errors = Validator::validate($data, $rules);
            if (!empty($errors)) {
                echo json_encode(["success" => false, "message" => $errors]);
                exit;
            } else {
                if (Company::where('company_name', $company_name)->exists()) {
                    Session::set('errors', ['createCompanyError' => 'This company name is already registered!']);
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                }

            }
            try {
                Company::create([
                    'company_name' => $company_name,
                    'email' => $email,
                    'phone' => $phone,
                    'website' => $website,
                    'description' => $description
                ]);
    
                echo json_encode(["success" => true, "message" => "Company created successfully"]);
            } catch (Exception $e) {
                echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
            }
    
            exit;
            
        }
    }

    public function update($id, $data)
    {
        $company = Company::find($id);
        if ($company) {
            $company->update($data);
            return $company;
        }
        return null;
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
}
