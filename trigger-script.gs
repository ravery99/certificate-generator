function sendToWebhook(e) {
  var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
  var lastRow = sheet.getLastRow();
  
  var data = {
    "email": sheet.getRange(lastRow, 1).getValue(),
    "date": sheet.getRange(lastRow, 2).getValue(),
    "name": sheet.getRange(lastRow, 3).getValue(),
    "division": sheet.getRange(lastRow, 4).getValue(),
    "facility": sheet.getRange(lastRow, 5).getValue(),
    "phone": sheet.getRange(lastRow, 6).getValue()
  };

  var options = {
    "method": "post",
    "contentType": "application/json",
    "payload": JSON.stringify(data)
  };

  var domain = "https://your-domain.com";
  var endpoint = "/public/webhook.php";
  UrlFetchApp.fetch(domain + endpoint, options);
}
