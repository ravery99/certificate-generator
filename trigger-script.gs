function sendToWebhook(e) {
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

  var domain = "https://5eaa-103-47-133-131.ngrok-free.app";
  var endpoint = "/certificate-generator/public/webhook.php";
  UrlFetchApp.fetch(domain + endpoint, options);
}
