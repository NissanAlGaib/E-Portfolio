<?php $page_title = 'Manage Education';
include '_header.php'; ?>
<section class="max-w-7xl mx-auto p-12">
    <div class="flex justify-between items-center mb-8">
        <div>
            <a href="/E-Portfolio/E-Portfolio/frontend/index.php?page=admin" class="text-gray-400 hover:text-white mb-2 inline-block">← Back to Dashboard</a>
            <h1 class="text-5xl font-black text-white">Manage Education</h1>
        </div>
        <button onclick="openEducationModal()" class="bg-gradient-to-r from-blue-start to-purple-end text-white font-bold px-6 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
            + Add Education
        </button>
    </div>

    <!-- Search and Filter Container -->
    <div id="searchFilterContainer"></div>

    <!-- Education List -->
    <div id="educationList" class="space-y-4">
        <p class="text-gray-400 text-center">Loading education...</p>
    </div>

    <!-- Pagination Container -->
    <div id="educationPagination"></div>

    <!-- Add Education Modal -->
    <div id="educationModal" class="hidden fixed inset-0 bg-dark-bg bg-opacity-75 backdrop-blur-sm flex items-center justify-center z-50 overflow-y-auto">
        <div class="bg-glass border border-gray-700 p-8 rounded-2xl w-full max-w-2xl shadow-lg my-8">
            <h2 class="text-3xl font-bold text-white mb-6">Add Education</h2>
            <form id="addEducationForm" class="space-y-4" enctype="multipart/form-data" onsubmit="return false;">
                <input type="hidden" name="user_id" value="1" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-1">Institution Name *</label>
                        <input type="text" name="institution_name" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Degree *</label>
                        <input type="text" name="degree" required placeholder="e.g., Bachelor of Science" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Field of Study</label>
                        <input type="text" name="field_of_study" placeholder="e.g., Computer Science" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Location</label>
                        <input type="text" name="location" placeholder="City, Country" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">GPA</label>
                        <input type="number" name="gpa" step="0.01" min="0" max="4" placeholder="3.75" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Start Date</label>
                        <input type="date" name="start_date" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">End Date</label>
                        <input type="date" name="end_date" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        <small class="text-gray-500">Leave blank if currently studying</small>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea name="description" rows="3" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-1">Institution Logo</label>
                        <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-start file:text-white hover:file:bg-purple-end">
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" onclick="closeEducationModal()" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-start to-purple-end text-white rounded-lg hover:opacity-90 transition-opacity">Add Education</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Education Modal -->
    <div id="editEducationModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 overflow-y-auto">
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-2xl p-6 max-w-2xl w-full mx-4 my-8">
            <h2 class="text-2xl font-bold text-white mb-4">Edit Education</h2>
            <form id="edit-education-form" class="space-y-4">
                <input type="hidden" id="edit-education-id">
                <input type="hidden" id="edit-education-user-id" value="1">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-gray-300 mb-2">Institution Name</label>
                        <input type="text" id="edit-education-institution" required class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-300 mb-2">Degree</label>
                        <input type="text" id="edit-education-degree" required class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-300 mb-2">Field of Study</label>
                        <input type="text" id="edit-education-field" class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-300 mb-2">Location</label>
                        <input type="text" id="edit-education-location" class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-300 mb-2">GPA</label>
                        <input type="number" id="edit-education-gpa" step="0.01" min="0" max="4" class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-300 mb-2">Start Date</label>
                        <input type="date" id="edit-education-start-date" class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-300 mb-2">End Date</label>
                        <input type="date" id="edit-education-end-date" class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-300 mb-2">Description</label>
                        <textarea id="edit-education-description" rows="3" class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"></textarea>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeEditEducationModal()" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">Cancel</button>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:opacity-90 transition">Update Education</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="/E-Portfolio/E-Portfolio/frontend/src/js/admin/ManageEducation.js"></script>
<script>
    loadEducationAdmin();
</script>
<?php include '_footer.php'; ?>