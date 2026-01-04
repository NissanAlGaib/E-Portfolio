document.addEventListener("DOMContentLoaded", () => {
  const splash = document.getElementById("splash");
  const particleCanvas = document.getElementById("particle-canvas");
  const mainContent = document.getElementById("mainContent");

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

  function loadPage(page, pushState = true) {
    mainContent.classList.remove('animate-fade-in');
    mainContent.classList.add('animate-fade-out');

    const handleFadeOut = () => {
      mainContent.removeEventListener('animationend', handleFadeOut);

      mainContent.innerHTML = `<div class="flex justify-center items-center h-full">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-end"></div>
        </div>`;

      fetch(`pages/${page}`)
        .then((response) => {
          if (!response.ok) throw new Error("Page not found");
          return response.text();
        })
        .then((html) => {
          mainContent.innerHTML = html;
          mainContent.classList.remove('animate-fade-out');
          mainContent.classList.add('animate-fade-in');

          if (pushState) {
            history.pushState({ page }, "", `#${page}`);
          }
          localStorage.setItem("activePage", page);
          setActive(document.querySelector(`[data-page="${page}"]`));

          if (page === "hobbies.php") {
            loadHobbies();
          }
        })
        .catch((err) => {
          mainContent.innerHTML = `<p class='text-red-500'>Error loading page: ${err.message}</p>`;
          mainContent.classList.remove('animate-fade-out');
          mainContent.classList.add('animate-fade-in');
        });
    };

    mainContent.addEventListener('animationend', handleFadeOut);
  }

  function setActive(link) {
    if (!link) return;
    const links = document.querySelectorAll('.dock-item');
    links.forEach(item => {
        item.classList.remove('active');
    });
    link.classList.add('active');
  }

  document.body.addEventListener('click', (e) => {
    const link = e.target.closest('.ajax-link');
    if (link) {
      e.preventDefault();
      const page = link.getAttribute('data-page');
      if (page !== localStorage.getItem('activePage')) {
        loadPage(page);
      }
    }
  });
  
  window.addEventListener('popstate', (e) => {
    if (e.state && e.state.page) {
        loadPage(e.state.page, false);
    }
  });

  const savedPage = localStorage.getItem("activePage") || "home.php";
  loadPage(savedPage);
});
