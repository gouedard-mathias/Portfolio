const modalImgs = document.querySelectorAll(".modal-open");

modalImgs.forEach(function (img) {
    img.addEventListener("click", function () {
        let modal = img.getAttribute("data-modal");
        document.getElementById(modal).style.display = "block";
    });
});

const closeImgs = document.querySelectorAll(".modal-close");

closeImgs.forEach(function (img) {
    img.addEventListener("click", function () {
        img.closest(".modal").style.display = "none";
    });
});

window.onclick = function (e) {
    if (e.target.className === "modal") {
        e.target.style.display = "none";
    }
};