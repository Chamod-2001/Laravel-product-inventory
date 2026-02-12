# Laravel-product-inventory

# 🛒 Product Inventory Management System

A Laravel-based backend management panel for a store's product inventory.

This project was built as part of a Laravel practical assessment to demonstrate CRUD operations, database relationships, validation, file handling, performance optimization, and soft delete functionality.

---

## 🎥 Demo Video

You can watch the system demo here:

👉 https://drive.google.com/drive/folders/1Mmyn66__W7pQnW4s7oIH9aliCGScKZme?usp=sharing

---

## 🚀 Tech Stack

- **Framework:** Laravel 11
- **PHP Version:** 8.4+
- **Database:** MySQL / SQLite
- **Frontend:** Blade Templates + Bootstrap 5
- **Image Processing:** Intervention Image
- **Version Control:** Git

---

## 📦 Features Implemented

### ✅ Core Requirements

- Create Product
- Read (List) Products
- Update Product
- Soft Delete Product
- One-to-Many Relationship (Category → Products)
- Many-to-Many Relationship (Products ↔ Tags)
- Form Validation with Error Display
- Unique SKU Handling (Auto-generated if empty)
- Image Upload with Type Restriction (JPG/PNG only)
- N+1 Query Problem Prevented using Eager Loading

---

### 🚀 Bonus Features

- Trash View for Soft Deleted Products
- Restore Deleted Products
- Permanent Delete (Force Delete)
- Image Optimization (Resized to max 300x300px)
- Admin Panel Layout with Sidebar Navigation

---

## 🗂 Database Structure

### Categories
- id
- name

### Tags
- id
- name

### Products
- id
- name
- sku (unique)
- price
- stock_quantity
- image_path
- category_id
- deleted_at (Soft Delete)

### Pivot Table
- product_tag

---

## 🖼 Image Handling

- Only JPG and PNG images allowed
- Images resized to maximum 300x300 pixels
- Old image deleted when replacing during update

## 🧠 Performance Optimization
- To prevent the N+1 query issue, eager loading is used:
  ```bash
  Product::with(['category', 'tags'])->latest()->get();
    ```
## Notes

- Soft Deletes are enabled.
- Deleted products can be restored from the Trash page.
- Permanent deletion removes both database record and stored image.







