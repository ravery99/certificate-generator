function sendConfirmationEmail(email, previewLink) {
  var subject = "Sertifikat Anda Telah Dibuat!";
  var emailBody = "Selamat!\n\nSertifikat Anda telah berhasil dibuat. Anda dapat melihat dan mengunduhnya melalui link berikut:\n\n" 
    + previewLink + 
    "\n\nKlik tombol 'Download Sertifikat' pada halaman tersebut untuk menyimpan sertifikat Anda.";

  MailApp.sendEmail({
    to: email,
    subject: subject,
    body: emailBody
  });
}
