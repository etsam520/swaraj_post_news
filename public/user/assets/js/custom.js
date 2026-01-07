// State to Districts mapping
const districts = {
  Maharashtra: ["Mumbai", "Pune", "Nagpur", "Nashik"],
  "Uttar Pradesh": ["Lucknow", "Kanpur", "Varanasi", "Agra"],
  Bihar: ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur"],
  "West Bengal": ["Kolkata", "Howrah", "Darjeeling", "Siliguri"],
};

document.addEventListener("DOMContentLoaded", function () {
  const stateDropdown = document.getElementById("stateDropdown");
  const stateMenu = stateDropdown.nextElementSibling;
  const districtMenu = document.getElementById("districtMenu");

  // Show district submenu on hover
  stateMenu.querySelectorAll(".dropdown-item").forEach((item) => {
    item.addEventListener("mouseenter", function (e) {
      const state = this.getAttribute("data-state");
      if (districts[state]) {
        districtMenu.innerHTML = "";
        districts[state].forEach((district) => {
          const a = document.createElement("a");
          a.className = "dropdown-item";
          a.href = "#";
          a.textContent = district;
          a.onclick = function (ev) {
            ev.preventDefault();
            stateDropdown.innerHTML = `<i class="fas fa-map-marker-alt mr-2"></i> ${state} - ${district}`;
            stateMenu.style.display = "none";
            districtMenu.style.display = "none";
          };
          districtMenu.appendChild(a);
        });
        districtMenu.style.display = "block";
      }
    });
  });

  // Show state menu on button click
  stateDropdown.addEventListener("click", function (e) {
    e.stopPropagation();
    stateMenu.style.display =
      stateMenu.style.display === "block" ? "none" : "block";
    districtMenu.style.display = "none";
  });

  // Hide menus when clicking outside
  document.addEventListener("click", function (e) {
    if (!stateDropdown.parentNode.contains(e.target)) {
      stateMenu.style.display = "none";
      districtMenu.style.display = "none";
    }
  });
});

// SIDEBAR
document.addEventListener("DOMContentLoaded", function () {
  var offcanvasBtns = document.querySelectorAll('[data-toggle="offcanvas"]');
  var offcanvas = document.getElementById("rightOffcanvas");
  var closeBtn = offcanvas.querySelector('[data-dismiss="offcanvas"]');
  var isOpen = false;

  function openOffcanvas() {
    if (!isOpen) {
      offcanvas.classList.add("show");
      document.body.classList.add("offcanvas-open");
      isOpen = true;
    }
  }
  function closeOffcanvas() {
    if (isOpen) {
      offcanvas.classList.remove("show");
      document.body.classList.remove("offcanvas-open");
      isOpen = false;
    }
  }

  offcanvasBtns.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      openOffcanvas();
    });
  });
  if (closeBtn) {
    closeBtn.addEventListener("click", function (e) {
      e.preventDefault();
      closeOffcanvas();
    });
  }
  // Close on backdrop click
  document.addEventListener("mousedown", function (e) {
    if (
      isOpen &&
      !offcanvas.contains(e.target) &&
      !Array.from(offcanvasBtns).some((btn) => btn.contains(e.target))
    ) {
      closeOffcanvas();
    }
  });
  // Close on ESC
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && isOpen) {
      closeOffcanvas();
    }
  });
  // Close offcanvas when modal opens
  document
    .querySelectorAll('[data-toggle="modal"]')
    .forEach(function (modalBtn) {
      modalBtn.addEventListener("click", function () {
        closeOffcanvas();
      });
    });
});

// INDEX PAGE TOP NEWS
document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper(".news-swiper", {
    slidesPerView: 1,
    spaceBetween: 12,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      1200: { slidesPerView: 4 },
      992: { slidesPerView: 2 },
      600: { slidesPerView: 1 },
    },
  });
});

// INDEX PAGE IMAGE BULLETIN
document.addEventListener("DOMContentLoaded", function () {
  new Swiper(".featured-news-swiper", {
    slidesPerView: 1,
    navigation: {
      nextEl: ".featured-news-swiper .swiper-button-next",
      prevEl: ".featured-news-swiper .swiper-button-prev",
    },
    loop: true,
  });
});

// INDEX PAGE VIDEO SECTION
const videos = [
  {
    id: "VIDEO_ID_1",
    title:
      "MP Sudhakar Singh made serious allegations against the Rural Works...",
  },
  {
    id: "VIDEO_ID_2",
    title: "Nitish Kumar's big announcement in Bihar Assembly",
  },
  {
    id: "VIDEO_ID_3",
    title: "Breaking: New policy for farmers announced",
  },
];

// Render video list
document.addEventListener("DOMContentLoaded", function () {
  const list = document.querySelector(".video-list");
  if (list) {
    list.innerHTML = videos
      .map(
        (v, i) => `
                <div class="video-list-item${
                  i === 0 ? " active" : ""
                }" data-index="${i}" style="display:flex; align-items:center; gap:14px; padding:10px 18px; border-radius:${
          i === 0 ? "10px 10px 0 0" : "0"
        }; background:${i === 0 ? "#333" : "transparent"};">
                    <img src="https://img.youtube.com/vi/${
                      v.id
                    }/mqdefault.jpg" alt="thumb" style="width:56px; height:56px; border-radius:8px; object-fit:cover;">
                    <div style="color:#fff; font-size:1rem; font-weight:500; line-height:1.3;">
                        ${v.title}
                    </div>
                </div>
            `
      )
      .join("");
  }

  let current = 0;
  const iframe = document.getElementById("main-video-iframe");
  function updatePlayer(idx) {
    current = idx;
    iframe.src = `https://www.youtube.com/embed/${videos[idx].id}`;
    document.querySelectorAll(".video-list-item").forEach((el, i) => {
      el.classList.toggle("active", i === idx);
      el.style.background = i === idx ? "#333" : "transparent";
    });
  }

  document.querySelectorAll(".video-list-item").forEach((el, i) => {
    el.addEventListener("click", () => updatePlayer(i));
  });

  document.querySelector(".video-prev-btn").onclick = function () {
    let idx = (current - 1 + videos.length) % videos.length;
    updatePlayer(idx);
  };
  document.querySelector(".video-next-btn").onclick = function () {
    let idx = (current + 1) % videos.length;
    updatePlayer(idx);
  };
});

// INDEX PAGE VISUAL STORIES
document.addEventListener("DOMContentLoaded", function () {
  new Swiper(".visual-stories-swiper", {
    slidesPerView: 5,
    spaceBetween: 18,
    navigation: {
      nextEl: ".visual-stories-swiper .swiper-button-next",
      prevEl: ".visual-stories-swiper .swiper-button-prev",
    },
    breakpoints: {
      1200: { slidesPerView: 6 },
      992: { slidesPerView: 4 },
      768: { slidesPerView: 3 },
      480: { slidesPerView: 2 },
      0: { slidesPerView: 2 },
    },
  });
});
