function loadEducationAdmin() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/education_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderEducationAdmin(data);
      } else {
        renderEducationAdmin([]);
      }
    })
    .catch((err) => {
      console.error("Error loading education:", err);
      renderEducationAdmin([]);
    });
}

function renderEducationAdmin(education) {
  const container = document.getElementById("educationList");

  if (!education || education.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center">No education records found. Click "Add Education" to create one.</p>`;
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
        <button onclick="deleteEducation(${
          edu.id
        })" class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Delete</button>
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
      alert(res.message);
      closeEducationModal();
      loadEducationAdmin();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding education:", err));
}

function deleteEducation(id) {
  if (!confirm("Delete this education record?")) return;
  fetch("/E-Portfolio/E-Portfolio/backend/api/education_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
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
