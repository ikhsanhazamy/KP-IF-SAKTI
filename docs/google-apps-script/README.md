# Integrasi Pengajuan PAC ke Google Spreadsheet

Integrasi ini membuat setiap submit form pengajuan PAC tersimpan di database Laravel dan ikut tercatat rapi di Google Spreadsheet melalui Google Apps Script.

## 1. Siapkan Spreadsheet

1. Buat Google Spreadsheet baru.
2. Buka `Extensions` > `Apps Script`.
3. Tempel isi file `pengajuan-pac.gs`.
4. Simpan project.

## 2. Optional: Tambahkan Token

Di Apps Script:

1. Buka `Project Settings`.
2. Tambahkan `Script Properties`:
   - `WEBHOOK_TOKEN`: isi token bebas yang kuat.

Token yang sama harus dimasukkan ke `.env` backend.

## 3. Deploy Web App

1. Klik `Deploy` > `New deployment`.
2. Pilih type `Web app`.
3. Set `Execute as` ke `Me`.
4. Set `Who has access` ke `Anyone`.
5. Deploy, lalu salin URL Web App.

Gunakan URL Web App yang bentuknya seperti ini:

```text
https://script.google.com/macros/s/xxxxx/exec
```

Jangan memakai URL editor Apps Script yang bentuknya seperti ini:

```text
https://script.google.com/d/xxxxx/edit
```

## 4. Isi `.env` Backend

Tambahkan:

```env
GOOGLE_APPS_SCRIPT_WEBHOOK_URL=https://script.google.com/macros/s/xxxxx/exec
GOOGLE_APPS_SCRIPT_WEBHOOK_TOKEN=token-yang-sama
```

Jika config Laravel sudah pernah di-cache, jalankan:

```bash
php artisan config:clear
```

Setelah itu, submit form `Pengajuan PAC`; data akan masuk ke sheet bernama `Pengajuan PAC`.

## 5. Melihat File Spreadsheet

Jika script dibuat dari Google Sheets, data masuk ke file spreadsheet tempat script itu dibuat.

Untuk project ini, `pengajuan-pac.gs` sudah diarahkan ke spreadsheet:

```text
https://docs.google.com/spreadsheets/d/1l_LAHoXE5fSTT9qNrMHmjID0_g69HSnYTpLLoekBkyQ/edit
```

Jika script dibuat dari `script.google.com` sebagai project standalone, script akan membuat file baru di Google Drive saat URL Web App `/exec` dibuka pertama kali atau saat form pertama dikirim. Nama file-nya:

```text
Pengajuan PAC - KP IF SAKTI
```

Buka URL Web App `/exec`; response JSON akan menampilkan `spreadsheet_url`. Kamu juga bisa cari file tersebut langsung di Google Drive.
