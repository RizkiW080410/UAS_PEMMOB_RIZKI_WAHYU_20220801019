document.addEventListener("DOMContentLoaded", function () {
  const loaderWrapper = document.querySelector(".loader-wrapper");
  loaderWrapper.style.display = "none";

  const scrollUp = document.querySelector(".scroll-up");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 200) {
      scrollUp.style.display = "block";
    } else {
      scrollUp.style.display = "none";
    }
  });
});

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}
