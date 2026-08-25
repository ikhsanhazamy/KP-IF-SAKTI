# 🏛️ Arsitektur Sistem — KP-IF-SAKTI

Dokumen ini menjelaskan rancangan arsitektur perangkat lunak, aliran data (*data flow*), interaksi antar-layanan, dan integrasi pihak ketiga pada sistem informasi **KP-IF-SAKTI**.

---

## 📐 Gambaran Umum Arsitektur (High-Level Architecture)

Sistem KP-IF-SAKTI menggunakan pola **Hybrid Architecture**:
1. **Frontend Publik (Client Tier)**: Menggunakan Single Page Application (SPA) berbasis **React 18 + Vite** yang cepat, responsif, dan ringan untuk masyarakat umum dan kader.
2. **Backend & Admin Dashboard (Application Tier)**: Menggunakan **Laravel 12 (PHP 8.2)** yang menyediakan REST API JSON untuk frontend SPA sekaligus Server-Side Rendered (SSR) Blade Views untuk dashboard manajemen internal admin.
3. **Database Tier**: Relational Database Management System (**MySQL 8** pada environment Docker / Produksi, atau **SQLite** untuk pengujian cepat & backup fleksibel).
4. **Third-Party Integration**: **Google Apps Script Webhook** untuk sinkronisasi pengajuan PAC ke Google Sheets secara real-time.

```mermaid
graph TD
    UserPublic[Pengunjung Publik / Kader] -->|Browser HTTPS| FE[Frontend React SPA :5173]
    AdminUser[Administrator Organisasi] -->|Browser HTTPS| BE[Backend Laravel Blade :8000]

    FE -->|Proxy REST API /api/*| BE
    
    subgraph Backend Services [Laravel 12 Application]
        BE --> Controllers[Controllers & Form Requests]
        Controllers --> Middleware[Rate Limiter & CSRF & Auth]
        Middleware --> Eloquent[Eloquent ORM Models]
        Controllers --> ExportEngines[DomPDF & CSV Generator]
    end

    Eloquent -->|TCP / PDO| DB[(MySQL 8 / SQLite)]
    Controllers -->|Async HTTP POST JSON| GAS[Google Apps Script Webhook]
    GAS -->|Append Row| GSheets[(Google Spreadsheet)]
```

---

## 🔄 Aliran Data (Data Flow Diagrams)

### 1. Alur Pengajuan PAC Publik ke Sistem & Google Sheets

```mermaid
sequenceDiagram
    autonumber
    actor Pengaju as Kader / Pemohon
    participant React as Frontend React (/pengajuan-pac)
    participant ViteProxy as Vite Dev Proxy (/api)
    participant Laravel as Laravel API (/api/pac/pengajuan)
    participant DB as Database (MySQL/SQLite)
    participant GAS as Google Apps Script Webhook
    participant Sheet as Google Sheets

    Pengaju->>React: Mengisi form & klik "Kirim Pengajuan"
    React->>ViteProxy: POST /api/pac/pengajuan (JSON Payload)
    ViteProxy->>Laravel: Forward request ke Backend
    Laravel->>Laravel: Validasi Input & Rate Limit (10 req/min)
    Laravel->>DB: INSERT into pacs (status: 'pending')
    
    alt Webhook URL Dikonfigurasi
        Laravel->>GAS: HTTP POST JSON (Token + Data PAC)
        GAS->>Sheet: Tambahkan baris baru di spreadsheet
        GAS-->>Laravel: HTTP 200 OK (synced: true)
    else Webhook Tidak Aktif / Error
        Laravel-->>Laravel: Log warning, data tetap tersimpan di database
    end

    Laravel-->>React: HTTP 201 Created (success: true, data: PAC)
    React-->>Pengaju: Menampilkan pesan sukses & reset form
```

---

### 2. Alur Akses Dashboard Admin & Keamanan

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Pengurus / Admin
    participant Blade as Login View (:8000/login)
    participant AuthCtrl as AuthController
    participant Limiter as Rate Limiter (throttle:login)
    participant Session as Session & Cookie Manager
    participant Dashboard as DashboardController

    Admin->>Blade: Akses halaman login
    Blade-->>Admin: Render form + input token CSRF
    Admin->>AuthCtrl: POST /login (email, password, _token)
    AuthCtrl->>Limiter: Periksa jumlah percobaan login (Maks 5/menit)
    
    alt Percobaan melebihi batas
        Limiter-->>Admin: HTTP 429 Too Many Requests
    else Kredensial Valid
        AuthCtrl->>Session: Buat sesi admin & regenerasi token CSRF
        AuthCtrl-->>Admin: Redirect ke /dashboard
        Admin->>Dashboard: GET /dashboard (Auth Guard)
        Dashboard-->>Admin: Tampilkan statistik ringkasan & menu navigasi
    end
```

---

## 📦 Komponen Utama & Pola Desain (Design Patterns)

| Komponen | Pola Desain | Deskripsi |
|---|---|---|
| **Controller-Model-View (MVC)** | MVC Pattern | Pemisahan jelas antara logika bisnis (`Controllers`), representasi data (`Models`), dan antarmuka pengguna (`Views/Blade`). |
| **API Resources / JSON Response** | RESTful Pattern | Standardisasi respons API dengan status code HTTP yang semantik (`200`, `201`, `422`, `429`). |
| **Middleware Pipeline** | Chain of Responsibility | Penanganan request bertahap: enkripsi cookie -> verifikasi CSRF -> rate limiting -> otentikasi sesi. |
| **Component-Based UI** | Reusable Components | Komponen frontend modular di React (Navbar, Footer, MapSection, StatCards) yang dapat digunakan berulang. |
| **Database Driver Abstraction** | Strategy Pattern | Abstraksi driver database (`mysql`, `sqlite`) yang memungkinkan fitur backup/restore berjalan mulus di berbagai lingkungan. |

---

## 🛡️ Topologi Jaringan & Isolasi Docker

Dalam arsitektur Docker Compose, layanan diatur dalam satu network internal tertutup (`kp_network`):
- **`app`**: Service backend PHP 8.2 terhubung langsung dengan container database `db`.
- **`db`**: MySQL 8 berjalan pada port internal `3306` dan hanya dapat diakses oleh container `app`.
- **`node`**: Dev server Vite berjalan pada port `5173` dan mem-proxy request API langsung ke service `http://app:8000`.
- **`backend-assets`**: Builder sementara untuk memproses aset CSS/JS Laravel dashboard menggunakan Vite.
