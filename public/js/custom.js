window.addEventListener("DOMContentLoaded", () => {
    const overlay = document.querySelector("#overlay");
    const delBtn = document.querySelector("#delete-btn");
    const closeBtn = document.querySelector("#close-modal");

    const toggleModal = () => {
        overlay.classList.toggle("hidden");
        overlay.classList.toggle("flex");
        overlay.classList.toggle("modal-active");
    };

    delBtn.addEventListener("click", toggleModal);

    closeBtn.addEventListener("click", toggleModal);
});
