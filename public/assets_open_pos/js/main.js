document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab");
  const candidacyForm = document.getElementById("candidacy-form");
  const positionName = document.getElementById("position-name");
  const privacyLink = document.querySelectorAll(".privacy-link");
  const privacyModal = document.getElementById("privacy-modal");
  const closeBtn = document.querySelector(".close-btn");

  // Show candidacy form on tab click
  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const position = tab.getAttribute("data-position");
      positionName.textContent =
        position.charAt(0).toUpperCase() + position.slice(1);

      // Activate the candidacy form and show the selected position description
      candidacyForm.classList.add("active");

      // Show the corresponding position description
      document.querySelectorAll(".tab-description div").forEach((desc) => {
        desc.classList.remove("active");
      });
      document.getElementById(`${position}-desc`).classList.add("active");
    });
  });

  // Handle privacy modal
  privacyLink.forEach((link) => {
    link.addEventListener("click", () => {
      privacyModal.style.display = "flex";
    });
  });

  closeBtn.addEventListener("click", () => {
    privacyModal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === privacyModal) {
      privacyModal.style.display = "none";
    }
  });
});



