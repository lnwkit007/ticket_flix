<script setup lang="ts">
import { RouterLink } from "vue-router";
</script>

<template>
  <footer class="border-b-[3.5px] border-[#DE0000] bg-[#111111]">
    <div class="mx-auto max-w-307.5 px-4 pt-7 pb-8 text-[#ccc]">
      <div
        class="grid grid-cols-1 lg:grid-cols-[2.5fr_1fr_1fr_1fr_1fr] lg:gap-4 xl:gap-7"
      >
        <!-- ////////// Box Address ////////// -->
        <div class="hidden lg:block">
          <RouterLink to="/">
            <img
              src="/images/logo/logo-ticket-flix-dark.png"
              alt="logo"
              class="inline-block w-40"
            />
          </RouterLink>

          <div class="my-5 flex flex-col gap-4">
            <p class="text-base font-semibold">
              บริษัท ทิคเก็ตฟลิกซ์ จำกัด
            </p>

            <p class="text-sm">
              <span> 8179 อาคารอารีนา ชั้น 207, ถนนพระราม 2,</span>
              <br />
              <span> ถนนนครปฐม เขตดุสิต กรุงเทพฯ 10300 </span>
            </p>

            <p class="text-sm">
              <span>
                โทร :
                <a href="tel:022623456" class="text-[#999] hover:underline">
                  012 345 6789
                </a>
              </span>
              <br />
              <span>
                อีเมล :
                <a
                  href="mailto:ticketflix@gmail.com"
                  class="text-[#999] hover:underline"
                >
                  ticketflix@gmail.com
                </a>
              </span>
            </p>
          </div>
        </div>

        <!-- ////////// Box ทิคเก็ตฟลิกซ์ ////////// -->
        <div class="border-b border-[#333333] lg:border-none">
          <h3 class="my-4 text-base font-semibold">ทิคเก็ตฟลิกซ์</h3>

          <ul class="my-4 text-sm text-[#999]">
            <li class="mb-2 hover:underline">
              <RouterLink to="/">เกี่ยวกับเรา</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/">นโยบายความเป็นส่วนตัว</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/">เงื่อนไขการใช้บริการ</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/">จุดจำหน่าย</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/">ติดต่อลงโฆษณา</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/">ร่วมงานกับเรา</RouterLink>
            </li>
          </ul>
        </div>

        <!-- ////////// Box บริการ ////////// -->
        <div class="border-b border-[#333333] lg:border-none">
          <h3 class="my-4 text-base font-semibold">บริการ</h3>

          <ul class="my-4 text-sm text-[#999]">
            <li class="mb-2 hover:underline">
              <RouterLink to="/">หน้าแรก</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/movies">ภาพยนตร์</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/concert">คอนเสิร์ต</RouterLink>
            </li>
          </ul>
        </div>

        <!-- ////////// Box ช่วยเหลือ ////////// -->
        <div class="border-b border-[#333333] lg:border-none">
          <h3 class="my-4 text-base font-semibold">ช่วยเหลือ</h3>

          <ul class="my-4 text-sm text-[#999]">
            <li class="mb-2 hover:underline">
              <RouterLink to="/">ติดต่อเรา</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/">คำถามที่พบบ่อย</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/">วิธีการชำระเงิน</RouterLink>
            </li>
            <li class="mb-2 hover:underline">
              <RouterLink to="/">สมัคร/ยกเลิกรับข่าวสาร</RouterLink>
            </li>
          </ul>
        </div>

        <!-- ////////// Box Contact ////////// -->
        <div class="text-center lg:text-start">
          <p class="my-4 text-xs">
            โทร
            <br />
            <a href="tel:022623456" class="text-2xl hover:underline">
              012 345 6789
            </a>
          </p>

          <div class="my-4 flex justify-center gap-2 lg:justify-start">
            <a href="/">
              <img
                src="/icons/facebook-circle.svg"
                alt="Facebook"
                class="h-6 w-6"
              />
            </a>
            <a href="/">
              <img src="/icons/line-circle.svg" alt="Line" class="h-6 w-6" />
            </a>
            <a href="/">
              <img
                src="/icons/instagram-circle.svg"
                alt="Instagram"
                class="h-6 w-6"
              />
            </a>
            <a href="/">
              <img
                src="/icons/youtube-circle.svg"
                alt="Youtube"
                class="h-6 w-6"
              />
            </a>
            <a href="/">
              <img src="/icons/x-circle.png" alt="X" class="h-6 w-6" />
            </a>
          </div>

          <p class="my-4 text-xs">
            © 2026
            <RouterLink to="/" class="text-[#999] hover:underline">
              ทิคเก็ตฟลิกซ์
            </RouterLink>
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>
