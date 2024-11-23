(function (document) {
  const markers = [...document.querySelectorAll("mark")];

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.intersectionRatio > 0) {
          entry.target.style.animationPlayState = "running";
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.8,
    }
  );

  markers.forEach((mark) => {
    observer.observe(mark);
  });
})(document);

//curtains
function animateText(text, element) {
  element.innerHTML = "";
  const characters = text.split("");
  characters.forEach((char, index) => {
    setTimeout(() => {
      element.innerHTML += char;
    }, index * 50);
  });
}

const words = ["WELCOME TO ERSANAWATA HIGH SCHOOL"];
let part,
  i = 0,
  offset = 0,
  len = words.length,
  forwards = true,
  skip_count = 0,
  skip_delay = 15,
  speed = 70;

const wordflick = () => {
  setInterval(() => {
    if (forwards) {
      if (offset >= words[i].length) {
        ++skip_count;
        if (skip_count === skip_delay) {
          forwards = false;
          skip_count = 0;
        }
      }
    } else {
      if (offset === 0) {
        forwards = true;
        i++;
        offset = 0;
        if (i >= len) i = 0;
      }
    }
    part = words[i].substr(0, offset);
    if (skip_count === 0) {
      if (forwards) offset++;
      else offset--;
    }
  }, speed);
};

document.addEventListener("DOMContentLoaded", () => {
  wordflick();

  const fadeInElement = document.getElementById("fadeInElement");
  fadeInElement.classList.add("active");

  const titleElement = document.getElementById("animatedTitle");
  document.body.classList.add("open");
  animateText("Welcome To ERSANAWATA Official Website", titleElement);
});

const quote = ["Building", "Shaping", "Empowering", "Inspiring"];
const colors = ["blue", "green", "yellow", "red"];
const text = document.querySelector(".text");

function* generator() {
  let index = 0;
  while (true) {
    yield index++;
    if (index > 3) index = 0;
  }
}

function printChar(word) {
  let i = 0;
  text.innerHTML = "";
  text.classList.add(colors[quote.indexOf(word)]);
  const id = setInterval(() => {
    if (i >= word.length) {
      deleteChar();
      clearInterval(id);
    } else {
      text.innerHTML += word[i];
      i++;
    }
  }, 300);
}

function deleteChar() {
  const word = text.innerHTML;
  let i = word.length - 1;
  const id = setInterval(() => {
    if (i >= 0) {
      text.innerHTML = text.innerHTML.substring(0, text.innerHTML.length - 1);
      i--;
    } else {
      text.classList.remove(colors[quote.indexOf(word)]);
      printChar(quote[gen.next().value]);
      clearInterval(id);
    }
  }, 200);
}

const gen = generator();
printChar(quote[gen.next().value]);

function animateValue(id, start, end, duration, ext) {
  let startTime = null;

  const animate = (timestamp) => {
    if (!startTime) startTime = timestamp;
    const progress = timestamp - startTime;
    const currentValue = Math.floor(
      (progress / duration) * (end - start) + start
    );
    document.getElementById(id).innerText = currentValue + ext;

    if (progress < duration) {
      requestAnimationFrame(animate);
    } else {
      document.getElementById(id).innerText = end + ext;
    }
  };

  requestAnimationFrame(animate);
}

<<<<<<< HEAD
animateValue("achievement-1", 0, 97, 2000, '%');
animateValue("achievement-2", 0, 24, 2000, ' Years');
animateValue("achievement-3", 0, 100, 2000, ' Top');
animateValue("achievement-4", 0, 147, 2000, 'x');


const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');
const slides = document.querySelector('.carousel-slides');
let index = 0;
const totalSlides = document.querySelectorAll('.carousel-slide').length;

  function moveToSlide(newIndex) {
    if (newIndex < 0) {
        index = totalSlides - 1;
        } else if (newIndex >= totalSlides) {
            index = 0;
        } else {
            index = newIndex;
        }
        slides.style.transform = `translateX(-${index * 100}%)`;
    }

    prevButton.addEventListener('click', () => moveToSlide(index - 1));
    nextButton.addEventListener('click', () => moveToSlide(index + 1));

    // Optionally, set an interval for automatic carousel sliding
    setInterval(() => moveToSlide(index + 1), 3000); // change slide every 3 seconds


=======
function startAnimation(entries, observer) {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      animateValue("achievement-1", 0, 97, 2000, '%');
      animateValue("achievement-2", 0, 47, 2000, ' Years');
      animateValue("achievement-3", 0, 100, 2000, ' Top');
      animateValue("achievement-4", 0, 147, 2000, 'x');
      observer.disconnect();
    }
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver(startAnimation, {
    threshold: 0.3
  });

  const targetContainer = document.getElementById("stat-box");
  if (targetContainer) {
    observer.observe(targetContainer);
  }
});
>>>>>>> 6e8cd148adcc197549e2760aa99c6274bffa8202
