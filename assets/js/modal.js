document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("global-modal");
  const overlay = document.getElementById("global-overlay");
  const modalMessage = document.getElementById("modal-message");
  const modalIcon = document.getElementById("modal-icon");
  const modalConfirm = document.getElementById("modal-confirm");
  const modalCancel = document.getElementById("modal-cancel");

  const closeModal = () => {
    modal.classList.add("hidden");
    overlay.classList.add("hidden");
  };

  const setupModalEvents = () => {
    modalCancel.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
  };

  window.showModal = (message, confirmAction, options = {}) => {
    modalMessage.innerText = message;
    modalConfirm.innerText = options.confirmText || "Ya, Lanjutkan";
    modalCancel.innerText = options.cancelText || "Batal";
    modalIcon.innerText = options.icon || "info";

    // Set warna tombol
    modalConfirm.className = `flex-1 text-white rounded-lg transition-all duration-300 transform text-sm sm:text-base px-5 py-2.5 sm:px-6 sm:py-3 cursor-pointer 
      ${options.confirmBg || "bg-gradient-to-r from-green-600 to-blue-950"} 
      ${options.confirmHover || "hover:bg-green-800"}`;

    modalCancel.className = `flex-1 border rounded-lg transition-all duration-300 transform text-sm sm:text-base px-5 py-2.5 sm:px-6 sm:py-3 cursor-pointer 
      ${options.cancelBorder || "border-red-700"} 
      ${options.cancelTextColor || "text-red-700"} 
      ${options.cancelBg || "bg-white"} 
      ${options.cancelHover || "hover:bg-red-100"}`;

    modal.classList.remove("hidden");
    overlay.classList.remove("hidden");

    modalConfirm.onclick = () => {
      closeModal();
      confirmAction();
    };
  };

  setupModalEvents();
});
