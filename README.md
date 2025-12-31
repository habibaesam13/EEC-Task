
# EEC Pharmacies & Products Management System

## 📌 Overview

This project is a **Laravel-based system** built for **EEC Group** to manage **Products** and **Pharmacies** with a **many-to-many relationship** between them.
Each pharmacy can sell many products, and each product can be available in multiple pharmacies with **different prices**.

The system includes:

* RESTful **APIs**
* **MVC web application** (Bootstrap UI)
* **CLI command** for querying cheapest pharmacies
* Optimized database design
* Large-scale seeding for load testing (50k+ records)
* Clean **N-Tier Architecture** (Controllers → Services → Repositories → Models)

---

## 🏗️ Architecture

The project follows a **layered architecture**:

```
Controllers (API / MVC)
        ↓
Services (Business Logic)
        ↓
Repositories (DB Queries)
        ↓
Models (Eloquent ORM)
```
---

## 🗄️ Database Design

### Products Table

| Column      | Type    |
| ----------- | ------- |
| id          | bigint  |
| title       | string  |
| description | text    |
| image       | string  |
| price       | decimal |
| quantity    | integer |
| timestamps  |         |

### Pharmacies Table

| Column     | Type   |
| ---------- | ------ |
| id         | bigint |
| name       | string |
| address    | string |
| timestamps |        |

### Pivot Table: `pharmacy_product`

| Column      | Type    |
| ----------- | ------- |
| product_id  | bigint  |
| pharmacy_id | bigint  |
| price       | decimal |
| timestamps  |         |

✔ Each product can have a **different price per pharmacy**
✔ Indexed foreign keys for performance

---

## 🌱 Seeders & Factories (Load Testing)

To ensure scalability, large datasets were generated:

```php
Product::factory(50000)->create();
Pharmacy::factory(20000)->create();
$this->call(PharmacyProductSeeder::class);
```

### Pivot Seeder Optimization

* Uses `chunk()` to prevent memory overflow
* Attaches **random pharmacies (3–10)** per product
* Uses bulk `attach()` with pivot prices

This simulates **real production load** efficiently.

---

## 🔌 RESTful API Endpoints

### Products API

```http
GET    /api/products/index
POST   /api/products/store
GET    /api/products/show/{product}
PUT    /api/products/update/{product}
DELETE /api/products/delete/{product}
```

### Pharmacies API

```http
GET    /api/pharmacies/index
POST   /api/pharmacies/store
GET    /api/pharmacies/show/{pharmacy}
PUT    /api/pharmacies/update/{pharmacy}
DELETE /api/pharmacies/delete/{pharmacy}
```

---

## 🖥️ MVC Web Application

### Product Pages

* Product listing with pagination
* Search products by **name / description / price**
* Clickable product cards
* Product details page showing:

  * Title
  * Description
  * Table of pharmacies with prices
* Create / Update / Delete products
* Default image fallback if image not found

### Pharmacy Pages

* Full CRUD
* Clean Bootstrap UI

### Routing Example

```php
Route::prefix('products')->group(function(){
    Route::get('/', [ProductController::class,'index'])->name('products');
    Route::get('/create', [ProductController::class,'create'])->name('products.create');
    Route::post('/store', [ProductController::class,'store'])->name('products.store');
    Route::get('/{product}', [ProductController::class,'show'])->name('products.show');
    Route::get('/{product}/edit', [ProductController::class,'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class,'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class,'destroy'])->name('products.delete');
});
```

---

## 🔍 Search Functionality

* Dedicated search page (as required)
* Search by:

  * Product title
  * Description
  * Price
* Implemented using **SQL LIKE** with indexing
* Results are **clickable cards**
* Redirects to product details page

---

## 🧠 Query Optimization

✔ Used `select()` to avoid unnecessary columns
✔ Used `chunk()` for seeding
✔ Used pivot table indexing
✔ Used `orderBy` + `limit` at DB level
✔ No N+1 queries
✔ Cursor pagination for large datasets

---

## 🧾 CLI Command (Artisan)

### Command

```bash
php artisan products:search-cheapest {productId}
```

### Purpose

Returns the **cheapest 5 pharmacies** that sell a given product.

### Output (JSON)

```json
[
    {
        "Pharmacy id": 12,
        "Pharmacy name": "Health Plus",
        "price": 45.50
    }
]
```

---

## 🛠️ Installation & Setup

```bash
git clone <[repository-url](https://github.com/habibaesam13/EEC-Task)>
cd project
composer install
cp .env.example .env
php artisan key:generate
```

### Configure `.env`

* Database credentials

### Run Migrations & Seeders

```bash
php artisan migrate
php artisan db:seed
```

### Run Server

```bash
php artisan serve
```

---

## 📌 Notes

* No authentication required (as requested)
* Bootstrap used for UI
* Clean separation between API & MVC
* Production-ready structure
* Designed for **high-volume datasets**

---

## ✅ Task Coverage Summary

✔ Products CRUD
✔ Pharmacies CRUD
✔ Search page
✔ Clickable products
✔ Product details with pharmacy prices
✔ REST APIs
✔ CLI command
✔ Load testing with large datasets
✔ README documentation


