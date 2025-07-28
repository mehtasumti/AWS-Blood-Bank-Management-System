# 🩸 AWS Blood Bank Management System

A dynamic web-based Blood Bank Management System built using **PHP**, **MySQL**, and hosted on **Amazon Web Services (AWS)**. This project enables users to register as blood donors, search for available blood groups, and manage blood donation data through a user-friendly web interface.

The system is deployed using **EC2**, **S3**, and optionally **RDS**, and is fully configurable to work in both local and cloud environments.

---

## 🌟 Features

- User & donor **registration system**
- **Login/logout** authentication module
- **Blood search** by group or location
- **MySQL database** connectivity (EC2 or RDS)
- Static resources (images/CSS) managed through **S3**
- Fully hosted on **EC2 Linux web server**

---

## 🚀 Step-by-Step Deployment Guide

### 1. 📂 Understand the Code
- `connection.php` manages DB connectivity — update it with your database IP/credentials.
- `insert.php`, `register.php`, `login.php` handle core logic.
- HTML & CSS files define layout, stored in `style.css`.

---

### 2. 🪣 Create an S3 Bucket & Upload Code
- Go to **S3 Console** → Create bucket (e.g., `bloodbank-code-bucket`)
- Upload all project files
- Optional: Enable static website hosting (for static assets like images/CSS)

---

### 3. 🔐 Create an IAM Role for EC2
- Navigate to **IAM → Roles**
- Create a role with:
  - **AmazonS3ReadOnlyAccess**
  - **AmazonRDSFullAccess** (if using RDS)
- Attach the role to your EC2 instance during launch

---

### 4. 💻 Launch EC2 Instance for Web Server

#### 4.1 Launch Instance
- Choose **Ubuntu** or **Amazon Linux 2**
- Instance type: `t2.micro` (Free Tier)
- Security Group:
  - HTTP (port 80) - open to all
  - SSH (port 22) - restrict to your IP
  - MySQL (port 3306) - only if you're hosting DB on this EC2

#### 4.2 Install LAMP Stack
sudo apt update
sudo apt install apache2 php php-mysql mysql-client -y

#### 4.3 Deploy Files

Copy files from S3:

aws s3 cp s3://your-bucket-name/ /var/www/html/ --recursive
OR use scp from your local system

### 5. 🛢️ Setup MySQL Database

Option A: MySQL on EC2

sudo apt install mysql-server -y
sudo mysql_secure_installation
Create DB and Tables manually

Update connection.php with:

$conn = mysqli_connect("localhost", "username", "password", "dbname");
Option B: Use AWS RDS
Launch RDS MySQL instance

Whitelist EC2 security group

Use RDS endpoint in connection.php:

$conn = mysqli_connect("rds-endpoint", "admin", "password", "dbname");


### 6. 🧰 (Optional) Configure MySQL Workbench
   
Download & install MySQL Workbench

Connect to RDS or EC2 DB using credentials

Create database tables and test connection

### 7. 🌐 Test the Website
   
Visit EC2 Public IP in browser

Try:

Registering a donor

Searching by blood group

Logging in/out

Checking DB entries

#### 📁 File Overview
File	Description
index.php	Landing page
register.php	Donor registration form
login.php	User login interface
logout.php	Logout functionality
insert.php	Inserts form data into DB
connection.php	DB connection logic
search1.php	Search by blood group
style.css	Stylesheet
blood-bank.jpg, Redblood.jpg	Image assets

#### 🔐 Security Tips
⚠️ Never upload .pem keys to GitHub

Use environment variables or secrets manager for DB credentials

Validate user input to prevent SQL injection

Enable HTTPS and secure EC2 with security groups

👨‍💻 Author
Sumti Mehta
AWS Certified Cloud Engineer | DevOps Enthusiast
GitHub: @mehtasumti


