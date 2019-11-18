# README #

This README would normally document whatever steps are necessary to get your application up and running.

### Structure folder ###

* |--assets/
* | |---dist/
* | |---font/
* | |---image/
* | |---scripts/
* | |---styles/
* |--pages/
* composer.json
* package.json
* index.php
* init.php
* header.php
* footer.php
* webpack.config.js

### Setup  ###

```
Request:
	- MENU: Tạo đúng cấu trúc class như trên Wordpress Ví dụ: class="menu-item ..."
	- Add `require "header.php";` and `require "footer.php";` into all single files.
	- Each page - create specific .scss file. Example: detail.scss, category.scss
	- Create specific .js file for a function. Example: menu.js, cart.js
	- All links is active
```

Bản dịch: 

```
Yêu cầu: 
	- Thêm `require "header.php";` và `require "footer.php";` vào trong tất cả các tệp đơn
	- Mỗi trang - Tạo 1 file .scss riêng rẽ. Ví dụ: detail.scss, category.scss
	- Tạo các file .js riêng rẽ theo chức năng. Ví dụ: menu.js, cart.js
	- Tất cả các link đều phải hoạt động (Tức là có thể click được)
```

- Chú ý: 
    + Tên domain ảo được cài đặt trong file init.php
    + Các link trên menu khi cần truyền link, có thể gọi: site_url('path_page')