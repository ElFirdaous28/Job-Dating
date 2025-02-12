<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Model\Announcement;
use App\Models\Announcement as ModelsAnnouncement;

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
        $announcements=ModelsAnnouncement::all();
        // var_dump($announcements);die();
        $this->view('User/UserHome',['username'=>$_SESSION['user_logged_in_name'],"announcements"=> $announcements]);
    }
    

}
