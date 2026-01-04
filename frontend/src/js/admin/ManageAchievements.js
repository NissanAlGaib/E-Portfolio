function loadAchievementsAdmin() {
  fetch("../../backend/api/achievements_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderAchievementsAdmin(data);
      } else {
        renderAchievementsAdmin([]);
      }
    })
    .catch((err) => {
      console.error("Error loading achievements:", err);
      renderAchievementsAdmin([]);
    });
}

function renderAchievementsAdmin(achievements) {
  const container = document.getElementById("achievementsList");
  
  if (!achievements || achievements.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center">No achievements found. Click "Add Achievement" to create one.</p>`;
    return;
  }

  container.innerHTML = achievements.map(achievement => {
    const imageUrl = achievement.image 
      ? `../src/imgs/achievements/${achievement.image}` 
      : null;
    
    const date = achievement.date_achieved 
      ? new Date(achievement.date_achieved).toLocaleDateString() 
      : '';

    return `
      <div class="bg-glass border border-gray-700 rounded-lg p-4 flex items-start justify-between">
        <div class="flex items-start space-x-4 flex-grow">
          ${imageUrl ? `<img src="${imageUrl}" alt="${achievement.title}" class="w-20 h-20 object-cover rounded">` : ''}
          <div class="flex-grow">
            <h3 class="text-white font-bold text-lg">${achievement.title}</h3>
            <div class="flex items-center space-x-2 mt-1">
              ${achievement.category ? `<span class="text-xs bg-blue-start text-white px-2 py-1 rounded">${achievement.category}</span>` : ''}
              ${achievement.issuer ? `<span class="text-xs text-gray-500">Issued by ${achievement.issuer}</span>` : ''}
            </div>
            ${achievement.description ? `<p class="text-gray-400 text-sm mt-2">${achievement.description}</p>` : ''}
            ${date ? `<p class="text-gray-500 text-xs mt-1">${date}</p>` : ''}
          </div>
        </div>
        <button onclick="deleteAchievement(${achievement.id})" class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Delete</button>
      </div>
    `;
  }).join('');
}

function handleAddAchievement(e) {
  e.preventDefault();
  const formData = new FormData(e.target);

  fetch("../../backend/api/achievements_api.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
      closeAchievementModal();
      loadAchievementsAdmin();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding achievement:", err));
}

function deleteAchievement(id) {
  if (!confirm("Delete this achievement?")) return;
  fetch("../../backend/api/achievements_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
      loadAchievementsAdmin();
    });
}

function openAchievementModal() {
  const modal = document.getElementById("achievementModal");
  modal.classList.remove("hidden");

  const form = document.getElementById("addAchievementForm");
  if (form && !form.dataset.listenerAdded) {
    form.addEventListener("submit", handleAddAchievement);
    form.dataset.listenerAdded = true;
  }
}

function closeAchievementModal() {
  document.getElementById("achievementModal").classList.add("hidden");
}
