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
        '/admin/announcements/add',
    ],

    'student' => [
        '/student/home',
    ],
];
