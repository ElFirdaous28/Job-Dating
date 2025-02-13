{% extends 'templates/studentTemplate.html' %}

{% block title %}User home{% endblock %}

{% block content %}
<div class="flex flex-col items-center py-12 px-4 ">
    <!-- Barre de recherche -->
    <div class="container mx-auto mt-10 px-4">

    <div class="flex flex-row gap-6 items-center">
        <!-- Barre de recherche -->
        <div class="relative w-full max-w-3xl">
            <input type="text" id="search_text"
                class="w-full p-4 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-lg placeholder-gray-500 transition duration-200 ease-in-out"
                placeholder="Rechercher une annonce...">
            <div id="result" class="absolute w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                <!-- Résultats de la recherche -->
            </div>
        </div>
        <!-- Barre de filtrage -->
        <div class="w-full max-w-3xl">
            <select id="filter-company"
                class="w-full p-4 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-lg transition duration-200 ease-in-out">
                <option value="">Sélectionner une catégorie</option>
                {% for category in categories %}
                <option value="{{ category['job_category'] }}">{{ category["job_category"] }}</option>
                {% endfor %}
            </select>
        </div>
    </div>
</div>


    <!-- Liste des annonces -->
    <div class="container mx-auto mt-10">
        <div id="announcement-div" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Annonces chargées dynamiquement -->
        </div>
    </div>
</div>

<script src="/assets/js/announcement.js"></script>

{% endblock %}
