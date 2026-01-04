function loadSkillsAdmin() {
  fetch("../../backend/api/skills_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderSkillsAdmin(data);
      } else {
        renderSkillsAdmin([]);
      }
    })
    .catch((err) => {
      console.error("Error loading skills:", err);
      renderSkillsAdmin([]);
    });
}

function renderSkillsAdmin(skills) {
  const container = document.getElementById("skillsList");
  
  if (!skills || skills.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center">No skills found. Click "Add Skill" to create one.</p>`;
    return;
  }

  // Group skills by type
  const technical = skills.filter(s => s.skill_type === 'technical');
  const soft = skills.filter(s => s.skill_type === 'soft');

  let html = '';
  
  if (technical.length > 0) {
    html += `
      <div class="mb-6">
        <h3 class="text-2xl font-bold text-white mb-4">Technical Skills</h3>
        <div class="space-y-2">
          ${technical.map(skill => renderSkillItem(skill)).join('')}
        </div>
      </div>
    `;
  }

  if (soft.length > 0) {
    html += `
      <div class="mb-6">
        <h3 class="text-2xl font-bold text-white mb-4">Soft Skills</h3>
        <div class="space-y-2">
          ${soft.map(skill => renderSkillItem(skill)).join('')}
        </div>
      </div>
    `;
  }

  container.innerHTML = html;
}

function renderSkillItem(skill) {
  return `
    <div class="bg-glass border border-gray-700 rounded-lg p-4 flex items-center justify-between">
      <div class="flex-grow">
        <div class="flex items-center space-x-3 mb-2">
          ${skill.icon ? `<img src="../src/imgs/skills/${skill.icon}" class="w-8 h-8 rounded">` : ''}
          <div>
            <h4 class="text-white font-bold">${skill.skill_name}</h4>
            ${skill.category ? `<span class="text-xs text-gray-500">${skill.category}</span>` : ''}
          </div>
        </div>
        <div class="w-full bg-gray-700 h-2 rounded-full">
          <div class="bg-gradient-to-r from-blue-start to-purple-end h-2 rounded-full" style="width: ${skill.proficiency}%"></div>
        </div>
        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-400">
          <span>Proficiency: ${skill.proficiency}%</span>
          ${skill.years_experience ? `<span>Experience: ${skill.years_experience} years</span>` : ''}
        </div>
      </div>
      <button onclick="deleteSkill(${skill.id})" class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Delete</button>
    </div>
  `;
}

function handleAddSkill(e) {
  e.preventDefault();
  const formData = new FormData(e.target);

  fetch("../../backend/api/skills_api.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
      closeSkillModal();
      loadSkillsAdmin();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding skill:", err));
}

function deleteSkill(id) {
  if (!confirm("Delete this skill?")) return;
  fetch("../../backend/api/skills_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
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
