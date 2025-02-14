<?php
return [
    'common' => [
        '/',
        '/logout',
        '/getAnnouncements',
        '/getSearchedAnnouncements',
        '/getFilteredAnnouncements',
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
        '/admin/announcements/edit',
        '/deleteAnnouncement/{id}',
        '/admin/announcements/trashed',
        '/getDeletedAnnouncements',
        '/restoreAnnouncement/{id}',
        '/deleteCompany/{id}',
        '/getSearchedCompanies',
    ],

    'student' => [
        '/student/home',
    ],
];
