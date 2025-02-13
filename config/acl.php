<?php
return [
    'common' => [
        '/',
        '/logout',
        '/getAnnouncements',
        '/getSearchedAnnouncements',
    
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
        '/admin/companies/add_company',
        '/getCompany',
    ],

    'student' => [
        '/student/home',
    ],
];