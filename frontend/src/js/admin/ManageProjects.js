function loadProjectsAdmin() {
  fetch("../../backend/api/projects_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderProjectsAdmin(data);
      } else {
        renderProjectsAdmin([]);
      }
    })
    .catch((err) => {
      console.error("Error loading projects:", err);
      renderProjectsAdmin([]);
    });
}

function renderProjectsAdmin(projects) {
  const container = document.getElementById("projectsList");
  
  if (!projects || projects.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center">No projects found. Click "Add Project" to create one.</p>`;
    return;
  }

  container.innerHTML = projects.map(project => {
    const imageUrl = project.image_preview 
      ? `../src/imgs/projects/${project.image_preview}` 
      : 'https://via.placeholder.com/100x60';
    
    return `
      <div class="bg-glass border border-gray-700 rounded-lg p-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="${imageUrl}" alt="${project.title}" class="w-20 h-12 object-cover rounded">
          <div>
            <h3 class="text-white font-bold">${project.title}</h3>
            <p class="text-gray-400 text-sm">${project.description.substring(0, 100)}${project.description.length > 100 ? '...' : ''}</p>
            <div class="flex items-center space-x-2 mt-1">
              ${project.featured ? '<span class="text-xs bg-blue-start text-white px-2 py-1 rounded">Featured</span>' : ''}
              <span class="text-xs text-gray-500">${project.status}</span>
            </div>
          </div>
        </div>
        <div class="flex space-x-2">
          <button onclick="deleteProject(${project.id})" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Delete</button>
        </div>
      </div>
    `;
  }).join('');
}

function handleAddProject(e) {
  e.preventDefault();
  const formData = new FormData(e.target);

  fetch("../../backend/api/projects_api.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
      closeProjectModal();
      loadProjectsAdmin();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding project:", err));
}

function deleteProject(id) {
  if (!confirm("Delete this project?")) return;
  fetch("../../backend/api/projects_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
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
