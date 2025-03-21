# 🎓 Student Information 
*by Kevin Dworschak*  
*Student at Arteveldehogeschool – Graduate Degree in Programming*  

---

## 🎓 Internship Management Platform

This web application is designed to simplify and streamline the internship process between **students**, **companies**, and **coordinators**. It provides functionality for proposing, reviewing, and approving internships while managing CVs, company profiles, and stage (internship) offers.

---

## 🧱 Tech Stack

- **Laravel** (Backend & API)
- **Blade** (Server-side rendering)
- **Tailwind CSS** (Styling)
- **MariaDB** (Relational Database)
- **DigitalOcean** (Hosting/Deployment)
- **Authentication** via Laravel Breeze
- **Role-based access** for:
  - Students
  - Coordinators
  - Companies

---

## ✨ Key Features

### Students can:
- Browse and filter available internships (stages)
- Upload and manage their CV
- Submit proposals linked to internships
- View proposal statuses and feedback

### Companies can:
- Register and manage their profiles
- Add new internships
- See students who have submitted proposals to their internships

### Coordinators can:
- Approve or reject companies and internships
- Review student proposals
- Give feedback on CVs
- See an overview of companies and students per studyfield

---

## 🛠️ Problems Solved

Before the redesign and rebuild of this platform, several issues made the system inefficient for students, companies, and coordinators:

- ❌ **Outdated User Interface**  
  The previous version had a non-intuitive, outdated design which made navigation and interaction frustrating for users.  
  ✅ *The design is modern and simplified. The forms are also much simpler.*

- ❌ **Cumbersome Company Registration**  
  Registering as a company required too many manual steps, often resulting in drop-offs or incorrect data.  
  ✅ *Now, company registration is streamlined into a single form, including logo upload and relevant data capture.*

- ❌ **Difficult Communication Flow**  
  There was no clear way for companies, students, and coordinators to interact effectively within the platform.  
  ✅ *Coordinators can now view associated students per company, give feedback on CVs and proposals, and track everything from one dashboard.*

- ❌ **Manual Communication Around Company Approval**  
  Coordinators had to manually notify companies when their application was accepted or denied.  
  ✅ *Automated emails are now sent to companies when they are approved or rejected, saving time and ensuring instant feedback.*

- ❌ **Excessive Form Fields for Students**  
  Students had to manually fill in too much data, even when selecting a predefined internship.  
  ✅ *If a student selects an internship, much of the company and mentor information is automatically pre-filled, reducing friction and errors.*

Overall, this rebuild focused on making the experience faster, more modern, and more intuitive for all parties involved.

---

## 🚀 Installation (Local Setup)

```bash
git clone https://github.com/kefmaister/afstudeerproject-kefmaister.git
cd project
composer install
cp .env.example .env
php artisan key:generate
# Configure your .env (DB, mail, etc.)
php artisan migrate --seed
npm install && npm run build
php artisan serve
```

---

## 🌐 Live Demo

**Deployed Website:**  
👉 [https://smartdatabase-project-final-kgxow.ondigitalocean.app](https://smartdatabase-project-final-kgxow.ondigitalocean.app/)

---

## 👤 Testing Accounts (Deployed Version)

All passwords: `password`

| Role        | Email                   |
|-------------|-------------------------|
| Student     | `student@mail.com`      |
| Coordinator | `coordinator@mail.com`  |
| Coordinator | `coord@mail.com`        |
| Company     | `alice@company.com`     |
| Company     | `bob@company.com`       |
| Company     | `charlie@company.com`   |

> ⚠️ These accounts only work with the **deployed database**.

---

## 🧪 Testing Accounts (Local Database)

If you're testing locally, use:

| Role        | Email                 |
|-------------|-----------------------|
| Student     | `student@mail.com`    |
| Coordinator | `coordinator@mail.com`|
| Company     | `company@mail.com`    |

All passwords: `password`
