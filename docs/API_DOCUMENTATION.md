# 🌐 Dokumentasi REST API — KP-IF-SAKTI

Dokumentasi lengkap mengenai antarmuka pemrograman aplikasi (REST API) yang disediakan oleh backend Laravel untuk dikonsumsi oleh website publik React SPA maupun integrasi pihak ketiga.

---

## 📌 Ringkasan Umum (Overview)

- **Base URL Lokal (Docker)**: `http://localhost:5173/api` (via Vite proxy) atau `http://localhost:8000/api` (direct backend)
- **Base URL Produksi**: `https://fatayat-sukabumi.org/api`
- **Format Data**: JSON (`application/json`)
- **Autentikasi**: Endpoint publik tidak memerlukan bearer token. Rute admin diakses melalui session-based auth pada dashboard web.
- **Middleware Rate Limiting**:
  - `throttle:api`: Maksimal **60 request / menit** per IP untuk endpoint read publik.
  - `throttle:pac-pengajuan`: Maksimal **10 request / menit** per IP untuk submission formulir pengajuan PAC.
  - `throttle:login`: Maksimal **5 percobaan / menit** per IP untuk perlindungan brute-force login.

---

## 🚦 Status Code HTTP

| Status Code | Makna | Keterangan |
|---|---|---|
| `200 OK` | Sukses | Permintaan berhasil diproses dan mengembalikan data yang diminta. |
| `201 Created` | Dibuat | Resource baru berhasil dibuat dan disimpan ke dalam basis data. |
| `400 Bad Request` | Permintaan Salah | Parameter query atau body JSON tidak valid/rusak. |
| `404 Not Found` | Tidak Ditemukan | Resource ID yang diminta tidak ditemukan di database. |
| `422 Unprocessable Content` | Validasi Gagal | Data input form gagal memenuhi aturan validasi Laravel. |
| `429 Too Many Requests` | Rate Limit Terlampaui | Melebihi batas kuota pemanggilan API dalam 1 menit. |
| `500 Internal Server Error` | Kesalahan Server | Terjadi error internal tak terduga pada backend. |

---

## 🛡️ Response Headers & Rate Limiting

Setiap respons API menyertakan header standar untuk memantau kuota rate limiting:

```http
HTTP/1.1 200 OK
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Retry-After: 60 (hanya saat 429 Too Many Requests)
```

---

## 📡 Daftar Endpoint API Lengkap

### 1. Health Check Sistem
Memeriksa apakah server backend, PHP-FPM, dan database siap melayani permintaan.

- **URL**: `/up`
- **Method**: `GET`
- **Autentikasi**: Publik (No Auth)
- **Response**: `200 OK`

```bash
curl -X GET "http://localhost:8000/up"
```

---

### 2. Ambil Token CSRF Asinkron
Mengambil token CSRF baru yang valid untuk permintaan AJAX/Fetch dari frontend saat halaman terbuka lama guna mencegah token *mismatch*.

- **URL**: `/csrf-token`
- **Method**: `GET`
- **Rate Limit**: 60 req/min
- **Response (`200 OK`)**:
```json
{
  "csrf_token": "aBcD1234eFgH5678iJkL9012mNoP3456qRsT7890uVwX="
}
```

---

### 3. Ambil Daftar Kegiatan Organisasi
Mengambil seluruh daftar agenda/kegiatan Fatayat NU dengan opsi pencarian kata kunci dan filter kategori.

- **URL**: `/api/kegiatan`
- **Method**: `GET`
- **Rate Limit**: 60 req/min
- **Query Parameters**:

| Parameter | Tipe Data | Wajib? | Default | Deskripsi |
|---|---|---|---|---|
| `search` | `string` | Tidak | - | Kata kunci pencarian pada judul atau deskripsi kegiatan. |
| `category`| `string` | Tidak | `Semua` | Filter kategori kegiatan (`Kaderisasi`, `Seminar`, `Sosial`, `Kajian`, `Kesehatan`, dll.). Case-insensitive. |

#### Contoh Request:
```bash
curl -X GET "http://localhost:8000/api/kegiatan?category=Kaderisasi&search=Latihan" \
     -H "Accept: application/json"
```

#### Contoh Response (`200 OK`):
```json
[
  {
    "id": 1,
    "pac_id": 2,
    "judul": "Latihan Kader Dasar (LKD) Fatayat NU Zona Selatan",
    "kategori": "Kaderisasi",
    "tanggal": "2026-07-15",
    "waktu": "08:00:00",
    "lokasi": "Gedung Serbaguna Palabuhanratu",
    "peserta": 75,
    "deskripsi": "Kegiatan kaderisasi formal tingkat pertama bagi anggota baru Fatayat NU.",
    "status": "completed",
    "gambar": "kegiatan/lkd-selatan.webp",
    "gambar_url": "http://localhost:8000/storage/kegiatan/lkd-selatan.webp",
    "created_at": "2026-07-15T10:00:00.000000Z",
    "updated_at": "2026-07-15T10:00:00.000000Z",
    "pac": {
      "id": 2,
      "nama_pac": "PAC Palabuhanratu",
      "kecamatan": "Palabuhanratu"
    }
  }
]
```

---

### 4. Ambil Detail Kegiatan Spesifik
Mengambil data detail kegiatan tertentu berdasarkan ID beserta relasi data PAC penyelenggara.

- **URL**: `/api/kegiatan/{id}`
- **Method**: `GET`
- **Rate Limit**: 60 req/min
- **URL Parameters**:
  - `id` (integer, required): ID unik kegiatan.

#### Contoh Request:
```bash
curl -X GET "http://localhost:8000/api/kegiatan/1" \
     -H "Accept: application/json"
```

#### Contoh Response (`200 OK`):
```json
{
  "id": 1,
  "pac_id": 2,
  "judul": "Latihan Kader Dasar (LKD) Fatayat NU Zona Selatan",
  "kategori": "Kaderisasi",
  "tanggal": "2026-07-15",
  "waktu": "08:00:00",
  "lokasi": "Gedung Serbaguna Palabuhanratu",
  "peserta": 75,
  "deskripsi": "Kegiatan kaderisasi formal tingkat pertama bagi anggota baru Fatayat NU.",
  "status": "completed",
  "gambar": "kegiatan/lkd-selatan.webp",
  "gambar_url": "http://localhost:8000/storage/kegiatan/lkd-selatan.webp",
  "created_at": "2026-07-15T10:00:00.000000Z",
  "updated_at": "2026-07-15T10:00:00.000000Z",
  "pac": {
    "id": 2,
    "nama_pac": "PAC Palabuhanratu",
    "kecamatan": "Palabuhanratu"
  }
}
```

---

### 5. Ambil Daftar Seluruh PAC Aktif
Mengambil seluruh data Pimpinan Anak Cabang (PAC) berstatus aktif se-Kabupaten Sukabumi untuk keperluan pemetaan interaktif (MapLibre GL) dan direktori wilayah.

- **URL**: `/api/pac`
- **Method**: `GET`
- **Rate Limit**: 60 req/min

#### Contoh Request:
```bash
curl -X GET "http://localhost:8000/api/pac" \
     -H "Accept: application/json"
```

#### Contoh Response (`200 OK`):
```json
[
  {
    "id": 1,
    "nama_pac": "PAC Cisaat",
    "kecamatan": "Cisaat",
    "status": "aktif",
    "tanggal_berdiri": "2015-04-20",
    "ketua_pac": "Siti Nurhaliza, S.Pd.",
    "telepon": "081234567890",
    "email": "pac.cisaat@fatayatnu.or.id",
    "jumlah_anggota": 45,
    "total_kegiatan": 12,
    "alumni_lkd": 35,
    "nomor_sk": "SK/042/PCFNU/2024",
    "alamat": "Jl. Raya Cisaat No. 45",
    "desa": "Cisaat",
    "kode_pos": "43152",
    "deskripsi": "Pimpinan Anak Cabang Kecamatan Cisaat aktif dalam program pemberdayaan perempuan dan UMKM binaan.",
    "created_at": "2026-05-17T13:24:30.000000Z",
    "updated_at": "2026-08-16T03:50:00.000000Z"
  }
]
```

---

### 6. Ambil Statistik Ringkasan Organisasi
Mengambil metrik agregat organisasi (total PAC aktif, total kader terdaftar, total kecamatan terjangkau, dan rasio kepuasan).

- **URL**: `/api/stats`
- **Method**: `GET`
- **Rate Limit**: 60 req/min

#### Contoh Request:
```bash
curl -X GET "http://localhost:8000/api/stats" \
     -H "Accept: application/json"
```

#### Contoh Response (`200 OK`):
```json
{
  "total_pac": 47,
  "pac_aktif": 47,
  "total_anggota": 1250,
  "anggota_aktif": 1200,
  "total_kecamatan": 47,
  "tingkat_verifikasi": 92,
  "kepuasan": 92
}
```

---

### 7. Pengajuan Pembentukan PAC Baru
Mengirimkan formulir permohonan pendirian PAC baru dari masyarakat/kader ke database sistem dan secara asinkron mendispatch antrean job sinkronisasi Google Apps Script Webhook.

- **URL**: `/api/pac/pengajuan`
- **Method**: `POST`
- **Rate Limit**: 10 req/min (`throttle:pac-pengajuan`)
- **Headers**:
  - `Content-Type: application/json`
  - `Accept: application/json`

#### Request Body Fields:

| Field | Tipe | Wajib? | Aturan Validasi | Deskripsi |
|---|---|---|---|---|
| `nama_pac` | `string` | **Ya** | `required|string|max:255` | Nama PAC yang diajukan (contoh: "PAC Cikembar") |
| `kecamatan` | `string` | **Ya** | `required|string|max:255` | Nama kecamatan di Kab. Sukabumi |
| `tanggal_berdiri` | `string` (date) | **Ya** | `required|date` | Tanggal usulan pembentukan (`YYYY-MM-DD`) |
| `ketua_pac` | `string` | **Ya** | `required|string|max:255` | Nama calon ketua PAC |
| `telepon` | `string` | **Ya** | `required|string|max:20` | Nomor WhatsApp / kontak ketua |
| `email` | `string` | Tidak | `nullable|email|max:255` | Alamat email resmi PAC |
| `alamat` | `string` | Tidak | `nullable|string` | Alamat sekretariat PAC |
| `desa` | `string` | Tidak | `nullable|string|max:255` | Nama desa/kelurahan sekretariat |
| `kode_pos` | `string` | Tidak | `nullable|string|max:10` | Kode pos lokasi |
| `deskripsi` | `string` | Tidak | `nullable|string` | Keterangan/latar belakang pengajuan |

#### Contoh Request:
```bash
curl -X POST "http://localhost:8000/api/pac/pengajuan" \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
       "nama_pac": "PAC Simpenan",
       "kecamatan": "Simpenan",
       "tanggal_berdiri": "2026-08-25",
       "ketua_pac": "Fatimah Azzahra, S.Ag.",
       "telepon": "085712345678",
       "email": "pac.simpenan@gmail.com",
       "alamat": "Jl. Pelabuhan II No. 12",
       "desa": "Cidadap",
       "kode_pos": "43361",
       "deskripsi": "Pengajuan pembentukan PAC Simpenan dengan 25 kader siap aktif."
     }'
```

#### Contoh Response Sukses (`201 Created`):
```json
{
  "success": true,
  "message": "Pengajuan PAC berhasil dikirim dan sedang menunggu persetujuan admin.",
  "google_sheet_synced": true,
  "data": {
    "id": 48,
    "nama_pac": "PAC Simpenan",
    "kecamatan": "Simpenan",
    "status": "pending",
    "tanggal_berdiri": "2026-08-25",
    "ketua_pac": "Fatimah Azzahra, S.Ag.",
    "telepon": "085712345678",
    "email": "pac.simpenan@gmail.com",
    "alamat": "Jl. Pelabuhan II No. 12",
    "desa": "Cidadap",
    "kode_pos": "43361",
    "deskripsi": "Pengajuan pembentukan PAC Simpenan dengan 25 kader siap aktif.",
    "jumlah_anggota": 0,
    "total_kegiatan": 0,
    "created_at": "2026-08-25T16:15:00.000000Z",
    "updated_at": "2026-08-25T16:15:00.000000Z"
  }
}
```

#### Contoh Response Gagal Validasi (`422 Unprocessable Content`):
```json
{
  "message": "The nama pac field is required. (and 2 more errors)",
  "errors": {
    "nama_pac": ["The nama pac field is required."],
    "kecamatan": ["The kecamatan field is required."],
    "telepon": ["The telepon field is required."]
  }
}
```

---

## 💻 Contoh Integrasi Frontend (JavaScript Fetch & Axios)

### Menggunakan Native Fetch API:
```javascript
// Fetch kegiatan dengan pencarian & kategori
async function fetchKegiatan(search = '', category = 'Semua') {
  const params = new URLSearchParams();
  if (search) params.append('search', search);
  if (category && category !== 'Semua') params.append('category', category);

  const response = await fetch(`/api/kegiatan?${params.toString()}`, {
    headers: { 'Accept': 'application/json' }
  });

  if (!response.ok) {
    throw new Error(`HTTP error! status: ${response.status}`);
  }

  return await response.json();
}
```

### Menggunakan Axios:
```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_TARGET || '/api',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
});

export async function submitPengajuanPAC(formData) {
  try {
    const response = await api.post('/pac/pengajuan', formData);
    return response.data;
  } catch (error) {
    if (error.response && error.response.status === 422) {
      throw error.response.data.errors;
    }
    throw error;
  }
}
```
