<!-- run project for mycomputer : php -S 127.0.0.1:8000 -t public -->
<!-- run test : php -S YOUR_LOCAL_IP:8000 -t public -->
# Ticket Flix API

ระบบ Backend สำหรับเว็บขายตั๋วหนัง พัฒนาด้วย Laravel + Docker + MySQL

---

# 🛠️ ขั้นตอนการรันโปรเจกต์ครั้งแรกสุด (First-time Setup)

เมื่อเพื่อนร่วมทีมดึงโค้ดไป หรือต้องการนำโปรเจกต์ขึ้นเซิร์ฟเวอร์ใหม่
ให้เปิด Terminal ที่โฟลเดอร์หลักของโปรเจกต์ แล้วรันคำสั่งตามลำดับดังนี้

---

## 1. สร้างไฟล์ตั้งค่าสิ่งแวดล้อม (.env)

คัดลอกไฟล์ตั้งค่าระบบจากตัวต้นแบบขึ้นมาใหม่
เพื่อเอาไว้ใช้เชื่อมต่อฐานข้อมูลภายใน Docker Container

```bash
cp .env.example .env
```

หลังจากคัดลอกแล้ว ให้เปิดไฟล์ `.env` และตรวจสอบค่าเหล่านี้:

```env
DB_HOST=ticket-flix-db
DB_PORT=3306
```

---

## 2. สั่งประกอบร่างและเปิดใช้งาน Docker Containers

คำสั่งนี้จะทำการ:

* ดาวน์โหลด Docker Images
* Build Containers
* เปิดระบบทั้งหมดให้ทำงานเบื้องหลัง

```bash
docker compose up -d --build
```

---

## 3. ติดตั้ง PHP Dependencies

สั่งให้ Composer ภายใน Container ของ Laravel ดาวน์โหลดแพ็กเกจทั้งหมด
และสร้างโฟลเดอร์ `vendor`

```bash
docker compose exec ticket-flix-api composer install
```

---

## 4. Generate Laravel Application Key

สร้าง Application Key สำหรับใช้เข้ารหัสข้อมูลภายในระบบ Laravel

```bash
docker compose exec ticket-flix-api php artisan key:generate
```

---

## 5. ล้าง Config Cache

สั่งให้ Laravel เคลียร์ค่า Config เก่า
และอ่านค่าจากไฟล์ `.env` ใหม่ทั้งหมด

```bash
docker compose exec ticket-flix-api php artisan config:clear
```

---

## 6. สร้างโครงสร้างฐานข้อมูล (Database Migration)

สร้างตารางทั้งหมดใน MySQL เช่น:

* users
* sessions
* movies
* ฯลฯ

```bash
docker compose exec ticket-flix-api php artisan migrate
```

หากระบบถามว่า:

```text
Would you like to create it? (yes/no)
```

ให้พิมพ์:

```text
yes
```

แล้วกด Enter ได้เลย

---

กรณี Server จัดการ Database: รันคำสั่งอัปเดตฐานข้อมูลผ่าน Docker เช่น:

```Bash
docker-compose exec php-fpm php artisan migrate --force
```
(ข้อควรระวัง: บน Production ต้องใส่ --force เสมอ เพราะ Laravel จะถามยืนยันความปลอดภัย หากรันผ่านระบบอัตโนมัติมันจะค้างถ้าไม่มี flag นี้)


---

# 🚀 พิกัดการเข้าใช้งานระบบ

## หน้าแรกของระบบ (Welcome Page)

```text
http://localhost:8080
```

---

## พิกัดสำหรับทดสอบ API

ใช้งานผ่าน Postman หรือ Thunder Client ได้ที่:

```text
http://localhost:8080/api/movies
```

---

# 🔄 คำสั่งคุม Docker Containers ทั่วไป (Daily Workflow)

หลังจากตั้งค่าครั้งแรกเสร็จแล้ว
วันต่อ ๆ ไปสามารถใช้คำสั่งสั้น ๆ เหล่านี้แทนได้เลย

---

## เปิดระบบทั้งหมด

```bash
docker compose up -d
```

---

## หยุดระบบชั่วคราว

```bash
docker compose stop
```

---

## ลบ Containers และ Network เพื่อรีเซ็ตระบบ

```bash
docker compose down
```

---

## ตรวจสอบสถานะ Containers

```bash
docker ps
```

---

## ดู Log ของ Laravel Container

```bash
docker compose logs ticket-flix-api
```

---

# 🧰 Tech Stack

* Laravel
* PHP
* Docker
* MySQL
* Composer

---
