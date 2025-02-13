function onFormSubmit(e) {
  const response = e.response;
  const responseId = response.getId();

  if (isAlreadyProcessed(responseId)) {
    Logger.log(`Respons dengan ID ${responseId} sudah diproses.`);
    return;
  }

  markAsProcessed(responseId);

  const payload = createPayload(response);
  const jsonResponse = sendToWebhook(payload);

  if (jsonResponse.status === "success") {
    const previewLink = jsonResponse.link;
    // const previewLink = generatePreviewLink(jsonResponse.link);
    // const row = e.range.getRow(); 
    
    savePreviewLink(previewLink);
    // savePreviewLink(previewLink, e);

    sendConfirmationEmail(payload.email, previewLink);
  }
}