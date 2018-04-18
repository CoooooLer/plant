### 1.配置文件

复制 `.env.example` 文件，更改数据库配置，重命名为 `.env` 

### 2.安装依赖
```
  composer install
```
### 3.创建上传图片目录
```
 artisan plant:init   
```
### 4.创建数据表
```
php artisan migrate
```
### 5.创建管理员
```
php artisan db:seed
```


