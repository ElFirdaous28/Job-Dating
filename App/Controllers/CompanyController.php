<?php

use App\Core\Controller;

class CompanyController extends Controller {

    // public function index() {
    //     $companies= Company::all();
    //     $this->view('companies', ['companies' => $companies]);
    // }

    public function create($data) {
        return Company::create($data);
    }

    public function update($id, $data) {
        $company = Company::find($id);
        if ($company) {
            $company->update($data);
            return $company;
        }
        return null;
    }

    public function delete($id) {
        $company = Company::find($id);
        if ($company) {
            $company->delete();
            return true;
        }
        return false;
    }
}
