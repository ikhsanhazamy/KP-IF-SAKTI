const SHEET_NAME = 'Pengajuan PAC';
const SPREADSHEET_ID = '1l_LAHoXE5fSTT9qNrMHmjID0_g69HSnYTpLLoekBkyQ';
const SPREADSHEET_FILE_NAME = 'Pengajuan PAC - KP IF SAKTI';
const HEADERS = [
  'Waktu Masuk',
  'ID PAC',
  'Nama PAC',
  'Kecamatan',
  'Status',
  'Tanggal Berdiri',
  'Ketua PAC',
  'Telepon',
  'Email',
  'Desa / Kelurahan',
  'Kode Pos',
  'Alamat Sekretariat',
  'Deskripsi',
  'Sumber',
];

function doGet() {
  const sheet = getSheet_();
  ensureHeader_(sheet);

  return json_({
    success: true,
    message: 'Webhook pengajuan PAC aktif.',
    spreadsheet_url: sheet.getParent().getUrl(),
  });
}

function myFunction() {
  return doGet();
}

function doPost(e) {
  const lock = LockService.getScriptLock();
  lock.waitLock(30000);

  try {
    const payload = parsePayload_(e);
    validateToken_(payload);

    const pac = payload.pac || payload;
    const sheet = getSheet_();
    ensureHeader_(sheet);

    sheet.appendRow([
      new Date(),
      value_(pac.id),
      value_(pac.nama_pac),
      value_(pac.kecamatan),
      value_(pac.status || 'pending'),
      value_(pac.tanggal_berdiri),
      value_(pac.ketua_pac),
      value_(pac.telepon),
      value_(pac.email),
      value_(pac.desa),
      value_(pac.kode_pos),
      value_(pac.alamat),
      value_(pac.deskripsi),
      value_(payload.source),
    ]);

    const row = sheet.getLastRow();
    sheet.getRange(row, 1, 1, HEADERS.length)
      .setWrap(true)
      .setVerticalAlignment('top');

    return json_({
      success: true,
      row: row,
      message: 'Pengajuan PAC berhasil ditambahkan ke spreadsheet.',
      spreadsheet_url: sheet.getParent().getUrl(),
    });
  } catch (error) {
    return json_({
      success: false,
      message: error.message,
    });
  } finally {
    lock.releaseLock();
  }
}

function parsePayload_(e) {
  if (!e || !e.postData || !e.postData.contents) {
    throw new Error('Payload kosong.');
  }

  const contents = e.postData.contents;
  const type = (e.postData.type || '').toLowerCase();

  if (type.indexOf('application/json') !== -1 || contents.trim().charAt(0) === '{') {
    return JSON.parse(contents);
  }

  return e.parameter || {};
}

function validateToken_(payload) {
  const expectedToken = PropertiesService.getScriptProperties().getProperty('WEBHOOK_TOKEN');

  if (!expectedToken) {
    return;
  }

  if (!payload || payload.token !== expectedToken) {
    throw new Error('Token webhook tidak valid.');
  }
}

function getSheet_() {
  const spreadsheet = getSpreadsheet_();

  return spreadsheet.getSheetByName(SHEET_NAME) || spreadsheet.insertSheet(SHEET_NAME);
}

function getSpreadsheet_() {
  const spreadsheetId = SPREADSHEET_ID || PropertiesService.getScriptProperties().getProperty('SPREADSHEET_ID');

  if (spreadsheetId) {
    PropertiesService.getScriptProperties().setProperty('SPREADSHEET_ID', spreadsheetId);
    return SpreadsheetApp.openById(spreadsheetId);
  }

  const activeSpreadsheet = SpreadsheetApp.getActiveSpreadsheet();

  if (activeSpreadsheet) {
    PropertiesService.getScriptProperties().setProperty('SPREADSHEET_ID', activeSpreadsheet.getId());
    return activeSpreadsheet;
  }

  const spreadsheet = SpreadsheetApp.create(SPREADSHEET_FILE_NAME);
  PropertiesService.getScriptProperties().setProperty('SPREADSHEET_ID', spreadsheet.getId());

  return spreadsheet;
}

function ensureHeader_(sheet) {
  const headerRange = sheet.getRange(1, 1, 1, HEADERS.length);
  const existingHeaders = headerRange.getValues()[0];
  const needsHeader = existingHeaders.every(function (cell) {
    return !cell;
  });

  if (needsHeader) {
    headerRange.setValues([HEADERS]);
  }

  headerRange
    .setBackground('#0F5E3A')
    .setFontColor('#FFFFFF')
    .setFontWeight('bold')
    .setWrap(true)
    .setVerticalAlignment('middle');

  sheet.setFrozenRows(1);
  sheet.getRange('A:A').setNumberFormat('dd mmmm yyyy hh:mm:ss');
  sheet.getRange('H:H').setNumberFormat('@');
  sheet.getRange('K:K').setNumberFormat('@');

  sheet.setColumnWidth(1, 180);
  sheet.setColumnWidth(2, 90);
  sheet.setColumnWidth(3, 220);
  sheet.setColumnWidth(4, 160);
  sheet.setColumnWidth(5, 120);
  sheet.setColumnWidth(6, 150);
  sheet.setColumnWidth(7, 220);
  sheet.setColumnWidth(8, 150);
  sheet.setColumnWidth(9, 220);
  sheet.setColumnWidth(10, 170);
  sheet.setColumnWidth(11, 100);
  sheet.setColumnWidth(12, 260);
  sheet.setColumnWidth(13, 320);
  sheet.setColumnWidth(14, 160);
}

function value_(value) {
  if (value === null || value === undefined) {
    return '';
  }

  return value;
}

function json_(data) {
  return ContentService
    .createTextOutput(JSON.stringify(data))
    .setMimeType(ContentService.MimeType.JSON);
}
