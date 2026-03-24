# ⛓️ EduChain
### Blockchain-Based Academic Degree Verification Platform for Pakistan

> **Instant. Tamper-proof. Free.**
> Verify any Pakistani university degree in under 1 second using blockchain technology and the complete HEC university database.

---

## 📋 Table of Contents

- [Overview](#overview)
- [The Problem](#the-problem)
- [The Solution](#the-solution)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [User Roles](#user-roles)
- [How Verification Works](#how-verification-works)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Test Credentials](#test-credentials)
- [Test Cases](#test-cases)
- [Project Structure](#project-structure)
- [API Reference](#api-reference)
- [Environment Variables](#environment-variables)
- [Roadmap](#roadmap)

---

## Overview

EduChain is a web platform built on **Laravel 12** that allows Pakistani employers, recruiters, and HR departments to instantly verify the authenticity of any academic degree. Universities issue their degree records onto a blockchain layer. Recruiters verify degrees against that blockchain in real time. Students get a shareable verified digital credential.

The platform runs all verifications through a **4-layer check engine** and returns one of three verdicts:

| Verdict | Grade | Meaning |
|---|---|---|
| ✅ **REAL** | A+ · 100/100 | Degree confirmed on blockchain |
| ⚠️ **UNCONFIRMED** | B · 65/100 | University is HEC-accredited but not on EduChain yet |
| ❌ **FAKE** | F · 0/100 | University doesn't exist, year is impossible, or degree not on blockchain |

---

## The Problem

Pakistan faces a severe academic credential fraud crisis:

- Thousands of fake degree holders gain employment in government, healthcare, and engineering every year
- Manual verification requires calling university registrars — takes **days to weeks**
- HEC's existing attestation service is slow, paper-based, and inaccessible to most employers
- No standardized digital system exists for instant credential verification in Pakistan
- Multiple sitting MPs have been disqualified for fake degrees
- Diploma mills like **Axact** issued hundreds of thousands of fraudulent credentials

---

## The Solution

EduChain solves this with a two-sided platform:

1. **Universities** join EduChain and issue their degree records — each degree becomes a SHA-256 hash stored on the blockchain
2. **Recruiters** enter a candidate's degree details — the system checks 4 layers and returns a verdict in under 1 second
3. **Students** claim their verified degree and get a shareable public badge URL for LinkedIn and CVs

---

## Features

### 🔍 For Recruiters
- ⚡ Instant single degree verification (under 1 second)
- 📊 4-layer animated chain verification with real-time terminal log
- 📁 Bulk CSV verification — verify up to 500 candidates at once
- 📄 Download PDF verification certificate for every result
- 🔗 Shareable verification code (EDU-XXXXXX) — public result page
- 📜 Full verification history with search and filter
- 🔌 REST API access for HR software integration

### 🏛️ For Universities
- Issue individual degrees onto blockchain with one click
- Bulk CSV import at graduation — issue hundreds at once
- Dashboard showing total degrees issued and verification count
- Export issued degrees report

### 🎓 For Students
- Claim your own degree and get a verified digital credential
- Public shareable badge page at `/badge/{your-name-rollno}`
- QR code for CV/resume
- Share directly to LinkedIn and WhatsApp
- See how many times your badge has been viewed

### 👑 For Super Admin
- Approve or reject university registration requests
- Blacklist fraudulent institutions
- Revoke compromised degrees
- View all verifications platform-wide
- Fraud alert system — auto-detects fake universities being searched repeatedly
- Full activity log and audit trail
- Manage professional licenses (PMDC, PEC, Bar Council)

### 🌐 Public Features
- University directory — all 266 HEC-recognized universities with filters
- Live stats counter on landing page
- Public result page — anyone can verify using an EDU code
- Student badge pages — viewable without login

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12 (PHP 8.2+) |
| Database (Dev) | SQLite |
| Database (Prod) | MySQL 8.0+ |
| Frontend | Blade + Vanilla JS |
| UI Theme | The Fusion — Dark terminal + Chain blocks + Report card grades |
| Fonts | Space Mono · Syne · DM Sans (Google Fonts) |
| PDF | barryvdh/laravel-dompdf |
| QR Codes | simplesoftwareio/simple-qrcode |
| Email | Laravel Mail + Mailtrap |
| Cryptography | SHA-256 (PHP native) |
| Authentication | Laravel Auth (session-based) |

---

## User Roles

```
super_admin  →  /admin         Full platform control
university   →  /portal        Issue and manage degrees
student      →  /my-degree     Claim degree, get badge
recruiter    →  /verify        Verify candidate degrees
```

> **Note:** University accounts require Super Admin approval before they can access the portal. Recruiter and Student accounts are activated immediately.

---

## How Verification Works

Every degree verification runs through 4 sequential layers:

```
Layer 1 — HEC Database
  Is the university in Pakistan's HEC registry of 266+ institutions?
  FAIL → FAKE immediately (0/100)

Layer 2 — Temporal Check
  Was the university established before the graduation year?
  Is the graduation year in the future?
  FAIL → FAKE immediately (0/100)

Layer 3 — Degree Type
  Is the degree type consistent with the university's category?
  (e.g. a medical university cannot issue a Computer Science degree)
  FAIL → FAKE immediately (0/100)

Layer 4 — Blockchain
  Does the SHA-256 hash of the degree details match a record
  in the issued_degrees table?
  MATCH      → REAL (100/100)
  NO MATCH (university on EduChain) → FAKE (5/100)
  NO MATCH (university not on EduChain) → UNCONFIRMED (65/100)
```

### Hash Generation

The hash is generated the same way on both sides — issuance and verification:

```php
hash('sha256', strtolower(trim(implode('|', [
    $student_name,
    $roll_number,
    $degree_title,
    $university_name,
    $graduation_year,
]))));
```

Any change to any field produces a completely different hash — making forgery impossible.

---

## Installation

### Requirements
- PHP 8.2+
- Composer
- Node.js (optional)
- SQLite (included with PHP) or MySQL

### Step 1 — Clone & Install

```bash
git clone https://github.com/Rimcool/educhain.git
cd educhain
composer install
```

### Step 2 — Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### Step 3 — Install Packages

```bash
composer require barryvdh/laravel-dompdf
composer require simplesoftwareio/simple-qrcode
```

### Step 4 — Database & Seed

```bash
php artisan migrate:fresh
php artisan import:universities
php artisan db:seed --class=DemoDegreesSeeder
php artisan db:seed --class=AdminSeeder
```

### Step 5 — Run

```bash
php artisan serve
```

Open `http://localhost:8000`

---

## Database Setup

### Tables

| Table | Purpose |
|---|---|
| `users` | All accounts — recruiters, universities, students, admin |
| `universities` | 266 HEC-recognized universities |
| `issued_degrees` | Blockchain records — SHA-256 hashes of all issued degrees |
| `verifications` | Every verification performed — results, scores, EDU codes |
| `student_credentials` | Student claimed degrees and public badge data |
| `fraud_alerts` | Auto-tracks repeated searches for fake university names |
| `activity_logs` | Audit trail of all platform actions |
| `api_keys` | Third-party API access management |
| `professional_licenses` | PMDC, PEC, Bar Council license records |

### Import Universities

```bash
php artisan import:universities
# Imports all 266 HEC-recognized universities
# Automatically marks COMSATS and NUST as is_on_educhain = true for demo
```

---

## Test Credentials

After running the seeders, use these accounts to test:

| Role | Email | Password |
|---|---|---|
| Super Admin | admin@educhain.pk | Admin@123 |
| Register as Recruiter | any email | any password (8+ chars) |
| Register as University | any email | any password — needs admin approval |

---

## Test Cases

Use these on the `/verify` page to test all three results:

### ✅ REAL Result (A+ · 100/100)
```
Student Name:    Ahmed Ali Khan
University:      COMSATS University, Islamabad
Degree:          Bachelor of Science in Computer Science
Roll Number:     FA19-BCS-001
Year:            2023
```

### ✅ REAL Result #2
```
Student Name:    Sara Noor Ahmed
University:      COMSATS University, Islamabad
Degree:          Master of Business Administration
Roll Number:     SP20-MBA-045
Year:            2023
```

### ❌ FAKE — University doesn't exist
```
University:      Oxford International College Lahore
(any other fields)
```

### ❌ FAKE — Impossible graduation year
```
University:      COMSATS University, Islamabad
Year:            1995
(COMSATS was established in 2000 — impossible to graduate before it existed)
```

### ❌ FAKE — Wrong degree type
```
University:      Aga Khan University   (medical university)
Degree:          Bachelor of Science in Computer Science
(medical universities cannot issue CS degrees)
```

### ⚠️ UNCONFIRMED — Real university, not on EduChain
```
University:      University of Karachi
(any other fields)
(UoK is HEC-accredited but hasn't joined EduChain yet)
```

---

## Project Structure

```
educhain/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── VerifyController.php
│   │   │   ├── PortalController.php
│   │   │   ├── StudentController.php
│   │   │   ├── AdminController.php
│   │   │   ├── HistoryController.php
│   │   │   ├── PublicController.php
│   │   │   └── ApiController.php
│   │   └── Middleware/
│   │       ├── CheckRole.php
│   │       ├── CheckApproved.php
│   │       └── CheckApiKey.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── University.php
│   │   ├── IssuedDegree.php
│   │   ├── Verification.php
│   │   ├── StudentCredential.php
│   │   ├── FraudAlert.php
│   │   ├── ActivityLog.php
│   │   └── ApiKey.php
│   └── Services/
│       ├── DegreeChecker.php      ← Core 4-layer verification engine
│       ├── HashService.php        ← SHA-256 hash generation
│       ├── PdfService.php         ← PDF certificate generation
│       ├── QrService.php          ← QR code generation
│       ├── FraudDetector.php      ← Fraud alert tracking
│       └── ActivityLogger.php     ← Audit log helper
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DemoDegreesSeeder.php
│       └── AdminSeeder.php
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php          ← Main dark layout
│   │   └── admin.blade.php        ← Admin sidebar layout
│   ├── auth/
│   │   ├── login.blade.php
│   │   ├── register.blade.php
│   │   └── pending.blade.php
│   ├── verify/
│   │   ├── index.blade.php        ← The Fusion verify page
│   │   ├── result.blade.php       ← Public result page
│   │   └── certificate.blade.php  ← PDF template
│   ├── portal/
│   │   ├── index.blade.php
│   │   └── degrees.blade.php
│   ├── student/
│   │   ├── dashboard.blade.php
│   │   └── badge.blade.php        ← Public shareable badge
│   ├── admin/
│   │   ├── index.blade.php
│   │   ├── universities.blade.php
│   │   ├── users.blade.php
│   │   ├── verifications.blade.php
│   │   ├── pending.blade.php
│   │   └── fraud.blade.php
│   └── pages/
│       ├── landing.blade.php
│       └── universities.blade.php
└── routes/
    ├── web.php
    └── api.php
```

---

## API Reference

All API requests require a Bearer token in the Authorization header.

```
Authorization: Bearer YOUR_API_KEY
```

### POST /api/v1/verify

Verify a degree programmatically.

**Request Body:**
```json
{
  "student_name":    "Ahmed Ali Khan",
  "university_name": "COMSATS University, Islamabad",
  "degree_title":    "Bachelor of Science in Computer Science",
  "roll_number":     "FA19-BCS-001",
  "graduation_year": "2023"
}
```

**Response:**
```json
{
  "result": "real",
  "score":  100,
  "reason": "CONFIRMED: COMSATS University, Islamabad verified this degree was issued to Ahmed Ali Khan.",
  "layers": [
    { "pass": true,  "name": "HEC Database",   "msg": "University confirmed", "grade": "A+" },
    { "pass": true,  "name": "Temporal Check",  "msg": "Year 2023 valid",     "grade": "A+" },
    { "pass": true,  "name": "Degree Type",     "msg": "Degree type valid",   "grade": "A"  },
    { "pass": true,  "name": "Blockchain",      "msg": "Hash match confirmed","grade": "A+" }
  ],
  "code": "EDU-AB12CD"
}
```

### GET /api/v1/result/{code}

Retrieve a previous verification by EDU code.

### GET /api/v1/usage

Check your API key usage for the current month.

### GET /api/stats *(public)*

Returns live platform statistics.

```json
{
  "verifications_today":   47,
  "fakes_caught":          1203,
  "universities_on_chain": 12,
  "total_verifications":   8492
}
```

### GET /api/universities/search?q= *(public)*

Returns matching university names for autocomplete.

```
GET /api/universities/search?q=comsats
→ ["COMSATS University, Islamabad", "COMSATS University, Lahore", "COMSATS University, Wah"]
```

---

## Environment Variables

Add these to your `.env` file:

```env
APP_NAME=EduChain
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=sqlite
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=educhain
# DB_USERNAME=root
# DB_PASSWORD=

# Email (use Mailtrap for local testing)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS=noreply@educhain.pk
MAIL_FROM_NAME=EduChain
```

---

## Roadmap

### Version 1.0 (Current)
- [x] Core 4-layer verification engine
- [x] 266 HEC universities database
- [x] University portal — issue & bulk import degrees
- [x] Recruiter verify page — single & bulk CSV
- [x] Super admin panel — approve, blacklist, revoke
- [x] Student digital credential & public badge
- [x] PDF certificate download
- [x] QR code on every result
- [x] REST API with API keys
- [x] Fraud alert system
- [x] Activity audit log
- [x] Verification history

### Version 2.0 (Planned)
- [ ] WhatsApp bot — send degree details via WhatsApp, get result in 30 seconds
- [ ] React Native mobile app — scan physical degree with camera
- [ ] HEC attestation number cross-reference
- [ ] Polygon blockchain — migrate to real smart contracts
- [ ] Professional license verification (PMDC, PEC, Bar Council)
- [ ] Employer analytics dashboard — fraud rate reports
- [ ] JazzCash & Easypaisa subscription payments
- [ ] NADRA CNIC integration
- [ ] LinkedIn "Verify with EduChain" button

---

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m 'Add your feature'`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## License

This project is licensed under the MIT License.

---

## Contact

**EduChain Team**
📧 admin@educhain.pk
🌐 https://educhain.pk
📍 Islamabad, Pakistan

---

<div align="center">

**⛓️ EduChain — Kill fake degrees. Now.**

*Built for Pakistan · Powered by blockchain · Free forever*

</div>
