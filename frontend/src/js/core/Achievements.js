function loadAchievements() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/achievements_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderAchievements(data);
      } else {
        renderAchievements([]);
      }
    })
    .catch((err) => {
      console.error("Error loading achievements:", err);
      renderAchievements([]);
    });
}

function renderAchievements(achievements) {
  const container = document.getElementById("achievementsContainer");

  if (!achievements || achievements.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center">No achievements found.</p>`;
    return;
  }

  // Group achievements by category
  const achievementsByCategory = achievements.reduce((acc, achievement) => {
    const category = achievement.category || "Other";
    if (!acc[category]) {
      acc[category] = [];
    }
    acc[category].push(achievement);
    return acc;
  }, {});

  let html = "";
  for (const [category, items] of Object.entries(achievementsByCategory)) {
    html += `
      <div class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
          <span class="bg-gradient-to-r from-blue-start to-purple-end w-1 h-8 mr-3 rounded"></span>
          ${category}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          ${items
            .map((achievement) => renderAchievementCard(achievement))
            .join("")}
        </div>
      </div>
    `;
  }

  container.innerHTML = html;
}

function renderAchievementCard(achievement) {
  const imageUrl = achievement.image
    ? `src/imgs/achievements/${achievement.image}`
    : null;

  const date = achievement.date_achieved
    ? new Date(achievement.date_achieved).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      })
    : "";

  return `
    <div class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
      ${
        imageUrl
          ? `
        <div class="mb-4">
          <img src="${imageUrl}" alt="${achievement.title}" class="w-full h-48 object-cover rounded-lg">
        </div>
      `
          : ""
      }
      
      <h3 class="text-xl font-bold text-white mb-2">${achievement.title}</h3>
      
      <div class="flex items-center space-x-2 mb-3">
        ${
          achievement.issuer
            ? `
          <span class="text-sm text-gray-400">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            ${achievement.issuer}
          </span>
        `
            : ""
        }
        ${
          date
            ? `
          <span class="text-sm text-gray-500">•</span>
          <span class="text-sm text-gray-400">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            ${date}
          </span>
        `
            : ""
        }
      </div>

      ${
        achievement.description
          ? `
        <p class="text-gray-300 text-sm">${achievement.description}</p>
      `
          : ""
      }
    </div>
  `;
}
