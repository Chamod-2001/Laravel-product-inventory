# Laravel-product-inventory

# 🛒 Product Inventory Management System

A Laravel-based backend management panel for a store's product inventory.

This project was built as part of a Laravel practical assessment to demonstrate CRUD operations, database relationships, validation, file handling, performance optimization, and soft delete functionality.

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

## ⚙️ Installation Instructions

1. Clone the repository:

```bash
git clone https://github.com/YOUR-USERNAME/YOUR-REPO.git


