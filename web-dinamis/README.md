# 👓 OptiLens — Web Dinamis Toko Optik

> UAS Administrasi Server (Cloud Computing II)  
> Nama: Merin Kharista  
> NIM: 2388010050  
> Dosen: Mohamad Firdaus, M.Kom.

---

## 🌐 Akses Aplikasi

| Aplikasi | URL |
|---|---|
| Web Statis | http://\<AWS_IP\>:80 |
| Web Dinamis (Toko Optik) | http://\<AWS_IP\>:3000 |

> Ganti `<AWS_IP>` dengan IP publik EC2 instance kamu.

---

## 🏗️ Arsitektur Sistem

```
GitHub Repository
      │
      │  git push → trigger GitHub Actions
      ▼
┌─────────────────────────────┐
│      GitHub Actions CI/CD   │
│  1. Build Docker Image      │
│  2. Push ke Docker Hub      │
│  3. SCP compose + SQL       │
│  4. SSH → docker compose up │
└─────────────┬───────────────┘
              │
              ▼
┌─────────────────────────────────────────────┐
│              AWS EC2 Instance               │
│                                             │
│  ┌─────────────┐    ┌────────────────────┐  │
│  │  Port 80    │    │     Port 3000      │  │
│  │  Web Statis │    │   Web Dinamis PHP  │  │
│  │  (Apache)   │    │   (PHP + Apache)   │  │
│  └─────────────┘    └────────┬───────────┘  │
│                              │ depends_on   │
│                    ┌─────────▼───────────┐  │
│                    │   MariaDB Database  │  │
│                    │   dbuasmerin        │  │
│                    │   (internal only)   │  │
│                    └─────────────────────┘  │
└─────────────────────────────────────────────┘
```

---

## 🐳 Docker Compose & Orkestrasi

File `docker-compose.yml` mengorkestrasi 3 container:

| Container | Image | Port |
|---|---|---|
| `container-statis` | `merinkharista/uas_2388010050_merin:latest` | 80:80 |
| `container-dinamis` | `merinkharista/uas-web-dinamis:latest` | 3000:80 |
| `db-webdinamis` | `mariadb:lts` | internal |

**Fitur konfigurasi:**
- ✅ Kredensial database diamankan via **Environment Variables**
- ✅ Database menggunakan **DNS internal** (`DB_HOST: db-webdinamis`)
- ✅ `depends_on` memastikan MariaDB siap sebelum container PHP menyala
- ✅ Volume persisten `db_data` agar data tidak hilang saat container restart
- ✅ Database ter-seed otomatis dari `toko_optik.sql` via `/docker-entrypoint-initdb.d/`

---

## ⚙️ CI/CD Pipeline (GitHub Actions)

File: `.github/workflows/deploy-dinamis.yml`

### Alur Pipeline

```
git push → paths filter (web-dinamis/**)
      │
      ▼
Job 1: build-and-deploy-web-dinamis
  └── Checkout code
  └── Login Docker Hub
  └── Build image dari ./web-dinamis
  └── Push → merinkharista/uas-web-dinamis:latest
      │
      ▼
Job 2: deploy-to-ec2
  └── Stop container lama (docker rm -f)
  └── SCP docker-compose.yml + toko_optik.sql → EC2
  └── SSH → docker compose pull + up -d
```

### Paths Filter
Pipeline hanya berjalan saat ada perubahan di folder `web-dinamis/**`, sehingga pipeline web statis dan dinamis **terisolasi** dan tidak memboroskan runner.

---

## 🗄️ Database

- **DBMS:** MariaDB LTS
- **Nama database:** `dbuasmerin`
- **Seeding otomatis:** file `toko_optik.sql` di-mount ke `/docker-entrypoint-initdb.d/` sehingga database ter-import otomatis saat container pertama kali dijalankan

### Tabel Utama

| Tabel | Keterangan |
|---|---|
| `admin` | Data login admin |
| `users` | Data pelanggan |
| `produk` | Data produk optik |
| `kategori` | Kategori produk |
| `merek` | Merek / brand produk |
| `varian_produk` | Varian warna & ukuran |
| `pesanan` | Data transaksi |
| `detail_pesanan` | Item per pesanan |
| `keranjang` | Keranjang belanja |

---

## 🔐 Environment Variables

| Variable | Keterangan |
|---|---|
| `DB_HOST` | Hostname database (DNS internal Docker) |
| `DB_USER` | Username database |
| `DB_PASS` | Password database |
| `DB_NAME` | Nama database |

### GitHub Secrets

| Secret | Keterangan |
|---|---|
| `DOCKERHUB_USERNAME` | Username Docker Hub |
| `DOCKERHUB_TOKEN` | Access token Docker Hub |
| `AWS_HOST` | IP publik EC2 |
| `AWS_USERNAME` | Username SSH EC2 (ubuntu) |
| `AWS_PRIVATE_KEY` | Private key SSH (.pem) |

---

## 🚀 Zero-Touch Deployment

Cara kerja auto-update saat kode diubah:

1. Edit kode di lokal (misal ubah teks di `dashboard.php`)
2. `git add . && git commit -m "update tampilan"`
3. `git push origin main`
4. GitHub Actions otomatis **build image baru → push Docker Hub → deploy ke EC2**
5. Perubahan langsung terlihat di browser tanpa perlu SSH manual ke server

---

## 📁 Struktur Folder

```
web-dinamis/
├── .github/
│   └── workflows/
│       └── deploy-dinamis.yml
├── toko-optik/
│   ├── admin/
│   │   ├── assets/style.css
│   │   ├── dashboard.php
│   │   ├── login.php
│   │   ├── kategori/
│   │   ├── merek/
│   │   ├── produk/
│   │   └── pesanan/
│   ├── config/
│   │   ├── database.php
│   │   └── session.php
│   ├── pages/
│   ├── assets/
│   ├── Dockerfile
│   ├── docker-compose.yml
│   └── toko_optik.sql
└── README.md
```

---

## 📸 Screenshots

> *Tambahkan screenshot berikut setelah deploy berhasil:*

| Bukti | Keterangan |
|---|---|
| ![Pipeline]() | GitHub Actions — centang hijau ✅ |
| ![Port Mapping]() | `docker ps` menampilkan port mapping |
| ![Web Statis]() | Web statis berjalan di port 80 |
| ![Web Dinamis]() | Web dinamis berjalan di port 3000 |
| ![Dashboard Admin]() | Halaman dashboard admin |
| ![Zero Downtime]() | Container tetap running saat deploy ulang |

