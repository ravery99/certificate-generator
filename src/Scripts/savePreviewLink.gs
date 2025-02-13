function savePreviewLink(previewLink) {
  const sheet = SpreadsheetApp.openById("1C6LZ8oiBrVJWiWEA2_7jmSRuXCTYOf7mXKY7WYc3KHo").getActiveSheet();
  const row = sheet.getLastRow();
  
  // const sheet = e.source.getActiveSheet();    
  // const row = e.range.getRow(); 

  sheet.getRange(row, 8).setValue(previewLink);
}