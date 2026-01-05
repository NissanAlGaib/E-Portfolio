<?php $page_title = 'Manage Profile';
include '_header.php'; ?>
<section class="max-w-7xl mx-auto p-12">
    <div class="flex justify-between items-center mb-8">
        <div>
            <a href="/E-Portfolio/E-Portfolio/frontend/index.php?page=admin" class="text-gray-400 hover:text-white mb-2 inline-block">← Back to Dashboard</a>
            <h1 class="text-5xl font-black text-white">Manage Profile</h1>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="bg-glass border border-gray-700 p-8 rounded-2xl w-full max-w-4xl">
        <form id="profile-form" class="space-y-6" enctype="multipart/form-data">
            <input type="hidden" id="profile-id" value="1">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- First Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">First Name *</label>
                    <input type="text" id="first-name" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- Last Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Last Name *</label>
                    <input type="text" id="last-name" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- Middle Initial -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Middle Initial</label>
                    <input type="text" id="middle-initial" maxlength="1" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white uppercase">
                </div>

                <!-- Job Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Job Title</label>
                    <input type="text" id="job-title" placeholder="e.g., Creative Frontend Developer" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email *</label>
                    <input type="email" id="email" required class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Phone</label>
                    <input type="tel" id="phone" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- Location -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                    <input type="text" id="location" placeholder="e.g., San Francisco, CA" class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- Bio -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Bio</label>
                    <textarea id="bio" rows="4" placeholder="Tell us about yourself..." class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white"></textarea>
                </div>

                <!-- LinkedIn URL -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">LinkedIn URL</label>
                    <input type="url" id="linkedin-url" placeholder="https://linkedin.com/in/..." class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- GitHub URL -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">GitHub URL</label>
                    <input type="url" id="github-url" placeholder="https://github.com/..." class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- Portfolio URL -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Portfolio URL</label>
                    <input type="url" id="portfolio-url" placeholder="https://..." class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white">
                </div>

                <!-- Profile Image -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Profile Image</label>
                    <div class="flex items-center gap-4">
                        <img id="profile-image-preview" src="" alt="Profile preview" class="w-24 h-24 rounded-full object-cover border-2 border-gray-700 hidden">
                        <input type="file" id="profile-image" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-start file:text-white hover:file:bg-purple-end">
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="/E-Portfolio/E-Portfolio/frontend/index.php?page=admin" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-start to-purple-end text-white rounded-lg hover:opacity-90 transition-opacity">Update Profile</button>
            </div>
        </form>
    </div>
</section>

<script>
    // Load current profile data
    async function loadProfile() {
        try {
            const response = await fetch('/E-Portfolio/E-Portfolio/backend/api/user_api.php?id=1');
            const data = await response.json();

            if (data && !data.message) {
                document.getElementById('first-name').value = data.first_name || '';
                document.getElementById('last-name').value = data.last_name || '';
                document.getElementById('middle-initial').value = data.middle_initial || '';
                document.getElementById('job-title').value = data.job_title || '';
                document.getElementById('email').value = data.email || '';
                document.getElementById('phone').value = data.phone || '';
                document.getElementById('location').value = data.location || '';
                document.getElementById('bio').value = data.bio || '';
                document.getElementById('linkedin-url').value = data.linkedin_url || '';
                document.getElementById('github-url').value = data.github_url || '';
                document.getElementById('portfolio-url').value = data.portfolio_url || '';

                // Show profile image if exists
                if (data.profile_image) {
                    const preview = document.getElementById('profile-image-preview');
                    preview.src = '/E-Portfolio/E-Portfolio/frontend/src/imgs/profile/' + data.profile_image;
                    preview.classList.remove('hidden');
                }
            }
        } catch (error) {
            console.error('Error loading profile:', error);
            showAlert('Failed to load profile data', 'error');
        }
    }

    // Handle profile image preview
    document.getElementById('profile-image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profile-image-preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle form submission
    document.getElementById('profile-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('id', document.getElementById('profile-id').value);
        formData.append('first_name', document.getElementById('first-name').value);
        formData.append('last_name', document.getElementById('last-name').value);
        formData.append('middle_initial', document.getElementById('middle-initial').value);
        formData.append('job_title', document.getElementById('job-title').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('phone', document.getElementById('phone').value);
        formData.append('location', document.getElementById('location').value);
        formData.append('bio', document.getElementById('bio').value);
        formData.append('linkedin_url', document.getElementById('linkedin-url').value);
        formData.append('github_url', document.getElementById('github-url').value);
        formData.append('portfolio_url', document.getElementById('portfolio-url').value);

        // Add profile image if selected
        const imageFile = document.getElementById('profile-image').files[0];
        if (imageFile) {
            formData.append('profile_image', imageFile);
        }

        try {
            const response = await fetch('/E-Portfolio/E-Portfolio/backend/api/user_api.php', {
                method: 'PUT',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                showAlert(result.message || 'Profile updated successfully!', 'success');
            } else {
                showAlert('Error updating profile: ' + (result.message || 'Unknown error'), 'error');
            }
        } catch (error) {
            console.error('Error updating profile:', error);
            showAlert('Failed to update profile', 'error');
        }
    });

    // Load profile on page load
    loadProfile();
</script>

<?php include '_footer.php'; ?>