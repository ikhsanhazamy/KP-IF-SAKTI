# KP Fullstack Scaffold

This workspace contains two main folders:

- `frontend` — Vite + React scaffold
- `backend` — Laravel skeleton (run `composer create-project laravel/laravel .` inside `backend` to install)

Quick start:

```bash
# Frontend
cd frontend
npm install
npm run dev

# Backend (if Composer installed)
cd backend
composer create-project laravel/laravel .
php artisan serve
```

Or use `docker-compose up` to bring up simple services defined in `docker-compose.yml`.
