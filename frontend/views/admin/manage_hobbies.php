<?php $page_title = 'Manage Hobbies';
include '_header.php'; ?>
<div class="container mx-auto px-4 py-8">
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Manage Hobbies</h1>
            <p class="text-gray-400">Add, edit, or remove hobbies</p>
        </div>
        <button onclick="openAddHobbyModal()" class="bg-gradient-to-r from-blue-start to-purple-end text-white font-bold px-6 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
            + Add Hobby
        </button>
    </div>

    <!-- Back to Dashboard -->
    <a href="/E-Portfolio/E-Portfolio/frontend/index.php?page=admin" class="inline-block mb-6 px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition">
        ← Back to Dashboard
    </a>

    <!-- Search and Filter Container -->
    <div id="searchFilterContainer"></div>

    <!-- Hobbies List -->
    <div class="bg-dark-bg/50 backdrop-blur-sm rounded-lg p-6 border border-white/10">
        <h2 class="text-2xl font-bold text-white mb-4">Current Hobbies</h2>
        <div id="hobbies-admin-container" class="grid gap-4">
            <p class="text-gray-400 text-center py-8">Loading hobbies...</p>
        </div>
    </div>

    <!-- Pagination Container -->
    <div id="hobbiesPagination"></div>

    <!-- Add Hobby Modal -->
    <div id="addHobbyModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-2xl p-6 max-w-2xl w-full mx-4">
            <h2 class="text-2xl font-bold text-white mb-4">Add New Hobby</h2>
            <form id="add-hobby-form" onsubmit="handleAddHobby(event)" class="space-y-4" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="1">

                <div>
                    <label class="block text-gray-300 mb-2">Hobby Name</label>
                    <input
                        type="text"
                        name="hobby_name"
                        required
                        class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 mb-2">Description</label>
                    <textarea
                        name="description"
                        rows="4"
                        required
                        class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-gray-300 mb-2">Category (Optional)</label>
                    <input
                        type="text"
                        name="category"
                        placeholder="e.g., Sports, Creative, Reading"
                        class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 mb-2">Image</label>
                    <input
                        type="file"
                        name="icon"
                        accept="image/*"
                        class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button
                        type="button"
                        onclick="closeAddHobbyModal()"
                        class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:opacity-90 transition">
                        Add Hobby
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Hobby Modal -->
    <div id="editHobbyModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-2xl p-6 max-w-2xl w-full mx-4">
            <h2 class="text-2xl font-bold text-white mb-4">Edit Hobby</h2>
            <form id="edit-hobby-form" class="space-y-4">
                <input type="hidden" id="edit-hobby-id">
                <input type="hidden" id="edit-user-id" value="1">

                <div>
                    <label class="block text-gray-300 mb-2">Hobby Name</label>
                    <input
                        type="text"
                        id="edit-hobby-name"
                        required
                        class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 mb-2">Description</label>
                    <textarea
                        id="edit-hobby-description"
                        rows="4"
                        required
                        class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-gray-300 mb-2">Category (Optional)</label>
                    <input
                        type="text"
                        id="edit-hobby-category"
                        placeholder="e.g., Sports, Creative, Reading"
                        class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 mb-2">Current Icon</label>
                    <img id="edit-hobby-icon-preview" src="" alt="Hobby icon" class="w-16 h-16 object-cover rounded-lg mb-2">
                    <label class="block text-gray-300 mb-2">Change Icon (Optional)</label>
                    <input
                        type="file"
                        id="edit-hobby-icon"
                        accept="image/*"
                        class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:opacity-90 transition">
                        Update Hobby
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/E-Portfolio/E-Portfolio/frontend/src/js/admin/ManageHobbies.js"></script>
<script>
    loadHobbiesAdmin();
</script>
<?php include '_footer.php'; ?>