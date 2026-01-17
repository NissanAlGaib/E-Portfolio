function loadUserData() {
  fetch("/E-Portfolio/E-Portfolio/backend/api/user_api.php")
    .then((response) => {
      if (!response.ok) throw new Error("Network response was not OK");
      return response.json();
    })
    .then((data) => {
      const profile = document.getElementById("userName");
      if (!profile) return;

      if (!data || Object.keys(data).length === 0) {
        profile.textContent = "No user data found";
        profile.classList.add("text-gray-400");
        return;
      }
      profile.textContent = `${data.first_name} ${data.middle_initial}. ${data.last_name}`;

      const role = document.getElementById("userRole");
      if (role) {
        role.textContent = data.job_title || "User";
      }
    })
    .catch((err) => {
      console.error("Error loading user data:", err);
      const profile = document.getElementById("userName");
      if (profile) {
        profile.textContent = "Error loading user info";
        profile.classList.add("text-red-500");
      }
    });
}
