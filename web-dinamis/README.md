#  OptiLens — Web Dinamis Toko Optik

> UAS Administrasi Server 
> Nama: Merin Kharista  
> NIM: 2388010050  


---

##  Akses Aplikasi

| Aplikasi | URL |
|---|---|
| Web Statis | 47.129.203.167 |
| Web Dinamis (Toko Optik) | http://47.129.203.167:3000 |

---

##  Docker Compose & Orkestrasi

File `docker-compose.yml` mengorkestrasi 3 container:

| Container | Image | Port |
|---|---|---|
| `container-statis` | `merinkharista/uas_2388010050_merin:latest` | 80:80 |
| `container-dinamis` | `merinkharista/uas-web-dinamis:latest` | 3000:80 |
| `db-webdinamis` | `mariadb:lts` | internal |



## 🗄️ Database

- **DBMS:** MariaDB LTS
- **Nama database:** `db_uas`
- **Seeding otomatis:** file `db_uas.sql` di-mount ke `/docker-entrypoint-initdb.d/` sehingga database ter-import otomatis saat container pertama kali dijalankan
