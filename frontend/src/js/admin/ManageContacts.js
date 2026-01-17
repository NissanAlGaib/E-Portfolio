let currentFilter = "all";

function loadContactsAdmin(status = null) {
  const url = status
    ? `../../backend/api/contacts_api.php?status=${status}`
    : "../../backend/api/contacts_api.php";

  fetch(url)
    .then((res) => res.json())
    .then((data) => {
      if (data && !data.message) {
        renderContactsAdmin(data);
      } else {
        renderContactsAdmin([]);
      }
    })
    .catch((err) => {
      console.error("Error loading contacts:", err);
      renderContactsAdmin([]);
    });
}

function renderContactsAdmin(contacts) {
  const container = document.getElementById("contactsList");

  if (!contacts || contacts.length === 0) {
    container.innerHTML = `<p class="text-gray-400 text-center">No contact messages found.</p>`;
    return;
  }

  container.innerHTML = contacts
    .map((contact) => {
      const date = new Date(contact.created_at).toLocaleString();
      const statusColor =
        {
          new: "bg-blue-500",
          read: "bg-yellow-500",
          replied: "bg-green-500",
          archived: "bg-gray-500",
        }[contact.status] || "bg-gray-500";

      return `
      <div class="bg-glass border border-gray-700 rounded-lg p-4">
        <div class="flex items-start justify-between mb-2">
          <div>
            <h3 class="text-white font-bold">${contact.name}</h3>
            <p class="text-gray-400 text-sm">${contact.email}</p>
          </div>
          <div class="flex items-center space-x-2">
            <span class="${statusColor} text-white text-xs px-2 py-1 rounded">${
        contact.status
      }</span>
            <span class="text-gray-500 text-xs">${date}</span>
          </div>
        </div>
        ${
          contact.subject
            ? `<h4 class="text-white font-semibold mb-2">${contact.subject}</h4>`
            : ""
        }
        <p class="text-gray-300 mb-3">${contact.message}</p>
        <div class="flex space-x-2">
          ${
            contact.status === "new"
              ? `<button onclick="updateContactStatus(${contact.id}, 'read')" class="px-3 py-1 bg-yellow-600 text-white text-sm rounded hover:bg-yellow-700 transition-colors">Mark as Read</button>`
              : ""
          }
          ${
            contact.status === "read"
              ? `<button onclick="updateContactStatus(${contact.id}, 'replied')" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition-colors">Mark as Replied</button>`
              : ""
          }
          <button onclick="deleteContact(${
            contact.id
          })" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition-colors">Delete</button>
        </div>
      </div>
    `;
    })
    .join("");
}

function updateContactStatus(id, status) {
  fetch("/E-Portfolio/E-Portfolio/backend/api/contacts_api.php", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id, status }),
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      loadContactsAdmin(currentFilter === "all" ? null : currentFilter);
    })
    .catch((err) => console.error("Error updating contact:", err));
}

async function deleteContact(id) {
  const confirmed = await showConfirm(
    "Are you sure you want to delete this contact message?",
    "Delete",
    "Cancel"
  );
  if (!confirmed) return;
  fetch("/E-Portfolio/E-Portfolio/backend/api/contacts_api.php", {
    method: "DELETE",
    body: `id=${id}`,
  })
    .then((res) => res.json())
    .then((res) => {
      showAlert(res.message, res.success ? "success" : "error");
      loadContactsAdmin(currentFilter === "all" ? null : currentFilter);
    });
}

function filterContacts(status) {
  currentFilter = status;
  loadContactsAdmin(status === "all" ? null : status);
}
