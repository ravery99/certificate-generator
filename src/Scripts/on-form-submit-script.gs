function onFormSubmit(e) {
  var sheet = SpreadsheetApp.openById("12b6KSossEByKKSbPr74Lp0QOgS2IfnHAhyLrlyvzVg8").getActiveSheet();
  var lastRow = sheet.getLastRow();
  var data = sheet.getRange(lastRow, 1, 1, sheet.getLastColumn()).getValues()[0];

  var payload = {
    email: data[1],  // Sesuaikan kolom
    tanggal_training: data[2],
    nama_peserta: data[3],
    divisi: data[4],
    fasilitas_kesehatan: data[5],
    no_hp: data[6] ? data[6] : ""  // Jika kosong, kirim string kosong
  };

  var options = {
    method: "post",
    contentType: "application/json",
    payload: JSON.stringify(payload)
  };

  var domain = "https://8183-103-47-133-85.ngrok-free.app";
  var endpoint = "/certificate-generator/public/webhook.php";
  var response = UrlFetchApp.fetch(domain + endpoint, options);

  // Logger.log("Response from webhook: " + response.getContentText());

  var jsonResponse = JSON.parse(response.getContentText())

  if (jsonResponse.status == "success") {
    var certFileName = jsonResponse.link.split('/').pop(); // Ambil nama file sertifikat
    var previewLink = "http://localhost/certificate-generator/public/view_certificate.php?file=" + encodeURIComponent(certFileName);

    sheet.getRange(lastRow, 8).setValue(previewLink); // Simpan link preview di Google Sheets

    // Kirim email konfirmasi
    Logger.log("📌 Data dari Google Sheets: " + JSON.stringify(data));
    Logger.log("📌 Email yang akan dikirim: " + data[1]);
    sendConfirmationEmail(data[1], previewLink);
  }
}
