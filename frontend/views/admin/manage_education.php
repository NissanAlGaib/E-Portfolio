<?php $page_title = 'Manage Education'; include '_header.php'; ?>
    <section class="max-w-7xl mx-auto p-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <a href="dashboard.php" class="text-gray-400 hover:text-white mb-2 inline-block">← Back to Dashboard</a>
                <h1 class="text-5xl font-black text-white">Manage Education</h1>
            </div>
            <button onclick="openEducationModal()" class="bg-gradient-to-r from-blue-start to-purple-end text-white font-bold px-6 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
                + Add Education
            </button>
        </div>

        <div id="educationList" class="space-y-4">
            <p class="text-gray-400 text-center">Loading education...</p>
        </div>

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
    </section>

    <script src="../../src/js/admin/ManageEducation.js"></script>
    <script>
      loadEducationAdmin();
    </script>
<?php include '_footer.php'; ?>