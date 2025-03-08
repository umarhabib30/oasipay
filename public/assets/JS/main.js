// document.addEventListener('DOMContentLoaded', function () {
//     const menuToggle = document.getElementById('menu-toggle');
//     const menu = document.getElementById('menu');
//     const languageBtn = document.getElementById('language-btn');
//     const languageMenu = document.getElementById('language-menu');
//     const currentFlag = document.getElementById('current-flag');
    
//     // Toggle the menu visibility
//     menuToggle.addEventListener('click', function () {
//       // Close language menu if it's open
//       if (languageMenu.classList.contains('show')) {
//         languageMenu.classList.remove('show');
//       }
//       // Toggle menu visibility
//       menu.classList.toggle('show');
//     });
  
//     // Toggle the language dropdown visibility
//     languageBtn.addEventListener('click', function () {
//       // Close menu if it's open
//       if (menu.classList.contains('show')) {
//         menu.classList.remove('show');
//       }
//       // Toggle language dropdown visibility
//       languageMenu.classList.toggle('show');
//     });
  
//     // When a language option is clicked, update the flag and close the dropdown
//     languageMenu.addEventListener('click', function (e) {
//       if (e.target && e.target.tagName === 'A') {
//         // Get the selected flag and language
//         const selectedFlag = e.target.getAttribute('data-flag');
//         const selectedLang = e.target.getAttribute('data-lang');
        
//         // Update the flag image
//         currentFlag.src = selectedFlag;
        
//         // Close the dropdown
//         languageMenu.classList.remove('show');
//       }
//     });
  
//     // Close both menu and language dropdown if clicked outside
//     window.addEventListener('click', function (e) {
//       if (!menuToggle.contains(e.target) && !menu.contains(e.target)) {
//         menu.classList.remove('show');
//       }
  
//       if (!languageBtn.contains(e.target) && !languageMenu.contains(e.target)) {
//         languageMenu.classList.remove('show');
//       }
//     });
//   });

document.addEventListener("DOMContentLoaded", () => {
  function initHeaderScripts() {
      const menuToggle = document.getElementById('menu-toggle');
      const menu = document.getElementById('menu');
      const languageBtn = document.getElementById('language-btn');
      const languageMenu = document.getElementById('language-menu');
      const currentFlag = document.getElementById('current-flag');

      if (!menuToggle || !menu || !languageBtn || !languageMenu || !currentFlag) {
          setTimeout(initHeaderScripts, 500); // Retry after 500ms if elements not found
          return;
      }

      menuToggle.addEventListener('click', () => {
          if (languageMenu.classList.contains('show')) {
              languageMenu.classList.remove('show');
          }
          menu.classList.toggle('show');
      });

      languageBtn.addEventListener('click', () => {
          if (menu.classList.contains('show')) {
              menu.classList.remove('show');
          }
          languageMenu.classList.toggle('show');
      });

      languageMenu.addEventListener('click', (e) => {
          if (e.target && e.target.tagName === 'A') {
              const selectedFlag = e.target.getAttribute('data-flag');
              currentFlag.src = selectedFlag;
              languageMenu.classList.remove('show');
          }
      });

      window.addEventListener('click', (e) => {
          if (!menuToggle.contains(e.target) && !menu.contains(e.target)) {
              menu.classList.remove('show');
          }
          if (!languageBtn.contains(e.target) && !languageMenu.contains(e.target)) {
              languageMenu.classList.remove('show');
          }
      });
  }

  setTimeout(initHeaderScripts, 500);
});


// Get the button


document.addEventListener("DOMContentLoaded", function () {
  const scrollToTopBtn = document.querySelector(".scroll-to-top");
  const footer = document.querySelector("#footer");

  function handleScroll() {
      const footerTop = footer.getBoundingClientRect().top;
      const windowHeight = window.innerHeight;

      // Show or hide the button based on scroll position
      if (document.documentElement.scrollTop > 100) {
          scrollToTopBtn.style.display = "block";
      } else {
          scrollToTopBtn.style.display = "none";
      }

      // Prevent the button from scrolling into the footer
      if (footerTop < windowHeight) {
          scrollToTopBtn.style.bottom = `${windowHeight - footerTop + 20}px`; // Adjusts to stay above the footer
      } else {
          scrollToTopBtn.style.bottom = "20px"; // Default position
      }
  }

  // Scroll event listener
  window.addEventListener("scroll", handleScroll);

  // Scroll to top when button is clicked
  scrollToTopBtn.addEventListener("click", function () {
      window.scrollTo({
          top: 0,
          behavior: "smooth"
      });
  });

  // Initial check in case page is already scrolled
  handleScroll();
});


document.addEventListener("DOMContentLoaded", () => {
  const video = document.getElementById("videoElement");

  // Ensure controls are hidden
  video.controls = false;

  // Safari-specific autoplay handling
  const playVideo = () => {
    video.muted = true; // Safari requires muted for autoplay
    video.play()
      .then(() => {
        console.log("Video autoplayed successfully!");
      })
      .catch((error) => {
        console.error("Autoplay failed:", error);
      });
  };

  // Check if autoplay works natively; fallback for Safari
  if (video.readyState >= 3) {
    playVideo();
  } else {
    video.addEventListener("canplay", playVideo);
  }

  // Optionally block user interaction with the video
  video.style.pointerEvents = "none";
});


document.addEventListener("DOMContentLoaded", () => {
  const video = document.getElementById("videoElement");

  // Ensure controls are hidden
  video.controls = false;

  // Safari-specific autoplay handling
  const playVideo = () => {
    video.muted = true; // Safari requires muted for autoplay
    video.play()
      .then(() => {
        console.log("Video autoplayed successfully!");
      })
      .catch((error) => {
        console.error("Autoplay failed:", error);
      });
  };

  // Check if autoplay works natively; fallback for Safari
  if (video.readyState >= 3) {
    playVideo();
  } else {
    video.addEventListener("canplay", playVideo);
  }

  // Optionally block user interaction with the video
  video.style.pointerEvents = "none";
});

  // Function to toggle the dropdown menu
  function toggleTellUsDropdown() {
    // Select the dropdown container
    const dropdown = document.querySelector('.tell-us-dropdown');

    // Toggle the 'open' class on the dropdown container
    dropdown.classList.toggle('open');
  }

  // Function to set the clicked item as active
  function setActive(item) {
    // Remove active class from all items
    let items = document.querySelectorAll('.tell-us-item');
    items.forEach(function(i) {
      i.classList.remove('active');
    });

    // Add active class to clicked item
    item.classList.add('active');
  }


const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(item => {
  const question = item.querySelector('.faq-question');
  const answer = item.querySelector('.faq-answer');

  question.addEventListener('click', () => {
    // Toggle the current item's visibility
    const isOpen = answer.style.maxHeight;
    answer.style.maxHeight = isOpen ? null : answer.scrollHeight + "px";
  });
});

document.addEventListener("DOMContentLoaded", () => {
  function toggleInputs(selectedRadio, disableSelectors, enableSelectors) {
    document.getElementById(selectedRadio).addEventListener("change", function () {
      if (this.checked) {
        // Disable and clear inputs
        document.querySelectorAll(disableSelectors).forEach(input => {
          input.disabled = true;
          input.value = ""; // Clear input field
        });

        // Enable inputs
        document.querySelectorAll(enableSelectors).forEach(input => input.disabled = false);
      }
    });
  }

  // Initial setup: Disable all fields by default
  document.querySelectorAll("#BIC-Swift, #IBAN, #account-holder, #Insert-buyer-code")
    .forEach(input => input.disabled = true);

  // Attach toggle functionality
  toggleInputs("paypalRadio", "#BIC-Swift, #IBAN, #account-holder", "#Insert-buyer-code");
  toggleInputs("swift", "#Insert-buyer-code", "#BIC-Swift, #IBAN, #account-holder");
});



