// Initialize pagination
let pagination;

function initializePagination() {
  pagination = new PaginationManager({
    itemsPerPage: 10,
    defaultSort: "date_achieved",
    searchFields: ["title", "description", "category", "issuer"],
    renderCallback: renderAchievementsAdmin,
    containerId: "achievementsList",
    paginationId: "achievementsPagination",
    searchInputId: "achievementSearch",
    itemsPerPageId: "achievementsPerPage",
    sortSelectId: "achievementSort",
  });

  // Render search and filter UI
  const searchContainer = document.getElementById("searchFilterContainer");
  if (searchContainer) {
    searchContainer.innerHTML = pagination.renderSearchAndFilters({
      searchPlaceholder: "Search achievements by title, category, issuer...",
      sortOptions: [
        { value: "title", label: "Title (A-Z)" },
        { value: "date_achieved", label: "Date Achieved" },
        { value: "display_order", label: "Display Order" },
        { value: "category", label: "Category" },
      ],
    });
  }
}

function loadAchievementsAdmin() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/achievements_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        if (!pagination) {
          initializePagination();
        }
        pagination.setItems(data);
      } else {
        if (!pagination) {
          initializePagination();
        }
        pagination.setItems([]);
      }
    })
    .catch((err) => {
      console.error("Error loading achievements:", err);
      if (!pagination) {
        initializePagination();
      }
      pagination.setItems([]);
    });
}

function renderAchievementsAdmin(achievements) {
  const container = document.getElementById("achievementsList");

  if (!achievements || achievements.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center py-8">No achievements found matching your criteria.</p>`;
    return;
  }

  container.innerHTML = achievements
    .map((achievement) => {
      const imageUrl = achievement.image
        ? `src/imgs/achievements/${achievement.image}`
        : null;

      const date = achievement.date_achieved
        ? new Date(achievement.date_achieved).toLocaleDateString()
        : "";

      return `
      <div class="bg-glass border border-gray-700 rounded-lg p-4 flex items-start justify-between">
        <div class="flex items-start space-x-4 flex-grow">
          ${
            imageUrl
              ? `<img src="${imageUrl}" alt="${achievement.title}" class="w-20 h-20 object-cover rounded">`
              : ""
          }
          <div class="flex-grow">
            <h3 class="text-white font-bold text-lg">${achievement.title}</h3>
            <div class="flex items-center space-x-2 mt-1">
              ${
                achievement.category
                  ? `<span class="text-xs bg-blue-start text-white px-2 py-1 rounded">${achievement.category}</span>`
                  : ""
              }
              ${
                achievement.issuer
                  ? `<span class="text-xs text-gray-500">Issued by ${achievement.issuer}</span>`
                  : ""
              }
            </div>
            ${
              achievement.description
                ? `<p class="text-gray-400 text-sm mt-2">${achievement.description}</p>`
                : ""
            }
            ${date ? `<p class="text-gray-500 text-xs mt-1">${date}</p>` : ""}
          </div>
        </div>
        <div class="flex space-x-2">
          <button onclick="editAchievement(${
            achievement.id
          })" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Edit</button>
          <button onclick="deleteAchievement(${
            achievement.id
          })" class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Delete</button>
        </div>
      </div>
    `;
    })
    .join("");
}

function handleAddAchievement(e) {
  e.preventDefault();
  const formData = new FormData(e.target);

  fetch("/E-Portfolio/E-Portfolio/backend/api/achievements_api.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      closeAchievementModal();
      loadAchievementsAdmin();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding achievement:", err));
}

async function deleteAchievement(id) {
  const confirmed = await showConfirm(
    "Are you sure you want to delete this achievement?",
    "Delete",
    "Cancel"
  );
  if (!confirmed) return;
  fetch("/E-Portfolio/E-Portfolio/backend/api/achievements_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
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

function editAchievement(id) {
  // Find the achievement data
  fetch(`/E-Portfolio/E-Portfolio/backend/api/achievements_api.php?user_id=1`)
    .then((res) => res.json())
    .then((achievements) => {
      const achievement = achievements.find((a) => a.id == id);
      if (!achievement) return;

      // Show modal
      document
        .getElementById("editAchievementModal")
        .classList.remove("hidden");

      // Populate form fields
      document.getElementById("edit-achievement-id").value = achievement.id;
      document.getElementById("edit-achievement-title").value =
        achievement.title;
      document.getElementById("edit-achievement-category").value =
        achievement.category || "";
      document.getElementById("edit-achievement-issuer").value =
        achievement.issuer || "";
      document.getElementById("edit-achievement-date").value =
        achievement.date_achieved || "";
      document.getElementById("edit-achievement-order").value =
        achievement.display_order || "0";
      document.getElementById("edit-achievement-description").value =
        achievement.description || "";
    });
}

function closeEditAchievementModal() {
  document.getElementById("editAchievementModal").classList.add("hidden");
  document.getElementById("edit-achievement-form").reset();
}

// Handle edit form submission
document.addEventListener("DOMContentLoaded", function () {
  const editForm = document.getElementById("edit-achievement-form");
  if (editForm) {
    editForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const data = {
        id: document.getElementById("edit-achievement-id").value,
        user_id: document.getElementById("edit-achievement-user-id").value,
        title: document.getElementById("edit-achievement-title").value,
        category: document.getElementById("edit-achievement-category").value,
        issuer: document.getElementById("edit-achievement-issuer").value,
        date_achieved: document.getElementById("edit-achievement-date").value,
        display_order: document.getElementById("edit-achievement-order").value,
        description: document.getElementById("edit-achievement-description")
          .value,
      };

      try {
        const response = await fetch(
          "/E-Portfolio/E-Portfolio/backend/api/achievements_api.php",
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          }
        );

        const result = await response.json();

        if (result.success) {
          showAlert(
            result.message || "Achievement updated successfully!",
            "success"
          );
          closeEditAchievementModal();
          loadAchievementsAdmin();
        } else {
          showAlert(
            "Error updating achievement: " +
              (result.message || "Unknown error"),
            "error"
          );
        }
      } catch (error) {
        console.error("Error updating achievement:", error);
        showAlert("Failed to update achievement", "error");
      }
    });
  }
});
