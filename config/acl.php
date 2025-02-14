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
        '/admin/companies/get/{id}',
        '/admin/companies/edit',
        '/getCompany',
        '/admin/announcements/edit',
        '/deleteAnnouncement/{id}',
        '/permanentlyDeleteAnnouncement/{id}',
        '/admin/announcements/trashed',
        '/getDeletedAnnouncements',
        '/restoreAnnouncement/{id}',
        '/deleteCompany/{id}',
        '/admin/announces/get/{id}',
        '/getSearchedCompanies',
    ],

    'student' => [
        '/student/home',
    ],
];
