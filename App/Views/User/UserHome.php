{% extends 'templates/studentTemplate.html' %}

{% block title %}User home{% endblock %}

{% block content %}
<div class="flex flex-col">
    <h1 class="text-3xl">This is the <span class="text-red-500">User's</span> home</h1>

    <div class="container mx-auto">
        <div id="announcement-div" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- announcement will appear here -->
        </div>
    </div>
</div>


<script src="/assets/js/announcement.js"></script>

{% endblock %}