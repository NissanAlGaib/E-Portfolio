// Admin Hobbies Management
// Initialize pagination
let pagination;

function initializePagination() {
  pagination = new PaginationManager({
    itemsPerPage: 10,
    defaultSort: "hobby_name",
    searchFields: ["hobby_name", "description", "category"],
    renderCallback: renderHobbiesAdmin,
    containerId: "hobbies-admin-container",
    paginationId: "hobbiesPagination",
    searchInputId: "hobbySearch",
    itemsPerPageId: "hobbiesPerPage",
    sortSelectId: "hobbySort",
  });

  // Render search and filter UI
  const searchContainer = document.getElementById("searchFilterContainer");
  if (searchContainer) {
    searchContainer.innerHTML = pagination.renderSearchAndFilters({
      searchPlaceholder: "Search hobbies by name, category...",
      sortOptions: [
        { value: "hobby_name", label: "Name (A-Z)" },
        { value: "category", label: "Category" },
      ],
    });
  }
}

async function loadHobbiesAdmin() {
  try {
    const response = await fetch(
      "/E-Portfolio/E-Portfolio/backend/api/hobbies_api.php?user_id=1"
    );
    const hobbies = await response.json();

    if (!pagination) {
      initializePagination();
    }

    if (hobbies && !hobbies.message) {
      pagination.setItems(hobbies);
    } else {
      pagination.setItems([]);
    }
  } catch (error) {
    console.error("Error loading hobbies:", error);
    if (!pagination) {
      initializePagination();
    }
    pagination.setItems([]);
  }
}

function renderHobbiesAdmin(hobbies) {
  const container = document.getElementById("hobbies-admin-container");

  if (!hobbies || hobbies.length === 0) {
    container.innerHTML =
      '<p class="text-gray-400 text-center py-8">No hobbies found matching your criteria.</p>';
    return;
  }

  container.innerHTML = hobbies
    .map(
      (hobby) => `
        <div class="bg-dark-bg/50 backdrop-blur-sm rounded-lg p-6 border border-white/10 hover:border-white/20 transition">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-white mb-2">${
                      hobby.hobby_name || hobby.name
                    }</h3>
                    <p class="text-gray-300 mb-2">${hobby.description}</p>
                    ${
                      hobby.category
                        ? `<span class="text-xs bg-blue-600 text-white px-2 py-1 rounded">${hobby.category}</span>`
                        : ""
                    }
                    ${
                      hobby.icon || hobby.image_url
                        ? `
                        <img src="/E-Portfolio/E-Portfolio/frontend/src/imgs/hobbies/${
                          hobby.icon || hobby.image_url
                        }" 
                             alt="${hobby.hobby_name || hobby.name}" 
                             class="w-32 h-32 object-cover rounded-lg mt-2">
                    `
                        : ""
                    }
                </div>
                <div class="flex gap-2">
                    <button 
                        onclick='editHobby(${JSON.stringify(hobby).replace(
                          /'/g,
                          "&apos;"
                        )})' 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        Edit
                    </button>
                    <button 
                        onclick="deleteHobby(${hobby.id})" 
                        class="px-4 py-2 bg-red-500/80 hover:bg-red-600 text-white rounded-lg transition">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    `
    )
    .join("");
}

function editHobby(hobby) {
  // Show modal
  document.getElementById("editHobbyModal").classList.remove("hidden");

  // Populate form fields
  document.getElementById("edit-hobby-id").value = hobby.id;
  document.getElementById("edit-hobby-name").value =
    hobby.hobby_name || hobby.name;
  document.getElementById("edit-hobby-description").value = hobby.description;
  document.getElementById("edit-hobby-category").value = hobby.category || "";

  // Show current icon if available
  const iconPreview = document.getElementById("edit-hobby-icon-preview");
  if (hobby.icon) {
    iconPreview.src =
      "/E-Portfolio/E-Portfolio/frontend/src/imgs/hobbies/" + hobby.icon;
    iconPreview.classList.remove("hidden");
  } else {
    iconPreview.classList.add("hidden");
  }
}

function closeEditModal() {
  document.getElementById("editHobbyModal").classList.add("hidden");
  document.getElementById("edit-hobby-form").reset();
}

function openAddHobbyModal() {
  document.getElementById("addHobbyModal").classList.remove("hidden");
}

function closeAddHobbyModal() {
  document.getElementById("addHobbyModal").classList.add("hidden");
  document.getElementById("add-hobby-form").reset();
}

// Handle edit form submission
document.addEventListener("DOMContentLoaded", function () {
  const editForm = document.getElementById("edit-hobby-form");
  if (editForm) {
    editForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const data = {
        id: document.getElementById("edit-hobby-id").value,
        user_id: document.getElementById("edit-user-id").value,
        hobby_name: document.getElementById("edit-hobby-name").value,
        description: document.getElementById("edit-hobby-description").value,
        category: document.getElementById("edit-hobby-category").value,
      };

      try {
        const response = await fetch(
          "/E-Portfolio/E-Portfolio/backend/api/hobbies_api.php",
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
          showAlert(result.message || "Hobby updated successfully!", "success");
          closeEditModal();
          loadHobbiesAdmin();
        } else {
          showAlert(
            "Error updating hobby: " + (result.message || "Unknown error"),
            "error"
          );
        }
      } catch (error) {
        console.error("Error updating hobby:", error);
        showAlert("Failed to update hobby", "error");
      }
    });
  }
});

async function handleAddHobby(event) {
  event.preventDefault();
  const formData = new FormData(event.target);

  try {
    const response = await fetch(
      "/E-Portfolio/E-Portfolio/backend/api/hobbies_api.php",
      {
        method: "POST",
        body: formData,
      }
    );

    const result = await response.json();

    if (result.success) {
      showAlert(result.message || "Hobby added successfully!", "success");
      closeAddHobbyModal();
      loadHobbiesAdmin();
    } else {
      showAlert(
        "Error adding hobby: " + (result.message || "Unknown error"),
        "error"
      );
    }
  } catch (error) {
    console.error("Error adding hobby:", error);
    showAlert("Failed to add hobby", "error");
  }
}

async function deleteHobby(id) {
  const confirmed = await showConfirm(
    "Are you sure you want to delete this hobby?",
    "Delete",
    "Cancel"
  );
  if (!confirmed) return;

  try {
    const response = await fetch(
      `/E-Portfolio/E-Portfolio/backend/api/hobbies_api.php?id=${id}`,
      {
        method: "DELETE",
      }
    );

    const result = await response.json();

    if (result.success) {
      showAlert(result.message || "Hobby deleted successfully!", "success");
      loadHobbiesAdmin();
    } else {
      showAlert(
        "Error deleting hobby: " + (result.message || "Unknown error"),
        "error"
      );
    }
  } catch (error) {
    console.error("Error deleting hobby:", error);
    showAlert("Failed to delete hobby", "error");
  }
}
