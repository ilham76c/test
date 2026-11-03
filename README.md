# Medify 2026 - Programmer Coding Test

## Requirements
- Docker
- Docker Compose

## Installation

### 1. Clone repository

```bash
git clone https://github.com/ilham76c/test
cd test
```

### 2. Setup environment

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database pada `.env` dengan konfigurasi Docker Compose.

### 3. Build and start containers

```bash
docker compose up -d --build
```

### 4. Install dependencies

```bash
docker compose exec app composer install
```

### 5. Generate application key

```bash
docker compose exec app php artisan key:generate
```

### 6. Run database migrations

```bash
docker compose exec app php artisan migrate --force
```

### 7. Create storage symbolic link

```bash
docker compose exec app php artisan storage:link
```

### 8. Access application

http://localhost:8000

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