{% extends 'templates/studentTemplate.html' %}

{% block title %}User home{% endblock %}

{% block content %}
<div class="flex flex-col">
    <h1 class="text-3xl">This is the <span class="text-red-500">User's</span> home</h1>

    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                <div class="relative h-48 overflow-hidden">
                    <div class="absolute top-4 left-4 z-10">
                        <span class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium">
                            Online Business
                        </span>
                    </div>
                    <img 
                        src="/api/placeholder/400/300"
                        alt="Online Business"
                        class="w-full h-full object-cover"
                    />
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
                        Free advertising for your online business
                    </h3>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center mr-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Musharof Chy</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>25 Dec, 2025</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                <div class="relative h-48 overflow-hidden">
                    <div class="absolute top-4 left-4 z-10">
                        <span class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium">
                            UI/UX Design
                        </span>
                    </div>
                    <img 
                        src="/api/placeholder/400/300"
                        alt="UI/UX Design"
                        class="w-full h-full object-cover"
                    />
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
                        9 simple ways to improve your design skills
                    </h3>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center mr-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Musharof Chy</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>19 Mar, 2025</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                <div class="relative h-48 overflow-hidden">
                    <div class="absolute top-4 left-4 z-10">
                        <span class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium">
                            Web Development
                        </span>
                    </div>
                    <img 
                        src="/api/placeholder/400/300"
                        alt="Web Development"
                        class="w-full h-full object-cover"
                    />
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
                        Tips to quickly improve your coding speed
                    </h3>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center mr-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Musharof Chy</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>15 Feb, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}