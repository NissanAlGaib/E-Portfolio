<div class="w-full h-full overflow-y-auto">
    <section class="max-w-7xl mx-auto p-12">
        <h1 class="text-5xl font-black text-white mb-12 text-center">My Hobbies</h1>

        <!-- Add Hobby Button -->
        <div class="fixed bottom-10 right-10">
            <button onclick="openHobbyModal()" class="bg-gradient-to-r from-blue-start to-purple-end text-white rounded-full w-16 h-16 shadow-lg flex items-center justify-center text-3xl transform hover:scale-110 transition-transform duration-300">
                +
            </button>
        </div>

        <!-- Hobby Timeline Container -->
        <div id="hobbyTimeline" class="relative w-full py-8">
            <p class="text-gray-400 w-full text-center">Loading timeline...</p>
        </div>
        <div id="hobbyDetailsContainer" class="w-full"></div>

        <!-- Add Hobby Modal -->
        <div id="hobbyModal" class="hidden fixed inset-0 bg-dark-bg bg-opacity-75 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-glass border border-gray-700 p-8 rounded-2xl w-full max-w-md shadow-lg">
                <h2 class="text-3xl font-bold text-white mb-6">Add Hobby</h2>
                <form id="addHobbyForm" class="space-y-4" enctype="multipart/form-data" onsubmit="return false;">
                    <input type="hidden" name="user_id" value="1" />
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Hobby Name</label>
                        <input type="text" name="hobby_name" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea name="description" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                        <input type="text" name="category" placeholder="e.g. Creative" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Icon Image</label>
                        <input type="file" name="icon" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-start file:text-white hover:file:bg-purple-end">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Proficiency (0–100)</label>
                        <input type="number" name="proficiency" min="0" max="100" value="75" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none">
                    </div>
                    <div class="flex justify-end space-x-4 pt-4">
                        <button type="button" onclick="closeHobbyModal()" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-start to-purple-end text-white rounded-lg hover:opacity-90 transition-opacity">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="../../src/js/core/Hobbies.js"></script>
    <script>
      loadHobbies();
    </script>
</div>
