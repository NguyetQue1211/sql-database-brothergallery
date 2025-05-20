# Brother Gallery Database System

## 📚 Project Overview

This is a SQL + PHP-based database system for managing artwork, customers, orders, and sales staff for the fictional **Brother Gallery**. The system was developed as part of a final project for a Database Systems course.

The database stores information about:
- Customers and their contact details
- Artworks (including name, style, price, and date created)
- Sales staff members
- Orders and purchased artworks

## 🧩 Features

### ✅ Database Design
- **5 fully normalized tables** (`CUSTOMER`, `ARTWORK`, `SALESPERSON`, `ARTWORK_ORDER`, `PURCHASED_ARTWORK`)
- **Entity Relationship** and **relationship cardinalities** included
- Ensures data consistency through foreign keys and composite primary keys

### 🛠 SQL Functionalities
- **View**: `PurchasingOfCustomer` — combines customer, order, and artwork data
- **Stored Procedure**: `DeletePurchasedArtwork` — prevents deletion if only one artwork remains in an order

### 🌐 Web Interfaces (PHP)
- [`QueryStaffSales.php`](http://103.42.58.103/plesk-site-preview/s200168.fuv.edu.vn/https/103.42.58.103/QueryStaffSales.php): View total sales by staff
- [`insertNewArtwork.php`](http://103.42.58.103/plesk-site-preview/s200168.fuv.edu.vn/https/103.42.58.103/insertNewArtwork.php): Insert a new artwork
- [`UpdateArtwork.php`](http://103.42.58.103/plesk-site-preview/s200168.fuv.edu.vn/https/103.42.58.103/UpdateArtwork.php): Update artwork info
- [`Query3Tables.php`](http://103.42.58.103/plesk-site-preview/s200168.fuv.edu.vn/https/103.42.58.103/Query3Tables.php): Join data from 3 related tables
- [`insertIntersectionTable.php`](http://103.42.58.103/plesk-site-preview/s200168.fuv.edu.vn/https/103.42.58.103/Insert_NM_tables.php): Insert data into `PURCHASED_ARTWORK`

## 📂 File Structure

📁 BrotherGallery/
├── BROTHER_GALLERY-1.sql # SQL file for schema & sample data
├── insertNewArtwork.php # PHP file for inserting new artwork
├── UpdateArtwork.php # PHP file for updating artwork
├── Query3Tables.php # PHP file for 3-table JOIN query
├── QueryStaffSales.php # PHP file for querying staff sales
├── insertIntersectionTable.php # PHP file for inserting N:M relationship
└── Final Project_Database System.pdf # Documentation & ER diagram

## 📌 Notes
- All database operations have been tested on MySQL.
- Stored procedure includes logic for rollback and transaction management.
- The application is structured to support easy scalability for new tables or functions.
