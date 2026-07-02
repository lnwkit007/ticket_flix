<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;
use App\Models\MovieTag;
use App\Models\Theater;
use App\Models\TheaterType;
use App\Models\Showtime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. สร้างประเภทโรงหนัง (Theater Types)
        $imax = TheaterType::create(['theater_type_name' => 'IMAX 3D']);
        $standard = TheaterType::create(['theater_type_name' => 'Standard Digital']);

        // 2. สร้างโรงหนัง (Theaters)
        $theater1 = Theater::create([
            'theater_name' => 'โรงภาพยนตร์ที่ 1 (IMAX)',
            'seats_maximum' => 300,
            'theater_type_id' => $imax->id
        ]);
        $theater2 = Theater::create([
            'theater_name' => 'โรงภาพยนตร์ที่ 2',
            'seats_maximum' => 160,
            'theater_type_id' => $standard->id
        ]);

        // 3. สร้างแท็กหนัง (Movie Tags)
        $action = MovieTag::create(['movie_tag_name' => 'Action']);
        $scifi  = MovieTag::create(['movie_tag_name' => 'Sci-Fi']);
        $drama  = MovieTag::create(['movie_tag_name' => 'Drama']);

        // 4. สร้างรายชื่อหนัง (Movies)
        $movie1 = Movie::create([
            'movie_title' => 'Avengers: Endgame',
            'movie_synopsis' => 'เมื่อธานอสดีดนิ้วหายไปครึ่งจักรวาล เหล่าฮีโร่ที่เหลือต้องร่วมมือกันกู้โลกกลับคืนมา'
        ]);
        $movie2 = Movie::create([
            'movie_title' => 'Interstellar',
            'movie_synopsis' => 'การเดินทางข้ามอวกาศผ่านรูหนอนเพื่อค้นหาบ้านหลังใหม่ให้มนุษยชาติ'
        ]);

        // 🔥 5. ผูกความสัมพันธ์ตารางกลางตรงนี้เลย (ชัวร์ที่สุด!)
        // ใช้ตัวแปรหนังที่เพิ่งกดสร้างเสร็จสั่งผูก ID ของแท็กเข้าตาราง movie_tag_pivot ทันที
        // เปลี่ยนจาก attach() เป็น sync() เพื่อป้องกันข้อมูลซ้ำซ้อน
        $movie1->tags()->sync([$action->id, $scifi->id]);
        $movie2->tags()->sync([$scifi->id, $drama->id]);

        // 6. สร้างรอบฉาย (Showtimes)
        Showtime::create([
            'start_time' => '2026-05-20 14:00:00',
            'base_price' => 250.00,
            'movie_id' => $movie1->id,
            'theater_id' => $theater1->id
        ]);
        Showtime::create([
            'start_time' => '2026-05-20 18:30:00',
            'base_price' => 160.00,
            'movie_id' => $movie1->id,
            'theater_id' => $theater2->id
        ]);
        Showtime::create([
            'start_time' => '2026-05-21 15:00:00',
            'base_price' => 220.00,
            'movie_id' => $movie2->id,
            'theater_id' => $theater1->id
        ]);

        // 7. สร้างผู้ใช้งานจำลอง (User)
        User::create([
            'user_name' => 'Somchai Dev',
            'user_email' => 'somchai@example.com'
        ]);
    }
}
