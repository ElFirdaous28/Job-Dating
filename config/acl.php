<?php
return [
    'common' => [
        '/',
        '/logout',
        '/getAnnouncements',
    
    ],

    'guest' => [
        '/register',
        '/login',
        '/handleLogin',
        '/handleRegister',
    ],

    'admin' => [
        '/admin/home',
        '/admin/announcements',
        '/admin/announcements/add',
        "/admin/companies",
        '/admin/add_company',
        '/getCompany',
    ],

    'student' => [
        '/student/home',
    ],
];