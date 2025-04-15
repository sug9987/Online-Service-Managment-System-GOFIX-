document.addEventListener("DOMContentLoaded", function() {
    // Service Boxes Animation on Scroll
    const serviceBoxes = document.querySelectorAll(".service-box");

    function checkScroll() {
        serviceBoxes.forEach((box) => {
            const boxTop = box.getBoundingClientRect().top;
            if (boxTop < window.innerHeight - 50) {
                box.classList.add("show");
            }
        });
    }

    window.addEventListener("scroll", checkScroll);
    checkScroll();

    // Contact Section Animation on Scroll
    const contactSection = document.getElementById("Contact");

    function showContact() {
        if (contactSection.getBoundingClientRect().top < window.innerHeight - 100) {
            contactSection.classList.add("show");
        }
    }

    window.addEventListener("scroll", showContact);
    showContact();
});
