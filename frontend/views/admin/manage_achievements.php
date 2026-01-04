<?php $page_title = 'Manage Achievements'; include '_header.php'; ?>
    <section class="max-w-7xl mx-auto p-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <a href="dashboard.php" class="text-gray-400 hover:text-white mb-2 inline-block">← Back to Dashboard</a>
                <h1 class="text-5xl font-black text-white">Manage Achievements</h1>
            </div>
            <button onclick="openAchievementModal()" class="bg-gradient-to-r from-blue-start to-purple-end text-white font-bold px-6 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
                + Add Achievement
            </button>
        </div>

        <div id="achievementsList" class="space-y-4">
            <p class="text-gray-400 text-center">Loading achievements...</p>
        </div>

        <!-- Add Achievement Modal -->
        <div id="achievementModal" class="hidden fixed inset-0 bg-dark-bg bg-opacity-75 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-glass border border-gray-700 p-8 rounded-2xl w-full max-w-2xl shadow-lg">
                <h2 class="text-3xl font-bold text-white mb-6">Add Achievement</h2>
                <form id="addAchievementForm" class="space-y-4" enctype="multipart/form-data" onsubmit="return false;">
                    <input type="hidden" name="user_id" value="1" />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Achievement Title *</label>
                            <input type="text" name="title" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                            <input type="text" name="category" placeholder="e.g., Academic, Sports" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Issuer</label>
                            <input type="text" name="issuer" placeholder="Who awarded this" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Date Achieved</label>
                            <input type="date" name="date_achieved" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Display Order</label>
                            <input type="number" name="display_order" value="0" min="0" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                            <textarea name="description" rows="3" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Achievement Image</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-start file:text-white hover:file:bg-purple-end">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <button type="button" onclick="closeAchievementModal()" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-start to-purple-end text-white rounded-lg hover:opacity-90 transition-opacity">Add Achievement</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="../../src/js/admin/ManageAchievements.js"></script>
    <script>
      loadAchievementsAdmin();
    </script>
<?php include '_footer.php'; ?>