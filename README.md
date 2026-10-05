# ☁️ Cloud Lost & Found Portal

A smart Lost & Found web application for a college campus, powered by AWS cloud services. Students report lost or found items with a photo. **Amazon Rekognition** automatically detects what is in each photo, the system matches lost and found items by their detected labels, and the admin can send an email alert through **Amazon SNS**.

## Features
- **Report Lost / Report Found** forms (name, USN, email, phone, item details, location, photo)
- **Image storage** in Amazon S3
- **AI object detection** with Amazon Rekognition (labels such as "Backpack", "Phone", "Wallet")
- **Automatic matching**: a lost item and a found item are flagged as a possible match when they share 2 or more labels
- **Admin login and dashboard** showing all lost items, all found items and the matched pairs
- **One-click email notification** to subscribers through Amazon SNS
- Responsive UI built with Bootstrap 5

## Tech Stack
| Layer | Technology |
|---|---|
| Frontend | HTML, CSS, Bootstrap 5, Bootstrap Icons |
| Backend | PHP (PHP 8.4+) |
| Database | MySQL on Amazon RDS |
| Image storage | Amazon S3 |
| AI / image labels | Amazon Rekognition |
| Notifications | Amazon SNS |
| Hosting | Amazon EC2 (Apache + PHP) |
| Dependencies | AWS SDK for PHP (via Composer) |

## How it works
1. A student submits a lost or found report with a photo.
2. The photo is uploaded to **S3**, and its public URL is saved.
3. **Rekognition** detects labels in the photo (confidence of 70% or more).
4. The report and its labels are stored in **RDS (MySQL)**.
5. On the admin dashboard, lost and found items that share at least 2 labels are shown as a **match**.
6. The admin clicks **Notify**, and **SNS** emails the subscribed users.

## Project Structure
```
cloud-lost-found-portal/
├── index.php              # Home page
├── report-lost.php        # Lost item form
├── report-found.php       # Found item form
├── submit-lost.php        # Saves lost item (S3 + Rekognition + DB)
├── submit-found.php       # Saves found item (S3 + Rekognition + DB)
├── admin-login.php        # Admin login
├── dashboard.php          # Admin dashboard and matching
├── notify.php             # Sends SNS notification
├── view-item.php          # Item details page (placeholder)
├── includes/              # Shared header, navbar, footer
├── assets/                # CSS and JS
├── config/
│   ├── db.php             # Database connection
│   ├── aws.php            # S3, Rekognition and SNS clients
│   └── secrets.example.php  # Template for your private settings
├── database/schema.sql    # Database tables
├── composer.json
└── composer.lock
```

## Setup

### 1. AWS resources you need
- An **S3 bucket** (objects must be readable so the images show on the pages)
- An **RDS MySQL** database
- An **SNS topic** with at least one confirmed email subscription
- An **EC2 instance** with Apache and PHP 8.4+

### 2. Permissions
Attach an **IAM Role** to the EC2 instance with permission for:
- `s3:PutObject` on your bucket
- `rekognition:DetectLabels`
- `sns:Publish` on your topic

With a role attached you don't need any access keys in the code.

### 3. Get the code
```bash
cd /var/www/html
git clone https://github.com/Jalashree22/cloud-lost-found-portal.git
cd cloud-lost-found-portal
composer install
```
If your PHP is older than 8.4, run `composer update` instead of `composer install`.

### 4. Create the database
Run `database/schema.sql` on your RDS database:
```bash
mysql -h YOUR_RDS_ENDPOINT -u YOUR_USER -p < database/schema.sql
```

### 5. Add your private settings
```bash
cp config/secrets.example.php config/secrets.php
nano config/secrets.php
```
Fill in your database details, bucket name, SNS topic ARN and admin password. **`config/secrets.php` is in `.gitignore` and must never be uploaded to GitHub.**

### 6. Open the site
Visit `http://YOUR_EC2_PUBLIC_IP/cloud-lost-found-portal/`

## Screenshots
_Add screenshots of the home page, report form, dashboard and matches here._

## Security notes and future improvements
- Passwords and AWS settings are kept out of the code in `config/secrets.php`.
- Planned improvements: prepared SQL statements and output escaping, hashed admin password, a database-backed admin account, real counts on the home page (currently sample numbers), a full item details page, and notifying only the person whose item matched.

## Author
**Jalashree** · [GitHub](https://github.com/Jalashree22)
