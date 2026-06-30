import path from "path"
import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// Bug 9 Fix: Proxy target bisa dikonfigurasi via environment variable.
// - Development lokal (tanpa Docker) : tidak perlu set VITE_API_TARGET, default ke http://localhost:8000
// - Development dengan Docker Compose : set VITE_API_TARGET=http://app:8000 di .env atau docker-compose environment
export default defineConfig({
  plugins: [react()],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "./src"),
    },
  },
  root: '.',
  server: {
    host: '0.0.0.0',
    proxy: {
      '/api': {
        // Default ke localhost agar friendly saat dev lokal tanpa Docker.
        // Saat pakai Docker Compose, set env: VITE_API_TARGET=http://app:8000
        target: process.env.VITE_API_TARGET || 'http://localhost:8000',
        changeOrigin: true,
        secure: false,
      },
    },
  },
})

