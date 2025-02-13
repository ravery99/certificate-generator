function sendToWebhook(payload) {
  const options = {
    method: "post",
    contentType: "application/json",
    payload: JSON.stringify(payload)
  };

  const domain = " https://88a4-149-108-199-63.ngrok-free.app";
  const endpoint = "/certificate-generator/public/webhook";
  const response = UrlFetchApp.fetch(`${domain}${endpoint}`, options);

  return JSON.parse(response.getContentText());
}