# Cấu trúc thư mục trong Laravel 12
-----

## 1. `app/` : Là nơi chứa **logic cốt lõi** của ứng dụng Laravel.

### Các thư mục con:
    - `Http/`: cầu nối giữa **request từ người dùng** và **phản hồi từ ứng dụng**. Gồm 3 phần: Controllers, Middleware, Form Request.
        
    #### - `Controllers`: Bộ điều khiển 
    -- **xử lí request**, gọi model, và trả về response (view hoặc JSON).
    -- Mỗi Controller đại diện cho 1 chức năng (UserController, ProductController).
    -- Tạo controller bằng lệnh `php artisan make:controller "UserController"`

    #### - `Middleware`: lớp bảo vệ giữa request và controller
    -- kiểm tra hoặc can thiệp vào request trước khi nó đến Controller.
       Ví dụ: xác thực người dùng (auth), kiểm tra quyền (isAdmin), giới hạn truy cập IP,...
    -- Tạo middleware bằng lệnh `php artisan make:middleware "AuthMiddleware"`

    #### - `Requests`: kiểm tra dữ liệu đầu vào
    -- Là nơi xử lí Form Request Validation - kiểm tra dữ liệu người dùng gửi lên (từ form hoặc API).
        Ví dụ: 'LoginRequest', 'CreateUserRequest'
    -- Tạo request bằng lệnh `php artisan make:request "LoginRequest"`
    -------

    - `Models/`: Nơi đặt các class model, đại diện cho bảng trong CSDL.

    -`Providers/`: Nơi đăng kí các Service Providers (khởi tạo logic hoặc dịch vụ).

----

## 2. `bootstrap/` -- Khởi động ứng dụng
    - Chứa file `app.php` để khởi tạo và bootstrap ứng dụng.
    - Thư mục `cache/`: chứa file cache cấu hình giúp tăng tốc độ xử lí.

---

## 3. `config/` - Cấu hình hệ thống
Chứa tất cả các tệp cấu hình của ứng dụng.

**Ví dụ:**
- `app.php` : cấu hinh tên app, timezone, ...
- `database.php` : thông tin kết nối CSDL.

## 4. `database/` - Tất cả liên quan tới dữ liệu
- `migrations/`: quản lí các thay đổi cấu trúc bảng.
-`seeders/`: thêm dữ liệu mẫu cho bảng.
-`factories/`: tạo dữ liệu mẫu để test.
    
    (-- Có thể chạy `php artisan migrate --seed` để tạo bảng và thêm dữ liệu mẫu nhanh chóng.
     -- Chạy lệnh: `php artisan db:seed` => Chỉ tạo dữ liệu mẫu.
    )
----

## 5. `public/` - Cổng vào của ứng dụng

Đây là thư mục duy nhất trình duyệt web truy cập được.

- Chứa `index.php` - file chạy chính của Laravel.
- Chứa tài nguyên tĩnh: ảnh, CSS, JS,...

(Nếu deploy online, cấu hình web server trỏ vào thư mục `public/`.)

----

## 6. `resources/` - Giao diện người dùng và ngôn ngữ

- `views/`: nơi chứa các file Blade template (HTML) =>  tạo giao diện.
- `lang/`: chứa file ngôn ngữ đa ngữ (đa ngôn ngữ).
- `js/`, `css/`: nơi bạn viết front-end (nếu dùng Laravel Mix/Vite).

----

## 7. `routes/` - Định nghĩa các đường dẫn trong ứng dụng (URL)

- `web.php`: route cho giao diện web.
- `api.php`: route cho RESTful API.
- `console.php`: định nghĩa lệnh artisan.
- `channels.php`: dùng cho Broadcast event qua websocket.

(Khi truy cập 1 đường dẫn, Laravel sẽ kiểm tra route ở đây trước).

----

## 8. `storage/` - Lưu trữ tạm và người dùng

- `app/`: lưu các file upload từ người dùng.
- `framework/`: cache, sessions, views,...
- `logs`: ghi log hoạt động ứng dụng.

(Thư mục này thường cần phân quyền ghi khi deploy)

----

## 9. `tests/` - Kiểm thử ứng dụng

- `Feature/`: kiểm thử tính năng (sát với thực tế)
- `Unit/`: kiểm thử đơn vị (logic nhỏ, độc lập)

(Laravel sử dụng PHPUnit để test. Bạn có thể viết test để kiểm tra tính ổn định hệ thống)

----

## 10. `vendor/` - Thư viện bên thứ ba

Chứa toàn bộ package được cài qua Composer. Không nên chỉnh sửa trực tiếp file trong này.

----

## 11. Các tệp gốc quan trọng

- `.env`: cấu hình môi trường (database, private key,...)
- `composer.json`: khai báo các dependency
- `artisan`: CLI giúp chạy các lệnh Laravel như migrate, route:list,...

---

---

## **Để tạo một chức năng hoàn chỉnh** (ví dụ: quản lý sản phẩm, bài viết)

Thường tuân theo mô hình **MVC (Model-View-Controller)**.

### 4 file tối thiểu cần tác động:
| Thành phần | Vị trí | Mục đích |
|-----------|--------|---------|
| **Route** | `routes/web.php` | Định nghĩa đường dẫn URL |
| **Controller** | `app/Http/Controllers/` | Xử lí logic request |
| **Model** | `app/Models/` | Giao tiếp với database |
| **View** | `resources/views/` | Hiển thị giao diện |

---

### **Ví dụ thực tế: Tạo chức năng "Bài viết" (Post)**

#### **Bước 1️: Tạo Model, Migration và Controller cùng lúc**
```bash
php artisan make:model Post -mc
```
-- Lệnh này tạo ra:
  - File Model: `Post.php`
  - File tạo bảng Database: Migration
  - File Controller: `PostController.php`

---

#### **Bước 2️: Định nghĩa Route**
Mở `routes/web.php` và thêm:
```php
use App\Http\Controllers\PostController;
Route::get('/posts', [PostController::class, 'index']);
```
---

#### **Bước 3️: Viết logic trong Controller**
Mở `PostController.php`:

```php
public function index() {
    $posts = Post::all(); // Lấy tất cả bài viết
    return view('posts.index', compact('posts')); // Trả về giao diện
}
```
---

#### **Bước 4️: Tạo giao diện**
Tạo file `resources/views/posts/index.blade.php` để hiển thị danh sách bài viết.