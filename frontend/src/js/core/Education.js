function loadEducation() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/education_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderEducation(data);
      } else {
        renderEducation([]);
      }
    })
    .catch((err) => {
      console.error("Error loading education:", err);
      renderEducation([]);
    });
}

function renderEducation(education) {
  const container = document.getElementById("educationContainer");

  if (!education || education.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center">No education records found.</p>`;
    return;
  }

  container.innerHTML = education
    .map((edu) => renderEducationCard(edu))
    .join("");
}

function renderEducationCard(edu) {
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
    <div class="bg-glass border border-gray-700 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
      <div class="flex items-start space-x-6">
        ${
          logoUrl
            ? `
          <div class="flex-shrink-0">
            <img src="${logoUrl}" alt="${edu.institution_name}" class="w-20 h-20 object-contain rounded-lg">
          </div>
        `
            : `
          <div class="flex-shrink-0">
            <div class="w-20 h-20 bg-gradient-to-r from-blue-start to-purple-end rounded-lg flex items-center justify-center text-3xl font-bold text-white">
              ${edu.institution_name.charAt(0)}
            </div>
          </div>
        `
        }
        
        <div class="flex-grow">
          <h3 class="text-2xl font-bold text-white mb-1">${
            edu.institution_name
          }</h3>
          <p class="text-xl text-gray-300 mb-2">${edu.degree}${
    edu.field_of_study ? " in " + edu.field_of_study : ""
  }</p>
          
          <div class="flex flex-wrap items-center gap-4 mb-3 text-sm text-gray-400">
            ${
              edu.location
                ? `
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                ${edu.location}
              </span>
            `
                : ""
            }
            
            ${
              startDate
                ? `
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                ${startDate} - ${endDate}
              </span>
            `
                : ""
            }
            
            ${
              edu.gpa
                ? `
              <span class="flex items-center bg-blue-start bg-opacity-20 px-3 py-1 rounded-full">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                GPA: ${edu.gpa}
              </span>
            `
                : ""
            }
          </div>

          ${
            edu.description
              ? `
            <p class="text-gray-300 mt-3">${edu.description}</p>
          `
              : ""
          }
        </div>
      </div>
    </div>
  `;
}
