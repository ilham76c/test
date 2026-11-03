# Medify 2026 - Programmer Coding Test

## Requirements
- Docker
- Docker Compose

## Installation

1. Clone repository:

```bash
git clone <repository-url>
cd test
```

2. Copy environment:

```bash
cp .env.example .env
```

3. Jalankan container:

```bash
docker compose up -d --build
```

4. Install dependencies jika belum dijalankan otomatis oleh container:

```bash
docker compose exec app composer install
```

5. Generate application key:

```bash
docker compose exec app php artisan key:generate
```

6. Jalankan migration:

```bash
docker compose exec app php artisan migrate --seed
```

7. Buat storage link:

```bash
docker compose exec app php artisan storage:link
```

## Access Application

URL: http://localhost:8000

## Database

Sesuaikan konfigurasi database pada file `.env` dengan service MySQL di Docker Compose.

## Features

- Master Items CRUD
- Upload foto Master Items
- Filter harga minimum dan maksimum
- Kategori Items CRUD
- Relasi many-to-many Kategori dan Master Items
- Export Master Items ke Excel
- Cetak PDF detail kategori