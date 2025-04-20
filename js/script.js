document.addEventListener("DOMContentLoaded", () => {
  const visitorLink = document.getElementById("visitorLink");
  const loginOverlay = document.getElementById("loginOverlay");
  const loginLink = document.getElementById("loginLink");

  visitorLink.addEventListener("click", () => {
    loginOverlay.style.display = "none";
  });

  loginLink.addEventListener("click", (e) => {
    loginOverlay.style.display = "flex";
  });

  loginOverlay.addEventListener("click", (e) => {
    e.preventDefault();
    let isLoginOverlay = e.target.classList.contains("overlay1");

    isLoginOverlay ? (loginOverlay.style.display = "none") : "";
  });
});
