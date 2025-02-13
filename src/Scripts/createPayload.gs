function createPayload(response) {
  const itemResponses = response.getItemResponses();
  const respondentEmail = response. getRespondentEmail();
  const payload = {
    "email": respondentEmail,
  };

  itemResponses.forEach(itemResponse => {
    const question = itemResponse.getItem().getTitle().toLowerCase().replace(/\s+/g, '_');
    payload[question] = itemResponse.getResponse();
  });

  return payload;
}