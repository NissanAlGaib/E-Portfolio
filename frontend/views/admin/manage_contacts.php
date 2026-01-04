<div class="w-full h-full overflow-y-auto">
    <section class="max-w-7xl mx-auto p-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <a href="#" data-page="admin/dashboard.php" class="ajax-link text-gray-400 hover:text-white mb-2 inline-block">← Back to Dashboard</a>
                <h1 class="text-5xl font-black text-white">Contact Messages</h1>
            </div>
        </div>

        <div class="mb-6 flex space-x-4">
            <button onclick="filterContacts('all')" class="px-4 py-2 bg-glass border border-gray-700 text-white rounded-lg hover:bg-blue-start transition-colors">All</button>
            <button onclick="filterContacts('new')" class="px-4 py-2 bg-glass border border-gray-700 text-white rounded-lg hover:bg-blue-start transition-colors">New</button>
            <button onclick="filterContacts('read')" class="px-4 py-2 bg-glass border border-gray-700 text-white rounded-lg hover:bg-blue-start transition-colors">Read</button>
            <button onclick="filterContacts('replied')" class="px-4 py-2 bg-glass border border-gray-700 text-white rounded-lg hover:bg-blue-start transition-colors">Replied</button>
        </div>

        <div id="contactsList" class="space-y-4">
            <p class="text-gray-400 text-center">Loading contacts...</p>
        </div>
    </section>

    <script src="../../src/js/admin/ManageContacts.js"></script>
    <script>
      loadContactsAdmin();
    </script>
</div>
