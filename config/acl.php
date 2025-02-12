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
        "/admin/companies",
        '/admin/add_company'
    ],

    'student' => [
        '/student/home',
    ],
];
