function loadHobbies() {
  fetch("../../backend/api/hobbies_api.php?user_id=1")
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderHobbiesAsTimeline(data);
      } else {
        renderHobbiesAsTimeline([]);
      }
    })
    .catch((err) => {
      console.error("Error loading hobbies:", err);
      renderHobbiesAsTimeline([]);
    });
}

function renderHobbiesAsTimeline(data) {
  const container = document.getElementById("hobbyTimeline");
  if (!data || data.length === 0) {
    container.innerHTML = `<p class="text-gray-400 w-full text-center">No hobbies found.</p>`;
    return;
  }

  const hobbiesByYear = data.reduce((acc, hobby) => {
    const year = hobby.category || 'General';
    if (!acc[year]) {
      acc[year] = [];
    }
    acc[year].push(hobby);
    return acc;
  }, {});

  const sortedYears = Object.keys(hobbiesByYear).sort();

  const timelineHTML = `
    <div class="timeline-line"></div>
    <div class="timeline-events">
      ${sortedYears.map(year => `
        <div class="timeline-event" data-year="${year}">
          <div class="timeline-event-dot"></div>
          <div class="timeline-event-year">${year}</div>
        </div>
      `).join('')}
    </div>
  `;
  container.innerHTML = timelineHTML;

  const events = container.querySelectorAll('.timeline-event');
  events.forEach(event => {
    event.addEventListener('click', () => {
      const year = event.dataset.year;
      showHobbyDetails(hobbiesByYear[year], year);
      events.forEach(e => e.classList.remove('active'));
      event.classList.add('active');
    });
  });
  
  // Show details for the first year by default
  if(sortedYears.length > 0){
    showHobbyDetails(hobbiesByYear[sortedYears[0]], sortedYears[0]);
    const firstEvent = container.querySelector('.timeline-event');
    if(firstEvent) {
      firstEvent.classList.add('active');
    }
  }
}

function showHobbyDetails(hobbies, year) {
  const detailsContainer = document.getElementById('hobbyDetailsContainer');
  if (!hobbies || hobbies.length === 0) {
    detailsContainer.innerHTML = '';
    return;
  }

  detailsContainer.innerHTML = `
    <div class="hobby-details-card animate-fade-in">
      <h3 class="text-3xl font-bold text-white mb-4">Hobbies from ${year}</h3>
      <div class="space-y-4">
        ${hobbies.map(hobby => `
          <div class="flex items-center">
            ${hobby.icon ? `<img src="../src/imgs/hobbies/${hobby.icon}" class="w-10 h-10 rounded-full mr-4">` : `<div class="w-10 h-10 rounded-full bg-glass mr-4"></div>`}
            <div class="flex-grow">
              <p class="font-semibold text-lg">${hobby.hobby_name}</p>
              <div class="w-full bg-gray-700 h-2 rounded-full mt-1">
                <div class="bg-gradient-to-r from-blue-start to-purple-end h-2 rounded-full" style="width: ${hobby.proficiency}%"></div>
              </div>
            </div>
          </div>
        `).join('')}
      </div>
    </div>
  `;
}


function handleAddHobby(e) {
  e.preventDefault();
  const formData = new FormData(e.target);

  fetch("../../backend/api/hobbies_api.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
      closeHobbyModal();
      loadHobbies();
      e.target.reset();
    })
    .catch((err) => console.error("Error adding hobby:", err));
}

function deleteHobby(id) {
  if (!confirm("Delete this hobby?")) return;
  fetch("../../backend/api/hobbies_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      alert(res.message);
      loadHobbies();
    });
}

function editHobby(id) {}

function openHobbyModal() {
  const modal = document.getElementById("hobbyModal");
  modal.classList.remove("hidden");

  const form = document.getElementById("addHobbyForm");
  if (form && !form.dataset.listenerAdded) {
    form.addEventListener("submit", handleAddHobby);
    form.dataset.listenerAdded = true; // prevent double-attach
  }
}
function closeHobbyModal() {
  document.getElementById("hobbyModal").classList.add("hidden");
}
