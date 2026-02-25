# 📋 Dokumentasi Use Case - Sistem Absensi

Dokumentasi lengkap use case untuk Sistem Manajemen Absensi PT. Multi Sarana Jaya

## 📁 Struktur Dokumentasi

```
public/docs/
├── usecase-index.html          # Halaman utama/index dokumentasi
├── usecase-transaksi.html      # Use case untuk modul Transaksi
├── usecase-report.html         # Use case untuk modul Report
└── README.md                   # File ini
```

## 🎯 Ringkasan Konten

### 1. Use Case Transaksi (5 Use Cases)

Dokumentasi ini mencakup semua proses transaksi dalam sistem absensi:

- **UCT1 - Pull Data Finger**: Proses mengambil data absensi dari mesin fingerprint
- **UCT2 - Input Manual Absensi**: Input/edit data absensi secara manual
- **UCT3 - Approval Tukar Jadwal**: Menyetujui/menolak pertukaran jadwal shift
- **UCT4 - Cek Data Missing**: Identifikasi dan tangani data absensi yang hilang
- **UCT5 - Kirim Surat Peringatan**: Generate dan kirim SP ke karyawan

### 2. Use Case Report (4 Use Cases)

Dokumentasi ini mencakup semua fitur reporting dan analisa:

- **UCR1 - Generate Report Finger**: Laporan data raw dari mesin fingerprint
- **UCR2 - Generate Report Kehadiran**: Rekap kehadiran dengan statistik lengkap
- **UCR3 - Generate Report Keterlambatan**: Analisa keterlambatan dan tindakan
- **UCR4 - Export Report**: Export report ke format Excel atau PDF

## 👥 Aktor dalam Sistem

### Admin
Bertugas mengelola:
- Data master (shift, karyawan, dll)
- Transaksi absensi harian
- Generate report untuk monitoring
- Input manual dan koreksi data

### HRD
Memiliki akses penuh untuk:
- Monitoring kehadiran menyeluruh
- Approval permintaan karyawan
- Membuat dan mengirim surat peringatan
- Generate report untuk evaluasi kebijakan
- Analisa data untuk decision making

## 📊 Statistik Dokumentasi

- **Total Use Cases**: 9
- **Kategori Utama**: 2 (Transaksi & Report)
- **Aktor Utama**: 2 (Admin & HRD)
- **Halaman Dokumentasi**: 3 HTML files

## 🚀 Cara Menggunakan

1. **Buka file index**: 
   - Double-click `usecase-index.html` di browser
   - Atau akses via: `http://localhost/docs/usecase-index.html`

2. **Navigasi dokumentasi**:
   - Dari index, klik tombol "Lihat Detail Transaksi" atau "Lihat Detail Report"
   - Setiap halaman berisi diagram dan deskripsi lengkap use case

3. **Baca setiap use case**:
   Setiap use case mencakup:
   - ID dan nama use case
   - Tujuan dan manfaat
   - Aktor yang terlibat (primer & sekunder)
   - Precondition & Postcondition
   - Skenario utama (main flow)
   - Skenario alternatif (alternative/exception flow)

## 📖 Format Dokumentasi

Setiap use case didokumentasikan dalam format tabel standar yang mencakup:

| Elemen | Deskripsi |
|--------|-----------|
| **ID Use Case** | Identifier unik (UCT1, UCR1, dst) |
| **Nama Use Case** | Nama deskriptif fitur |
| **Tujuan** | Manfaat dan value untuk user |
| **Aktor Primer** | User utama yang menggunakan |
| **Aktor Sekunder** | Sistem/pihak lain yang terlibat |
| **Deskripsi Singkat** | Overview proses |
| **Precondition** | Syarat sebelum use case dapat dijalankan |
| **Postcondition** | Status setelah use case selesai |
| **Skenario Utama** | Langkah-langkah normal (happy path) |
| **Skenario Alternatif** | Langkah-langkah untuk kondisi khusus/error |

## 🎨 Fitur Dokumentasi

- ✅ **Diagram Use Case Visual**: Representasi grafis interaksi aktor dan use case
- ✅ **Deskripsi Detail**: Penjelasan lengkap setiap use case
- ✅ **Responsive Design**: Dapat dibuka di desktop, tablet, atau mobile
- ✅ **Color Coding**: Highlight untuk poin-poin penting
- ✅ **Easy Navigation**: Link antar halaman yang intuitif
- ✅ **Print-Friendly**: Format yang rapi untuk di-print ke PDF

## 🔗 Quick Links

- [Index/Halaman Utama](usecase-index.html)
- [Use Case Transaksi](usecase-transaksi.html)
- [Use Case Report](usecase-report.html)

## 📝 Catatan Pengembangan

Dokumentasi ini dibuat berdasarkan:
- Prototype HTML yang sudah ada di `/public/prototype/`
- Controller dan model di Laravel
- Best practices use case documentation
- Format mirip dengan contoh dokumentasi beasiswa

## 🔄 Update History

| Tanggal | Versi | Perubahan |
|---------|-------|-----------|
| 2026-02-24 | 1.0 | Initial documentation creation |

## 👨‍💻 Penggunaan untuk Developer

Dokumentasi ini dapat digunakan untuk:
- **Requirements**: Memahami requirement setiap fitur
- **Testing**: Membuat test case berdasarkan skenario
- **Implementation**: Panduan untuk implementasi fitur
- **Training**: Material untuk training user baru
- **Maintenance**: Reference saat maintenance atau bug fixing

## 📧 Kontak

Untuk pertanyaan atau saran terkait dokumentasi ini, hubungi:
- **IT Department**: PT. Multi Saarna Jaya
- **Email**: it@multisaranajaya.com

---

**© 2026 PT. Multi Sarana Jaya**  
Sistem Manajemen Absensi