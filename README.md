Project Setup :

1. clone repository dari github.

2. jalankan perintah :

    ```
    composer install
    ```

3. Duplikat file `.env.example` kemudian ubah namanya menjadi `.env`.

4. jalankan perintah :

    ```
    php artisan key:generate
    ```

5. buat database dengan nama : `warehouse`.

6. Ubah konfigurasi database pada file `.env`
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=warehouse
    DB_USERNAME=root
    DB_PASSWORD=
    ```
7. jalankan perintah :
    ```
    php artisan migrate:fresh --seed
    ```
8. jalankan perintah :
    ```
    npm install
    ```
9. jalankan perintah :
    ```
    npm run dev
    ```
10. jalankan perintah :

    ```
    php artisan serve
    ```

    / pakai valet bila ada9

11. buka browser `http://127.0.0.1:8000`

12. akses halaman admin dengan beri url `/admin-001-login` seperti contoh : `http://127.0.0.1:8000/admin-001-login`

13. sign-in / login ke halaman admin :

    ```
    Username : admin
    Password : admin123

    Username : admin1
    Password : admin123
    ```
14. sign-in / login ke halaman tenant :

    ```
    Username : tenant
    Password : tenant123
    ```

# warehouse