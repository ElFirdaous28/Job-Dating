{% extends 'templates/baseTemplate.html' %}

{% block title %}Admin Companies{% endblock %}

{% block content %}

<!-- Modal toggle -->
<div class="container mx-auto p-6">
    <div class="flex justify-end mb-5">
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="px-5 py-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 
            font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Add Company
        </button>
    </div>

    <div class="flex flex-col items-center py-12 px-4">
        <!-- Search Bar -->
        <div class="relative w-full max-w-3xl">
            <input type="text" id="search_text" placeholder="Search for a company..."
                class="w-full p-4 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-lg placeholder-gray-500 transition duration-200 ease-in-out">
            <div id="result" class="absolute w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                <!-- Search results will appear here -->
            </div>
        </div>
    </div>

    <div id="companies-div" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Companies will appear here -->
    </div>
</div>

<!-- Add Company Modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md bg-white rounded-lg shadow-sm dark:bg-gray-700">
        <!-- Modal Header -->
        <div class="flex justify-between p-4 border-b dark:border-gray-600 border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add New Company</h3>
            <button type="button" data-modal-toggle="crud-modal"
                class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2 dark:hover:bg-gray-600 dark:hover:text-white">
                ✖
            </button>
        </div>
        <!-- Modal Body -->
        <form id="addCompany" class="p-4">
            {{ csrf() }}
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company Name</label>
                    <input type="text" name="company_name" id="company_name" required
                        class="w-full p-2.5 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full p-2.5 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                    <input type="text" name="phone" id="phone"
                        class="w-full p-2.5 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                </div>
                <div class="col-span-2">
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Website</label>
                    <input type="url" name="website" id="website"
                        class="w-full p-2.5 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                </div>
                <div class="col-span-2">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Image</label>
                    <input type="file" name="company_image" id="image" accept="image/*"
                        class="w-full p-1 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                </div>
                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full p-2.5 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white"></textarea>
                </div>
            </div>
            <div class="text-center">
                <button type="submit"
                    class="px-5 py-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Company
                </button>
            </div>
        </form>
    </div>
</div>

<script src="/assets/js/addCompany.js"></script>
<script src="/assets/js/company.js"></script>
<script src="/assets/js/editCompany.js"></script>

{% endblock %}