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
    ],

    'student' => [
        '/student/home',
    ],
];
