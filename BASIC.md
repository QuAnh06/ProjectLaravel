# Cấu trúc thư mục trong Laravel 12
-----
- Luồng Request: 
   `Người dùng -> Request -> Middleware -> Controller -> Views -> Người dùng`

## 1. `app/` : Là nơi chứa **logic cốt lõi** của ứng dụng Laravel.

### Các thư mục con:
   - `Http/`: cầu nối giữa **request từ người dùng** và **phản hồi từ ứng dụng**. Gồm 3 phần: Controllers, Middleware, Form Request.

   #### - `Requests`: kiểm tra dữ liệu đầu vào
   -- Là nơi xử lí Form Request Validation - kiểm tra dữ liệu người dùng gửi lên (từ form hoặc API).
      Ví dụ: 'LoginRequest', 'CreateUserRequest'

   -- Tạo request bằng lệnh `php artisan make:request "LoginRequest"`


   #### - `Middleware`: lớp bảo vệ giữa request và controller
   -- kiểm tra hoặc can thiệp vào request trước khi nó đến Controller.
      Ví dụ: xác thực người dùng (auth), kiểm tra quyền (isAdmin), giới hạn truy cập IP,...

   -- Tạo middleware bằng lệnh `php artisan make:middleware "AuthMiddleware"`

   -- Đăng kí Middeleware trong `\bootstrap\app.php`, ;   `Global, Aliases` middeleware.
      Xử lí logic trong `Middleware`, sau đó tích hợp middleware vào `route hoặc controller`



   #### - `Controllers`: Bộ điều khiển 
   -- **xử lí request**, gọi model, và trả về response (view hoặc JSON).
   -- Mỗi Controller đại diện cho 1 chức năng (UserController, ProductController).

   -- Tạo controller bằng lệnh `php artisan make:controller "UserController"`

   -------

   - `Models/`: Nơi đặt các class model, đại diện cho bảng trong CSDL.

   -`Providers/`: Nơi đăng kí các Service Providers (khởi tạo logic hoặc dịch vụ).

   - *Resource Controller* : là loại controller có sẵn 7 phương thức khi thao tác `CRUD` (Create, Read, Update, Delete)
      + `php artisan make:controller UserController --resource`
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

- `migrations/`: quản lí các thay đổi cấu trúc bảng, tạo bảng (định nghĩa cấu trúc bảng).

   -- **Illuminate\Database\Schema\Blueprint**
      *Schema::create()*
      $table->id()
      $table->string()
      $table->text()
      $table->timestamps()

   -- Chạy lệnh: `php artisan make:migration add_status_to_users_table` : thêm cột vào bảng
                -> `php artisan migrate` : để cập nhật vào database.  ( `php artisan migrate    --path=database/migrations/2024_01_01_000000_add_role_to_users_table.php` : update cho 1 bảng)
                
                -> `php artisan migrate:rollback` : undo thay đổi vừa chạy

   -- Chạy lệnh: `php artisan make:model Name -m` để tạo bảng (Migration), tạo `Models\`


-`seeders/`: thêm dữ liệu mẫu cho bảng.

-`factories/`: tạo dữ liệu mẫu để test.
    
 (-- Có thể chạy `php artisan migrate --seed` để tạo bảng và thêm dữ liệu mẫu nhanh chóng.

  -- Chạy lệnh: `php artisan db:seed` => đổ dữ liệu mẫu vào database.
                `php artisan db:seed --class=UserSeeder`
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

- Tạo routes với tham số: Ví dụ: `/users/{id} //Tham số bắt buộc`
                                 `/users/{name?}  // Tham số không bắt buộc`

- `Route::controller(PageController::class) -> group(function (){`
      Route::get('/', 'home');
      Route::get('/', 'index');
});

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


#### FLOW REQUEST → RESPONSE TRONG LARAVEL
🌍 Trình duyệt: Nhấn nút "Lưu".
   |
   v
📂 Route: Kiểm tra URL /users (POST) -> Chuyển đến UserController@store. (use ...\*Controller) (Route:: )
   |
   v
🛂 Middleware: Kiểm tra đăng nhập (nếu có), kiểm tra CSRF Token (bảo mật).
   |
   v
🗺️ Controller (Store): (use App\Models\...) (public function ...)
   🛡️ Validation: Nếu nhập sai (thiếu email, sai status) -> Quay lại View kèm lỗi ($errors).
   📦 Model: Nếu nhập đúng -> Gọi `User::create($request->all())`.
   |
   v
📦 Model / DB         (lấy dữ liệu) (Models\ )
   |
   v
📤 Response           (HTML / JSON)
   |
   v
🌍 Trình duyệt


-- public function store(Request $request) {
    $request->validate(['password' => 'required|min:8']); // Dùng Request
    
    $user = User::create([ // Dùng Model
        'name' => $request->name,
        'password' => Hash::make($request->password), // Dùng Hash
    ]);
    
    Auth::login($user); // Dùng Auth
    
    return redirect()->route('home')->with('success', 'Chào mừng!'); // Dùng Redirect + Session
}

#### Các loại quan hệ truy vấn:

-- Quan hệ Một - Một (One-to-One):
   - Tại Model chính (User):

      public function profile() {
      return $this->hasOne(Profile::class, 'user_id', 'id');
   }
   - Tại Model phụ (Profile - Nghịch đảo):

   public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
   }

--Quan hệ Một - Nhiều (One-to-Many) : (hasMany, belongsTo)
--Quan hệ Nhiều - Nhiều (Many-to-Many) : (belongsToMany, belongsToMany)
