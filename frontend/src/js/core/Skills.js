function loadSkills() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/skills_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderSkills(data);
      } else {
        renderSkills([]);
      }
    })
    .catch((err) => {
      console.error("Error loading skills:", err);
      renderSkills([]);
    });
}

function renderSkills(skills) {
  const technicalContainer = document.getElementById("technicalSkills");
  const softContainer = document.getElementById("softSkills");

  if (!skills || skills.length === 0) {
    technicalContainer.innerHTML = `<p class="text-gray-400 text-center col-span-full">No skills found.</p>`;
    softContainer.innerHTML = `<p class="text-gray-400 text-center col-span-full">No skills found.</p>`;
    return;
  }

  // Separate technical and soft skills
  const technicalSkills = skills.filter((s) => s.skill_type === "technical");
  const softSkills = skills.filter((s) => s.skill_type === "soft");

  // Render technical skills
  if (technicalSkills.length > 0) {
    technicalContainer.innerHTML = technicalSkills
      .map((skill) => renderSkillCard(skill))
      .join("");
  } else {
    technicalContainer.innerHTML = `<p class="text-gray-400 text-center col-span-full">No technical skills found.</p>`;
  }

  // Render soft skills
  if (softSkills.length > 0) {
    softContainer.innerHTML = softSkills
      .map((skill) => renderSkillCard(skill))
      .join("");
  } else {
    softContainer.innerHTML = `<p class="text-gray-400 text-center col-span-full">No soft skills found.</p>`;
  }
}

function renderSkillCard(skill) {
  const iconHtml = skill.icon
    ? `<img src="src/imgs/skills/${skill.icon}" alt="${skill.skill_name}" class="w-12 h-12 rounded-lg mb-3">`
    : `<div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-start to-purple-end mb-3 flex items-center justify-center text-2xl font-bold">${skill.skill_name.charAt(
        0
      )}</div>`;

  return `
    <div class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
      ${iconHtml}
      <h3 class="text-xl font-bold text-white mb-2">${skill.skill_name}</h3>
      ${
        skill.category
          ? `<p class="text-sm text-gray-400 mb-3">${skill.category}</p>`
          : ""
      }
      
      <div class="mb-4">
        <div class="flex justify-between items-center mb-1">
          <span class="text-sm text-gray-300">Proficiency</span>
          <span class="text-sm text-white font-bold">${
            skill.proficiency
          }%</span>
        </div>
        <div class="w-full bg-gray-700 h-2 rounded-full overflow-hidden">
          <div class="bg-gradient-to-r from-blue-start to-purple-end h-2 rounded-full transition-all duration-500" style="width: ${
            skill.proficiency
          }%"></div>
        </div>
      </div>

      ${
        skill.years_experience
          ? `
        <div class="flex items-center text-sm text-gray-400">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          ${skill.years_experience} years experience
        </div>
      `
          : ""
      }

      ${
        skill.description
          ? `<p class="text-gray-300 text-sm mt-3">${skill.description}</p>`
          : ""
      }
    </div>
  `;
}
