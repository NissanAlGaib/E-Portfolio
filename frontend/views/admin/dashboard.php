<div class="w-full h-full overflow-y-auto">
    <section class="max-w-7xl mx-auto p-12">
        <h1 class="text-5xl font-black text-white mb-8 text-center">Admin Dashboard</h1>
        <p class="text-gray-300 text-center mb-12">Manage your portfolio content</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Projects Management -->
            <a href="?page=admin-projects" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Projects</h3>
                </div>
                <p class="text-gray-400">Add and manage your projects with descriptions, links, and images</p>
            </a>

            <!-- Skills Management -->
            <a href="?page=admin-skills" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Skills</h3>
                </div>
                <p class="text-gray-400">Manage your technical and soft skills with proficiency levels</p>
            </a>

            <!-- Hobbies Management -->
            <a href="?page=hobbies" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Hobbies</h3>
                </div>
                <p class="text-gray-400">Add hobbies with proficiency levels and categories</p>
            </a>

            <!-- Achievements Management -->
            <a href="?page=admin-achievements" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Achievements</h3>
                </div>
                <p class="text-gray-400">Document your school achievements and accomplishments</p>
            </a>

            <!-- Education Management -->
            <a href="?page=admin-education" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Education</h3>
                </div>
                <p class="text-gray-400">Manage your educational background</p>
            </a>

            <!-- Contact Messages -->
            <a href="#" data-page="admin/manage_contacts.php" class="ajax-link bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Contact Messages</h3>
                </div>
                <p class="text-gray-400">View and manage contact form submissions</p>
            </a>
        </div>
    </section>
</div>