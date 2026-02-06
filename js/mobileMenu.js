const menuBtn = document.getElementById("menuBtn");
const mobileMenu = document.getElementById("mobileMenu");
const menuIcon = document.getElementById("menuIcon");

let menuOpen = false;

menuBtn.addEventListener("click", () => {
    menuOpen = !menuOpen;

    if (menuOpen) {
        // Show menu
        mobileMenu.classList.remove("opacity-0", "pointer-events-none");
        mobileMenu.classList.add("opacity-100");
        // Change icon
        menuIcon.classList.remove("fa-bars");
        menuIcon.classList.add("fa-xmark");
    } else {
        // Hide menu
        mobileMenu.classList.add("opacity-0", "pointer-events-none");
        mobileMenu.classList.remove("opacity-100");
        // Change icon
        menuIcon.classList.add("fa-bars");
        menuIcon.classList.remove("fa-xmark");
    }
});

document.querySelectorAll("#mobileMenu a").forEach(link => {
    link.addEventListener("click", () => {
        // Hide menu
        mobileMenu.classList.add("opacity-0", "pointer-events-none");
        mobileMenu.classList.remove("opacity-100");

        // Change icon back
        menuIcon.classList.add("fa-bars");
        menuIcon.classList.remove("fa-xmark");

        // Reset state
        menuOpen = false;
    });
});