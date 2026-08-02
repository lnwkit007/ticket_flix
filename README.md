# Ticket Flix API

Backend API สำหรับระบบ **Ticket Flix** พัฒนาด้วย **Laravel 12** โดยใช้ **Laravel Sanctum (SPA Authentication)** สำหรับการยืนยันตัวตนผ่าน **HttpOnly Cookie** รองรับการทำงานร่วมกับ Frontend ที่พัฒนาด้วย Vue.js

---

## Tech Stack

* PHP 8.3+
* Laravel 12
* MySQL
* Laravel Sanctum
* Session Authentication (HttpOnly Cookie)
* RESTful API

---

## Prerequisites

ก่อนเริ่มต้น โปรดตรวจสอบว่าได้ติดตั้งโปรแกรมต่อไปนี้แล้ว

* PHP 8.3 หรือใหม่กว่า
* Composer
* MySQL
* Node.js (สำหรับ Frontend)
* Git

---

## Installation

### 1. Clone Repository

```bash
git clone <repository-url>
cd server
```

---

### 2. Install Dependencies

```bash
composer install
```

---

### 3. Create Environment File

```bash
cp .env.example .env
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Configure Database

แก้ไขไฟล์ `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticket_flix
DB_USERNAME=root
DB_PASSWORD=
```

---

### 6. Run Migration

```bash
php artisan migrate
```

หากต้องการข้อมูลตัวอย่าง

```bash
php artisan db:seed
```

หรือ

```bash
php artisan migrate --seed
```

---

### 7. Clear Configuration Cache

```bash
php artisan optimize:clear
```

---

### 8. Start Development Server

```bash
php artisan serve
```

Laravel จะทำงานที่

```
http://localhost:8000
```

---

# SPA Authentication (Laravel Sanctum)

โปรเจกต์นี้ใช้ **Laravel Sanctum แบบ Stateful SPA Authentication**

Authentication ทำงานผ่าน

* HttpOnly Cookie
* Session
* CSRF Protection

ไม่มีการเก็บ Access Token ไว้ใน LocalStorage หรือ SessionStorage

---

## Authentication Flow

```
Frontend
      │
      ▼
GET /sanctum/csrf-cookie
      │
      ▼
Laravel ส่ง

- XSRF-TOKEN
- laravel_session

      │
      ▼
POST /api/login
      │
      ▼
Laravel Login

      │
      ▼
GET /api/me
      │
      ▼
Authenticated User
```

---

## Important Axios Configuration

Frontend ต้องตั้งค่า Axios ดังนี้

```ts
import axios from "axios";

export const api = axios.create({
    baseURL: "http://localhost:8000",
    withCredentials: true,
    withXSRFToken: true,
});
```

ก่อน Login ต้องเรียก

```http
GET /sanctum/csrf-cookie
```

ทุกครั้ง

---

# API Endpoints

## Authentication

| Method | Endpoint               | Description     |
| ------ | ---------------------- | --------------- |
| GET    | `/sanctum/csrf-cookie` | Get CSRF Cookie |
| POST   | `/api/register`        | Register        |
| POST   | `/api/login`           | Login           |
| POST   | `/api/logout`          | Logout          |
| GET    | `/api/me`              | Current User    |

---

# Environment Setup

หลัง Clone โปรเจกต์

1. คัดลอก `.env.example`
2. เปลี่ยนชื่อเป็น `.env`
3. ตั้งค่าฐานข้อมูล
4. รัน Migration
5. Generate Application Key

---

# Security

โปรเจกต์นี้ใช้แนวทางดังต่อไปนี้

* Laravel Sanctum
* HttpOnly Cookie
* Session Authentication
* CSRF Protection
* SameSite Cookie
* Password Hashing (Bcrypt)

ไม่มีการเก็บ Token ใน

* LocalStorage
* SessionStorage

เพื่อช่วยลดความเสี่ยงจากการโจมตีแบบ XSS

---

# Development Commands

ติดตั้ง Package

```bash
composer install
```

Generate Key

```bash
php artisan key:generate
```

Run Migration

```bash
php artisan migrate
```

Run Seeder

```bash
php artisan db:seed
```

Clear Cache

```bash
php artisan optimize:clear
```

Start Server

```bash
php artisan serve
```

---

# License

This project is licensed under the MIT License.
