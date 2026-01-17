<div class="w-full max-w-6xl mx-auto p-8 overflow-y-auto">
    <div class="mb-12">
        <!-- Profile Header -->
        <div class="bg-glass rounded-2xl p-8 border border-gray-700 backdrop-blur-lg">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <!-- Profile Image -->
                <div class="flex-shrink-0">
                    <div id="profile-image-container" class="w-48 h-48 rounded-full overflow-hidden border-4 border-gradient-to-r from-blue-start to-purple-end bg-gradient-to-r from-blue-start to-purple-end flex items-center justify-center">
                        <div id="profile-initials" class="w-full h-full bg-dark-bg/50 flex items-center justify-center text-6xl font-bold text-white">
                            ...
                        </div>
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-5xl font-black text-white mb-2">
                        <span id="profile-name" class="bg-clip-text text-transparent bg-gradient-to-r from-blue-start to-purple-end">Loading...</span>
                    </h1>
                    <p id="profile-title" class="text-2xl text-gray-300 mb-4">Loading...</p>
                    <p id="profile-bio" class="text-gray-400 leading-relaxed max-w-2xl">
                        Loading profile information...
                    </p>

                    <!-- Social Links / Contact -->
                    <div id="social-links" class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">
                        <span class="text-gray-500">Loading social links...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Sections -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Quick Stats -->
        <div class="bg-glass rounded-2xl p-6 border border-gray-700 backdrop-blur-lg">
            <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Quick Stats
            </h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-400">Projects Completed</span>
                    <span id="projects-count" class="text-2xl font-bold text-blue-500">0</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400">Skills Mastered</span>
                    <span id="skills-count" class="text-2xl font-bold text-purple-500">0</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400">Achievements</span>
                    <span id="achievements-count" class="text-2xl font-bold text-green-500">0</span>
                </div>
            </div>
        </div>

        <!-- Interests -->
        <div class="bg-glass rounded-2xl p-6 border border-gray-700 backdrop-blur-lg">
            <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                Interests & Hobbies
            </h2>
            <div id="hobbies-list" class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-blue-600/20 border border-blue-600/50 rounded-full text-sm text-blue-300">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Latest Education & Experience -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Education -->
        <div class="bg-glass rounded-2xl p-6 border border-gray-700 backdrop-blur-lg">
            <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                </svg>
                Latest Education
            </h2>
            <div id="latest-education" class="text-gray-400">
                <p class="italic">Loading education...</p>
            </div>
            <a href="?page=education" class="inline-block mt-4 text-blue-400 hover:text-blue-300 transition">
                View all education →
            </a>
        </div>

        <!-- Skills Highlight -->
        <div class="bg-glass rounded-2xl p-6 border border-gray-700 backdrop-blur-lg">
            <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Top Skills
            </h2>
            <div id="top-skills" class="space-y-3">
                <p class="text-gray-400 italic">Loading skills...</p>
            </div>
            <a href="?page=skills" class="inline-block mt-4 text-purple-400 hover:text-purple-300 transition">
                View all skills →
            </a>
        </div>
    </div>
</div>

<script>
    // Load profile data
    async function loadProfileData() {
        try {
            // Load user profile data
            const userResponse = await fetch('/E-Portfolio/E-Portfolio/backend/api/user_api.php?id=1');
            const userData = await userResponse.json();

            if (userData && !userData.message) {
                // Update name
                const fullName = `${userData.first_name || ''} ${userData.middle_initial ? userData.middle_initial + '. ' : ''}${userData.last_name || ''}`.trim();
                document.getElementById('profile-name').textContent = fullName || 'User';

                // Update initials for image placeholder
                const initials = `${userData.first_name?.[0] || ''}${userData.last_name?.[0] || ''}`.toUpperCase();
                document.getElementById('profile-initials').textContent = initials || 'U';

                // Update title and bio
                document.getElementById('profile-title').textContent = userData.job_title || 'Professional';
                document.getElementById('profile-bio').textContent = userData.bio || 'Welcome to my profile!';

                // Update profile image if exists
                if (userData.profile_image) {
                    const container = document.getElementById('profile-image-container');
                    container.innerHTML = `<img src="/E-Portfolio/E-Portfolio/frontend/src/imgs/profile/${userData.profile_image}" alt="Profile" class="w-full h-full object-cover">`;
                }

                // Build social links
                const socialLinks = [];

                if (userData.email) {
                    socialLinks.push(`
                    <a href="mailto:${userData.email}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600/20 hover:bg-blue-600/30 border border-blue-600/50 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email
                    </a>
                `);
                }

                if (userData.phone) {
                    socialLinks.push(`
                    <a href="tel:${userData.phone}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600/20 hover:bg-green-600/30 border border-green-600/50 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Phone
                    </a>
                `);
                }

                if (userData.github_url) {
                    socialLinks.push(`
                    <a href="${userData.github_url}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600/20 hover:bg-purple-600/30 border border-purple-600/50 rounded-lg transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                        GitHub
                    </a>
                `);
                }

                if (userData.linkedin_url) {
                    socialLinks.push(`
                    <a href="${userData.linkedin_url}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/20 hover:bg-blue-500/30 border border-blue-500/50 rounded-lg transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        LinkedIn
                    </a>
                `);
                }

                if (userData.portfolio_url) {
                    socialLinks.push(`
                    <a href="${userData.portfolio_url}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-orange-600/20 hover:bg-orange-600/30 border border-orange-600/50 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        Portfolio
                    </a>
                `);
                }

                if (userData.location) {
                    socialLinks.push(`
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600/20 border border-gray-600/50 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        ${userData.location}
                    </div>
                `);
                }

                // Update social links container
                const socialLinksContainer = document.getElementById('social-links');
                if (socialLinks.length > 0) {
                    socialLinksContainer.innerHTML = socialLinks.join('');
                } else {
                    socialLinksContainer.innerHTML = '<span class="text-gray-500">No contact information available</span>';
                }
            }

            // Load projects count
            const projectsResponse = await fetch('/E-Portfolio/E-Portfolio/backend/api/projects_api.php?user_id=1');
            const projects = await projectsResponse.json();
            if (Array.isArray(projects)) {
                document.getElementById('projects-count').textContent = projects.length;
            }

            // Load skills count and top skills
            const skillsResponse = await fetch('/E-Portfolio/E-Portfolio/backend/api/skills_api.php?user_id=1');
            const skills = await skillsResponse.json();
            if (Array.isArray(skills)) {
                document.getElementById('skills-count').textContent = skills.length;

                // Show top 5 skills by proficiency
                const topSkills = skills
                    .sort((a, b) => (b.proficiency || 0) - (a.proficiency || 0))
                    .slice(0, 5);

                const topSkillsContainer = document.getElementById('top-skills');
                if (topSkills.length > 0) {
                    topSkillsContainer.innerHTML = topSkills.map(skill => `
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-white font-medium">${skill.skill_name}</span>
                            <span class="text-gray-400">${skill.proficiency}%</span>
                        </div>
                        <div class="w-full bg-gray-700 h-2 rounded-full">
                            <div class="bg-gradient-to-r from-blue-start to-purple-end h-2 rounded-full" style="width: ${skill.proficiency}%"></div>
                        </div>
                    </div>
                `).join('');
                }
            }

            // Load achievements count
            const achievementsResponse = await fetch('/E-Portfolio/E-Portfolio/backend/api/achievements_api.php?user_id=1');
            const achievements = await achievementsResponse.json();
            if (Array.isArray(achievements)) {
                document.getElementById('achievements-count').textContent = achievements.length;
            }

            // Load hobbies
            const hobbiesResponse = await fetch('/E-Portfolio/E-Portfolio/backend/api/hobbies_api.php?user_id=1');
            const hobbies = await hobbiesResponse.json();
            if (Array.isArray(hobbies) && hobbies.length > 0) {
                const hobbiesList = document.getElementById('hobbies-list');
                hobbiesList.innerHTML = hobbies.map(hobby => `
                <span class="px-3 py-1 bg-purple-600/20 border border-purple-600/50 rounded-full text-sm text-purple-300">
                    ${hobby.hobby_name}
                </span>
            `).join('');
            }

            // Load latest education
            const educationResponse = await fetch('/E-Portfolio/E-Portfolio/backend/api/education_api.php?user_id=1');
            const education = await educationResponse.json();
            if (Array.isArray(education) && education.length > 0) {
                const latest = education[0];
                const latestEducationContainer = document.getElementById('latest-education');
                latestEducationContainer.innerHTML = `
                <div>
                    <h3 class="text-white font-bold text-lg">${latest.degree}</h3>
                    <p class="text-gray-300">${latest.institution_name}</p>
                    <p class="text-gray-500 text-sm">${latest.field_of_study || ''}</p>
                    ${latest.gpa ? `<p class="text-gray-500 text-sm mt-1">GPA: ${latest.gpa}</p>` : ''}
                </div>
            `;
            }
        } catch (error) {
            console.error('Error loading profile data:', error);
        }
    }

    // Load data when page loads
    if (typeof loadProfileData === 'function') {
        loadProfileData();
    }
</script>