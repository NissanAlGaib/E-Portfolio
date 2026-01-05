// Initialize pagination
let pagination;

function initializePagination() {
  pagination = new PaginationManager({
    itemsPerPage: 10,
    defaultSort: "start_date",
    searchFields: [
      "institution_name",
      "degree",
      "field_of_study",
      "location",
      "description",
    ],
    renderCallback: renderEducationAdmin,
    containerId: "educationList",
    paginationId: "educationPagination",
    searchInputId: "educationSearch",
    itemsPerPageId: "educationPerPage",
    sortSelectId: "educationSort",
  });

  // Render search and filter UI
  const searchContainer = document.getElementById("searchFilterContainer");
  if (searchContainer) {
    searchContainer.innerHTML = pagination.renderSearchAndFilters({
      searchPlaceholder: "Search education by institution, degree, field...",
      sortOptions: [
        { value: "institution_name", label: "Institution (A-Z)" },
        { value: "start_date", label: "Start Date" },
        { value: "end_date", label: "End Date" },
        { value: "gpa", label: "GPA" },
      ],
    });
  }
}

function loadEducationAdmin() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/education_api.php?user_id=1")
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
      console.error("Error loading education:", err);
      if (!pagination) {
        initializePagination();
      }
      pagination.setItems([]);
    });
}

function renderEducationAdmin(education) {
  const container = document.getElementById("educationList");

  if (!education || education.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center py-8">No education records found matching your criteria.</p>`;
    return;
  }

  container.innerHTML = education
    .map((edu) => {
      const logoUrl = edu.logo ? `src/imgs/education/${edu.logo}` : null;

      const startDate = edu.start_date
        ? new Date(edu.start_date).toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
          })
        : "";
      const endDate = edu.end_date
        ? new Date(edu.end_date).toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
          })
        : "Present";

      return `
      <div class="bg-glass border border-gray-700 rounded-lg p-4 flex items-start justify-between">
        <div class="flex items-start space-x-4 flex-grow">
          ${
            logoUrl
              ? `<img src="${logoUrl}" alt="${edu.institution_name}" class="w-16 h-16 object-contain rounded">`
              : ""
          }
          <div class="flex-grow">
            <h3 class="text-white font-bold text-lg">${
              edu.institution_name
            }</h3>
            <p class="text-gray-300">${edu.degree}${
        edu.field_of_study ? " in " + edu.field_of_study : ""
      }</p>
            <div class="flex items-center space-x-2 mt-1">
              ${
                edu.location
                  ? `<span class="text-xs text-gray-500">${edu.location}</span>`
                  : ""
              }
              ${
                startDate
                  ? `<span class="text-xs text-gray-500">${startDate} - ${endDate}</span>`
                  : ""
              }
              ${
                edu.gpa
                  ? `<span class="text-xs text-gray-500">GPA: ${edu.gpa}</span>`
                  : ""
              }
            </div>
            ${
              edu.description
                ? `<p class="text-gray-400 text-sm mt-2">${edu.description}</p>`
                : ""
            }
          </div>
        </div>
        <div class="flex space-x-2">
          <button onclick="editEducation(${
            edu.id
          })" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Edit</button>
          <button onclick="deleteEducation(${
            edu.id
          })" class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Delete</button>
        </div>
      </div>
    `;
    })
    .join("");
}

function handleAddEducation(e) {
  e.preventDefault();
  const formData = new FormData(e.target);

  fetch("/E-Portfolio/E-Portfolio/backend/api/education_api.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      closeEducationModal();
      loadEducationAdmin();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding education:", err));
}

async function deleteEducation(id) {
  const confirmed = await showConfirm(
    "Are you sure you want to delete this education record?",
    "Delete",
    "Cancel"
  );
  if (!confirmed) return;
  fetch("/E-Portfolio/E-Portfolio/backend/api/education_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      loadEducationAdmin();
    });
}

function openEducationModal() {
  const modal = document.getElementById("educationModal");
  modal.classList.remove("hidden");

  const form = document.getElementById("addEducationForm");
  if (form && !form.dataset.listenerAdded) {
    form.addEventListener("submit", handleAddEducation);
    form.dataset.listenerAdded = true;
  }
}

function closeEducationModal() {
  document.getElementById("educationModal").classList.add("hidden");
}

function editEducation(id) {
  // Find the education data
  fetch(`/E-Portfolio/E-Portfolio/backend/api/education_api.php?user_id=1`)
    .then((res) => res.json())
    .then((educationList) => {
      const education = educationList.find((e) => e.id == id);
      if (!education) return;

      // Show modal
      document.getElementById("editEducationModal").classList.remove("hidden");

      // Populate form fields
      document.getElementById("edit-education-id").value = education.id;
      document.getElementById("edit-education-institution").value =
        education.institution_name;
      document.getElementById("edit-education-degree").value = education.degree;
      document.getElementById("edit-education-field").value =
        education.field_of_study || "";
      document.getElementById("edit-education-location").value =
        education.location || "";
      document.getElementById("edit-education-gpa").value = education.gpa || "";
      document.getElementById("edit-education-start-date").value =
        education.start_date || "";
      document.getElementById("edit-education-end-date").value =
        education.end_date || "";
      document.getElementById("edit-education-description").value =
        education.description || "";
    });
}

function closeEditEducationModal() {
  document.getElementById("editEducationModal").classList.add("hidden");
  document.getElementById("edit-education-form").reset();
}

// Handle edit form submission
document.addEventListener("DOMContentLoaded", function () {
  const editForm = document.getElementById("edit-education-form");
  if (editForm) {
    editForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const data = {
        id: document.getElementById("edit-education-id").value,
        user_id: document.getElementById("edit-education-user-id").value,
        institution_name: document.getElementById("edit-education-institution")
          .value,
        degree: document.getElementById("edit-education-degree").value,
        field_of_study: document.getElementById("edit-education-field").value,
        location: document.getElementById("edit-education-location").value,
        gpa: document.getElementById("edit-education-gpa").value,
        start_date: document.getElementById("edit-education-start-date").value,
        end_date: document.getElementById("edit-education-end-date").value,
        description: document.getElementById("edit-education-description")
          .value,
      };

      try {
        const response = await fetch(
          "/E-Portfolio/E-Portfolio/backend/api/education_api.php",
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
            result.message || "Education updated successfully!",
            "success"
          );
          closeEditEducationModal();
          loadEducationAdmin();
        } else {
          showAlert(
            "Error updating education: " + (result.message || "Unknown error"),
            "error"
          );
        }
      } catch (error) {
        console.error("Error updating education:", error);
        showAlert("Failed to update education", "error");
      }
    });
  }
});
