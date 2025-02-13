{% extends 'templates/studentTemplate.html' %}

{% block title %}User home{% endblock %}

{% block content %}
<div class="flex flex-col">
    <!-- Barre de recherche -->
    <div class="container mx-auto mt-10 px-4">
        <h2 class="text-4xl font-bold text-gray-900 mb-8">Rechercher des entreprises</h2>
        <div class="flex flex-col">

            <div class="relative w-full max-w-2xl mx-auto">
                <input type="text" id="search_text"
                    class="w-full p-4 border-2 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-lg placeholder-gray-500 transition duration-200 ease-in-out"
                    placeholder="Rechercher une entreprise ou une annonce...">

                <div id="result" class="absolute w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                    <!-- Les résultats de la recherche apparaîtront ici -->
                </div>
            </div>
            <div class="mt-6">
                <label for="filter-company" class="block text-xl font-medium text-gray-700 mb-3">Filtrer par entreprise</label>
                <select id="filter-company"
                    class="w-full p-4 border-2 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-lg transition duration-200 ease-in-out">
                    <option value="">Sélectionner une catégorie</option>
                    {% for category in categories %}
                    <option value="{{ category['job_category'] }}">{{ category["job_category"] }}</option>
                    {% endfor %}

                </select>
            </div>
        </div>
    </div>

    <!-- Liste des annonces -->
    <div class="container mx-auto mt-8">
        <div id="announcement-div" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Les annonces apparaîtront ici -->
        </div>
    </div>
</div>

<script src="/assets/js/announcement.js"></script>

{% endblock %}