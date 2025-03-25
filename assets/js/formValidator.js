function validateAndShowModal() {
  let form = document.getElementById("participant-form");
  if (form.checkValidity()) {
    showModal("Apakah data yang Anda isi sudah benar?", () => submitForm(), {
      cancelText: "Periksa Lagi",
      confirmText: "Ya, Kumpulkan",
    });
  } else {
    form.reportValidity();
  }
}

function submitForm() {
  let form = document.getElementById("participant-form");
  form.submit();
}
