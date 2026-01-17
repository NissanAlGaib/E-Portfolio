// Initialize pagination
let pagination;

function initializePagination() {
  pagination = new PaginationManager({
    itemsPerPage: 10,
    defaultSort: "skill_name",
    searchFields: ["skill_name", "category", "description", "skill_type"],
    renderCallback: renderSkillsAdmin,
    containerId: "skillsList",
    paginationId: "skillsPagination",
    searchInputId: "skillSearch",
    itemsPerPageId: "skillsPerPage",
    sortSelectId: "skillSort",
  });

  // Render search and filter UI
  const searchContainer = document.getElementById("searchFilterContainer");
  if (searchContainer) {
    searchContainer.innerHTML = pagination.renderSearchAndFilters({
      searchPlaceholder: "Search skills by name, category, type...",
      sortOptions: [
        { value: "skill_name", label: "Name (A-Z)" },
        { value: "proficiency", label: "Proficiency" },
        { value: "years_experience", label: "Years of Experience" },
        { value: "skill_type", label: "Type" },
      ],
      filterSelects: [
        {
          field: "skill_type",
          label: "All Types",
          options: [
            { value: "technical", label: "Technical Skills" },
            { value: "soft", label: "Soft Skills" },
          ],
        },
      ],
    });
  }
}

function loadSkillsAdmin() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/skills_api.php?user_id=1")
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
      console.error("Error loading skills:", err);
      if (!pagination) {
        initializePagination();
      }
      pagination.setItems([]);
    });
}

function renderSkillsAdmin(skills) {
  const container = document.getElementById("skillsList");

  if (!skills || skills.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center py-8">No skills found matching your criteria.</p>`;
    return;
  }

  container.innerHTML = skills.map((skill) => renderSkillItem(skill)).join("");
}

function renderSkillItem(skill) {
  return `
    <div class="bg-glass border border-gray-700 rounded-lg p-4 flex items-center justify-between">
      <div class="flex-grow">
        <div class="flex items-center space-x-3 mb-2">
          ${
            skill.icon
              ? `<img src="src/imgs/skills/${skill.icon}" class="w-8 h-8 rounded">`
              : ""
          }
          <div>
            <h4 class="text-white font-bold">${skill.skill_name}</h4>
            ${
              skill.category
                ? `<span class="text-xs text-gray-500">${skill.category}</span>`
                : ""
            }
          </div>
        </div>
        <div class="w-full bg-gray-700 h-2 rounded-full">
          <div class="bg-gradient-to-r from-blue-start to-purple-end h-2 rounded-full" style="width: ${
            skill.proficiency
          }%"></div>
        </div>
        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-400">
          <span>Proficiency: ${skill.proficiency}%</span>
          ${
            skill.years_experience
              ? `<span>Experience: ${skill.years_experience} years</span>`
              : ""
          }
        </div>
      </div>
      <div class="flex space-x-2">
        <button onclick="editSkill(${
          skill.id
        })" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Edit</button>
        <button onclick="deleteSkill(${
          skill.id
        })" class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Delete</button>
      </div>
    </div>
  `;
}

function handleAddSkill(e) {
  e.preventDefault();
  const formData = new FormData(e.target);

  fetch("/E-Portfolio/E-Portfolio/backend/api/skills_api.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      closeSkillModal();
      loadSkillsAdmin();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding skill:", err));
}

async function deleteSkill(id) {
  const confirmed = await showConfirm(
    "Are you sure you want to delete this skill?",
    "Delete",
    "Cancel"
  );
  if (!confirmed) return;
  fetch("/E-Portfolio/E-Portfolio/backend/api/skills_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      loadSkillsAdmin();
    });
}

function openSkillModal() {
  const modal = document.getElementById("skillModal");
  modal.classList.remove("hidden");

  const form = document.getElementById("addSkillForm");
  if (form && !form.dataset.listenerAdded) {
    form.addEventListener("submit", handleAddSkill);
    form.dataset.listenerAdded = true;
  }
}

function closeSkillModal() {
  document.getElementById("skillModal").classList.add("hidden");
}

function editSkill(id) {
  // Find the skill data
  fetch(`/E-Portfolio/E-Portfolio/backend/api/skills_api.php?user_id=1`)
    .then((res) => res.json())
    .then((skills) => {
      const skill = skills.find((s) => s.id == id);
      if (!skill) return;

      // Show modal
      document.getElementById("editSkillModal").classList.remove("hidden");

      // Populate form fields
      document.getElementById("edit-skill-id").value = skill.id;
      document.getElementById("edit-skill-name").value = skill.skill_name;
      document.getElementById("edit-skill-type").value =
        skill.skill_type || "technical";
      document.getElementById("edit-skill-category").value =
        skill.category || "";
      document.getElementById("edit-skill-proficiency").value =
        skill.proficiency;
      document.getElementById("edit-skill-years").value =
        skill.years_experience || "";
      document.getElementById("edit-skill-description").value =
        skill.description || "";
    });
}

function closeEditSkillModal() {
  document.getElementById("editSkillModal").classList.add("hidden");
  document.getElementById("edit-skill-form").reset();
}

// Handle edit form submission
document.addEventListener("DOMContentLoaded", function () {
  const editForm = document.getElementById("edit-skill-form");
  if (editForm) {
    editForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const data = {
        id: document.getElementById("edit-skill-id").value,
        user_id: document.getElementById("edit-skill-user-id").value,
        skill_name: document.getElementById("edit-skill-name").value,
        skill_type: document.getElementById("edit-skill-type").value,
        category: document.getElementById("edit-skill-category").value,
        proficiency: document.getElementById("edit-skill-proficiency").value,
        years_experience: document.getElementById("edit-skill-years").value,
        description: document.getElementById("edit-skill-description").value,
      };

      try {
        const response = await fetch(
          "/E-Portfolio/E-Portfolio/backend/api/skills_api.php",
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
          showAlert(result.message || "Skill updated successfully!", "success");
          closeEditSkillModal();
          loadSkillsAdmin();
        } else {
          showAlert(
            "Error updating skill: " + (result.message || "Unknown error"),
            "error"
          );
        }
      } catch (error) {
        console.error("Error updating skill:", error);
        showAlert("Failed to update skill", "error");
      }
    });
  }
});
