// Initialize pagination
let pagination;

function initializePagination() {
  pagination = new PaginationManager({
    itemsPerPage: 10,
    defaultSort: "title",
    searchFields: ["title", "description", "tags", "status"],
    renderCallback: renderProjectsAdmin,
    containerId: "projectsList",
    paginationId: "projectsPagination",
    searchInputId: "projectSearch",
    itemsPerPageId: "projectsPerPage",
    sortSelectId: "projectSort",
  });

  // Render search and filter UI
  const searchContainer = document.getElementById("searchFilterContainer");
  if (searchContainer) {
    searchContainer.innerHTML = pagination.renderSearchAndFilters({
      searchPlaceholder: "Search projects by title, description, tags...",
      sortOptions: [
        { value: "title", label: "Title (A-Z)" },
        { value: "created_at", label: "Date Created" },
        { value: "start_date", label: "Start Date" },
        { value: "featured", label: "Featured" },
      ],
      filterSelects: [
        {
          field: "status",
          label: "All Statuses",
          options: [
            { value: "completed", label: "Completed" },
            { value: "in_progress", label: "In Progress" },
            { value: "on_hold", label: "On Hold" },
          ],
        },
        {
          field: "featured",
          label: "All Projects",
          options: [
            { value: "1", label: "Featured Only" },
            { value: "0", label: "Non-Featured" },
          ],
        },
      ],
    });
  }
}

function loadProjectsAdmin() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/projects_api.php?user_id=1")
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
      console.error("Error loading projects:", err);
      if (!pagination) {
        initializePagination();
      }
      pagination.setItems([]);
    });
}

function renderProjectsAdmin(projects) {
  const container = document.getElementById("projectsList");

  if (!projects || projects.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center py-8">No projects found matching your criteria.</p>`;
    return;
  }

  container.innerHTML = projects
    .map((project) => {
      const imageUrl = project.image_preview
        ? `src/imgs/projects/${project.image_preview}`
        : "https://via.placeholder.com/100x60";

      return `
      <div class="bg-glass border border-gray-700 rounded-lg p-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="${imageUrl}" alt="${
        project.title
      }" class="w-20 h-12 object-cover rounded">
          <div>
            <h3 class="text-white font-bold">${project.title}</h3>
            <p class="text-gray-400 text-sm">${project.description.substring(
              0,
              100
            )}${project.description.length > 100 ? "..." : ""}</p>
            <div class="flex items-center space-x-2 mt-1">
              ${
                project.featured == 1
                  ? '<span class="text-xs bg-blue-start text-white px-2 py-1 rounded">Featured</span>'
                  : ""
              }
              <span class="text-xs text-gray-500">${project.status}</span>
            </div>
          </div>
        </div>
        <div class="flex space-x-2">
          <button onclick="editProject(${
            project.id
          })" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Edit</button>
          <button onclick="deleteProject(${
            project.id
          })" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Delete</button>
        </div>
      </div>
    `;
    })
    .join("");
}

function handleAddProject(e) {
  e.preventDefault();
  const formData = new FormData(e.target);

  fetch("/E-Portfolio/E-Portfolio/backend/api/projects_api.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      closeProjectModal();
      loadProjectsAdmin();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding project:", err));
}

async function deleteProject(id) {
  const confirmed = await showConfirm(
    "Are you sure you want to delete this project?",
    "Delete",
    "Cancel"
  );
  if (!confirmed) return;
  fetch("/E-Portfolio/E-Portfolio/backend/api/projects_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      loadProjectsAdmin();
    });
}

function openProjectModal() {
  const modal = document.getElementById("projectModal");
  modal.classList.remove("hidden");

  const form = document.getElementById("addProjectForm");
  if (form && !form.dataset.listenerAdded) {
    form.addEventListener("submit", handleAddProject);
    form.dataset.listenerAdded = true;
  }
}

function closeProjectModal() {
  document.getElementById("projectModal").classList.add("hidden");
}

function editProject(id) {
  // Find the project data
  fetch(`/E-Portfolio/E-Portfolio/backend/api/projects_api.php?user_id=1`)
    .then((res) => res.json())
    .then((projects) => {
      const project = projects.find((p) => p.id == id);
      if (!project) return;

      // Show modal
      document.getElementById("editProjectModal").classList.remove("hidden");

      // Populate form fields
      document.getElementById("edit-project-id").value = project.id;
      document.getElementById("edit-project-title").value = project.title;
      document.getElementById("edit-project-description").value =
        project.description;
      document.getElementById("edit-project-url").value =
        project.project_url || "";
      document.getElementById("edit-project-github").value =
        project.github_url || "";
      document.getElementById("edit-project-demo").value =
        project.demo_url || "";
      document.getElementById("edit-project-tags").value = project.tags || "";
      document.getElementById("edit-project-start-date").value =
        project.start_date || "";
      document.getElementById("edit-project-end-date").value =
        project.end_date || "";
      document.getElementById("edit-project-status").value =
        project.status || "completed";
      document.getElementById("edit-project-featured").value =
        project.featured || "0";
      document.getElementById("edit-project-display-order").value =
        project.display_order || "0";
    });
}

function closeEditProjectModal() {
  document.getElementById("editProjectModal").classList.add("hidden");
  document.getElementById("edit-project-form").reset();
}

// Handle edit form submission
document.addEventListener("DOMContentLoaded", function () {
  const editForm = document.getElementById("edit-project-form");
  if (editForm) {
    editForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const data = {
        id: document.getElementById("edit-project-id").value,
        user_id: document.getElementById("edit-project-user-id").value,
        title: document.getElementById("edit-project-title").value,
        description: document.getElementById("edit-project-description").value,
        project_url: document.getElementById("edit-project-url").value,
        github_url: document.getElementById("edit-project-github").value,
        demo_url: document.getElementById("edit-project-demo").value,
        tags: document.getElementById("edit-project-tags").value,
        start_date: document.getElementById("edit-project-start-date").value,
        end_date: document.getElementById("edit-project-end-date").value,
        status: document.getElementById("edit-project-status").value,
        featured: document.getElementById("edit-project-featured").value,
        display_order: document.getElementById("edit-project-display-order")
          .value,
      };

      try {
        const response = await fetch(
          "/E-Portfolio/E-Portfolio/backend/api/projects_api.php",
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
            result.message || "Project updated successfully!",
            "success"
          );
          closeEditProjectModal();
          loadProjectsAdmin();
        } else {
          showAlert(
            "Error updating project: " + (result.message || "Unknown error"),
            "error"
          );
        }
      } catch (error) {
        console.error("Error updating project:", error);
        showAlert("Failed to update project", "error");
      }
    });
  }
});
