# Praktikum 4 - Autentikasi dengan Laravel Breeze

**Nama:** Andre Alfre  
**NPM:** 4523210018

## Langkah Langkah pengerjaan 
1. Install Laravel : composer create-project laravel/laravel LaraPress
2. Install Breeze : composer require laravel/breeze --dev 
3. Setup Breeze : php artisan breeze:install
4. Install npm : npm install 
5. Membuat database memakai xampp : LaraPress
6. Hubungkan database :
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larapress
DB_USERNAME=root
DB_PASSWORD=
7. Migrate database : php artisan migrate
8. Menjalankan server : php artisan serve dan npm run dev
9. Mencoba register akun untuk testing
10. Membuat Post controller : php artisan make:controller PostController --resource
11. Menambahkan routes dan web

## Screenshoots : 
nambahkan database di .env
<img width="1919" height="1017" alt="image" src="https://github.com/user-attachments/assets/f31b0373-83f8-4359-879b-774f53203ded" />
membuat post controller 
<img width="1288" height="289" alt="image" src="https://github.com/user-attachments/assets/92cfbee8-739e-4b9e-8cb5-63120fe63155" />
membuat index.blade.php 
<img width="1288" height="289" alt="image" src="https://github.com/user-attachments/assets/1305065a-6af9-4f62-af17-c150e1ee9de0" />
membuat crate.blade.php 
<img width="1432" height="651" alt="image" src="https://github.com/user-attachments/assets/beccfc6b-e4ff-42aa-ad86-2503b5b1b8a2" />
tampilan Ini adalah view posts/create.blade.php
<img width="964" height="566" alt="image" src="https://github.com/user-attachments/assets/d9eed590-594d-4e2b-b505-50d48b8b074f" />
<img width="296" height="136" alt="image" src="https://github.com/user-attachments/assets/906d9a6a-9f45-4d65-a5d4-fa086e257880" />
tampilan login dan home 
<img width="952" height="795" alt="image" src="https://github.com/user-attachments/assets/ad3af998-7dee-4bcd-9267-1efaa96804ee" />
<img width="954" height="270" alt="image" src="https://github.com/user-attachments/assets/ac0bc613-b16c-43b9-9414-9060f7bed420" />
jika sudah daftar akan terlihat di xampp 
<img width="1470" height="427" alt="image" src="https://github.com/user-attachments/assets/ece1e6d1-baca-4553-bbe2-ca7ec518ed1c" />



## Kesimpulan
pada praktikum ini, berhasil mengimplementasikan sistem authentifikasi dari register, login, dan logout. route CRUD menggunakan middleware aut jadi hanya user yang sudah terdaftar yang bisa melakukan perubahan create, edit, dan delete. menu home dapat diakses oleh publik tanpa login. 
