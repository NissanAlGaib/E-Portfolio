<div class="w-full h-full overflow-y-auto">
    <section class="max-w-7xl mx-auto p-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <a href="?page=admin" class="text-gray-400 hover:text-white mb-2 inline-block">← Back to Dashboard</a>
                <h1 class="text-5xl font-black text-white">Manage Skills</h1>
            </div>
            <button onclick="openSkillModal()" class="bg-gradient-to-r from-blue-start to-purple-end text-white font-bold px-6 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
                + Add Skill
            </button>
        </div>

        <div id="skillsList" class="space-y-4">
            <p class="text-gray-400 text-center">Loading skills...</p>
        </div>

        <!-- Add Skill Modal -->
        <div id="skillModal" class="hidden fixed inset-0 bg-dark-bg bg-opacity-75 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-glass border border-gray-700 p-8 rounded-2xl w-full max-w-2xl shadow-lg">
                <h2 class="text-3xl font-bold text-white mb-6">Add Skill</h2>
                <form id="addSkillForm" class="space-y-4" enctype="multipart/form-data" onsubmit="return false;">
                    <input type="hidden" name="user_id" value="1" />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Skill Name *</label>
                            <input type="text" name="skill_name" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Skill Type *</label>
                            <select name="skill_type" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                                <option value="technical">Technical</option>
                                <option value="soft">Soft Skill</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                            <input type="text" name="category" placeholder="e.g., Programming, Design" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Proficiency (0-100) *</label>
                            <input type="number" name="proficiency" min="0" max="100" value="50" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Years of Experience</label>
                            <input type="number" name="years_experience" step="0.1" min="0" placeholder="2.5" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Icon Image</label>
                            <input type="file" name="icon" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-start file:text-white hover:file:bg-purple-end">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                            <textarea name="description" rows="3" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <button type="button" onclick="closeSkillModal()" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-start to-purple-end text-white rounded-lg hover:opacity-90 transition-opacity">Add Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>