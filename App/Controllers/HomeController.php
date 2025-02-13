<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Announcement;

class HomeController extends Controller
{
    public function welcome()
    {
        $this->view('welcome', ['title' => 'Welcome Page', 'message' => 'Hello, Framework!']);
    }

    public function adminHome()
    {
        $this->view('Admin/AdminHome',['username'=>$_SESSION['user_logged_in_name']]);
    }
    public function userHome()
    {
        $categories = Announcement::select('job_category')->distinct()->get();
        $this->view('User/UserHome',['username'=>$_SESSION['user_logged_in_name'],"categories"=> $categories]);
    }

}
