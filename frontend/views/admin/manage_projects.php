<div class="w-full h-full overflow-y-auto">
    <section class="max-w-7xl mx-auto p-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <a href="#" data-page="admin/dashboard.php" class="ajax-link text-gray-400 hover:text-white mb-2 inline-block">← Back to Dashboard</a>
                <h1 class="text-5xl font-black text-white">Manage Projects</h1>
            </div>
            <button onclick="openProjectModal()" class="bg-gradient-to-r from-blue-start to-purple-end text-white font-bold px-6 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
                + Add Project
            </button>
        </div>

        <div id="projectsList" class="space-y-4">
            <p class="text-gray-400 text-center">Loading projects...</p>
        </div>

        <!-- Add/Edit Project Modal -->
        <div id="projectModal" class="hidden fixed inset-0 bg-dark-bg bg-opacity-75 backdrop-blur-sm flex items-center justify-center z-50 overflow-y-auto">
            <div class="bg-glass border border-gray-700 p-8 rounded-2xl w-full max-w-2xl shadow-lg my-8">
                <h2 class="text-3xl font-bold text-white mb-6">Add Project</h2>
                <form id="addProjectForm" class="space-y-4" enctype="multipart/form-data" onsubmit="return false;">
                    <input type="hidden" name="user_id" value="1" />
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Project Title *</label>
                            <input type="text" name="title" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Description *</label>
                            <textarea name="description" required rows="4" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white"></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Project URL</label>
                            <input type="url" name="project_url" placeholder="https://" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">GitHub URL</label>
                            <input type="url" name="github_url" placeholder="https://github.com/..." class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Demo URL</label>
                            <input type="url" name="demo_url" placeholder="https://" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Tags</label>
                            <input type="text" name="tags" placeholder="React, Node.js, MongoDB" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                            <small class="text-gray-500">Comma-separated</small>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Start Date</label>
                            <input type="date" name="start_date" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">End Date</label>
                            <input type="date" name="end_date" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                            <select name="status" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                                <option value="completed">Completed</option>
                                <option value="in_progress">In Progress</option>
                                <option value="on_hold">On Hold</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Featured</label>
                            <select name="featured" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Project Image Preview</label>
                            <input type="file" name="image_preview" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-start file:text-white hover:file:bg-purple-end">
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-4 pt-4">
                        <button type="button" onclick="closeProjectModal()" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-start to-purple-end text-white rounded-lg hover:opacity-90 transition-opacity">Add Project</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="../../src/js/admin/ManageProjects.js"></script>
    <script>
      loadProjectsAdmin();
    </script>
</div>
