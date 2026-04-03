# 🚀 Campus Management System Deployment Guide

This guide will help you move your project from XAMPP to a live web server.

---

## Option 1: Railway (Modern & Recommended)
Railway is the best choice for this project. It handles PHP and MySQL seamlessly.

### 1. Account Setup
- Go to [Railway.app](https://railway.app/) and sign up with your **GitHub** account.
- Click **"New Project"** -> **"Provision MySQL"**. This gives you a live database.

### 2. Import Database
- In your Railway dashboard, click on the **MySQL** service.
- Go to the **"Variables"** tab to see your `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, etc.
- To import your data:
  1. Open XAMPP PHPMyAdmin.
  2. Export your `_sms` database.
  3. Use a tool like **DBeaver** or the Railway CLI to import the `.sql` file into Railway's MySQL.

### 3. Deploy Code
- Create a new repository on GitHub and push your local project there.
- In Railway, click **"New Project"** -> **"Deploy from GitHub repo"**.
- Select your repo. Railway will detect PHP and deploy it automatically.

### 4. Set Environment Variables
In Railway, go to your PHP Service -> **Variables** and add these:
- `DB_HOST`: Your Railway MySQL host
- `DB_USER`: Your Railway MySQL user
- `DB_PASS`: Your Railway MySQL password
- `DB_NAME`: Your Railway MySQL database name

---

## Option 2: 000webhost (Traditional Free Hosting)
If you don't use GitHub, 000webhost is a good alternative.

### 1. Upload Files
- Log in to 000webhost and go to **File Manager**.
- Upload all folders and files from `c:\xampp\htdocs\campus` into the `public_html` folder.

### 2. Setup Database
- Go to **Tools** -> **Database Manager**.
- Create a new database and user. **Note down the Host, DB Name, and User.**
- Open **PHPMyAdmin** on 000webhost and **Import** your `database/_sms.sql` file.

### 3. Configure Credentials
Since 000webhost doesn't easily support environment variables in the free tier, you can edit `assets/config.php` directly on their file manager:
- Set `$server = "localhost"` (usually).
- Set `$user`, `$password`, and `$db` to the ones you just created.

---

## ✅ Final Pre-Flight Checklist
- [ ] **Check Paths**: Ensure all images and links work. If they don't, check if the server is case-sensitive (Linux servers are, Windows/XAMPP is not).
- [ ] **Permissions**: Ensure folders like `adminUploads/` have write permissions (usually 755 or 777 on Linux).
- [ ] **PHP Version**: Ensure the server is running PHP 8.0 or higher.
