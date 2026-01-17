document.addEventListener("DOMContentLoaded", () => {
  const splash = document.getElementById("splash");
  const particleCanvas = document.getElementById("particle-canvas");

  const splashShown = sessionStorage.getItem("splashShown_v2");

  if (!splashShown && splash) {
    if (particleCanvas) {
      initParticles(particleCanvas);
    }
    setTimeout(() => {
      splash.style.opacity = "0";
      setTimeout(() => splash.remove(), 1000);
    }, 3000); // Show splash for 3 seconds
    sessionStorage.setItem("splashShown_v2", "true");
  } else {
    if (splash) splash.remove();
  }

  // Load hobbies if on hobbies page
  const currentPage = new URLSearchParams(window.location.search).get("page");
  if (currentPage === "hobbies" && typeof loadHobbies === "function") {
    loadHobbies();
  }
});
