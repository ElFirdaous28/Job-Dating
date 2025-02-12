<?php
return [
    'common' => [
        '/',
        '/logout',
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
