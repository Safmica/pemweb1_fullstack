// Wahyu Trisno Aji

// ADVANTAGES SECTION
function toggleAccordion(index) {
    const buttons = document.querySelectorAll(".accordion-button");
    const contentPanels = document.querySelectorAll(".accordion-collapse");
  
    contentPanels.forEach((panel, i) => {
      if (i === index) {
        if (panel.classList.contains("show")) {
          panel.classList.remove("show");
          buttons[i].classList.add("collapsed");
          panel.style.height = 0;
        } else {
          panel.classList.add("show");
          buttons[i].classList.remove("collapsed");
          panel.style.height = `${panel.scrollHeight}px`;
        }
      } else {
        panel.classList.remove("show");
        buttons[i].classList.add("collapsed");
        panel.style.height = 0;
      }
    });
  }