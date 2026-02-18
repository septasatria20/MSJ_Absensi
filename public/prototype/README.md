# MSJ ABSENSI - HTML Prototype untuk Figma

Prototype HTML lengkap sistem MSJ ABSENSI yang siap diimport ke Figma menggunakan plugin **html.to.design**.

## 📁 File Structure

```
public/prototype/
├── index.html                          # Navigation Hub (START HERE!)
├── 01-login.html                       # Login Page
├── 02-dashboard.html                   # Dashboard HR (8 cards, charts, calendar)
├── 03-master-shift.html                # Master Shift (with time picker)
├── 09-master-kontak-karyawan.html      # Master Kontak (WhatsApp integration)
├── 12-transaksi-data-missing.html      # Data Missing (Key Feature!)
└── 13-report-finger.html               # Report Finger
```

## 🚀 Cara Menggunakan

### Opsi 1: Import ke Figma (Recommended)

1. **Buka halaman prototype di browser**
   ```
   http://localhost/trial/public/prototype/index.html
   ```

2. **Pilih screen yang ingin diimport**
   - Klik link screen (misal: Dashboard HR)
   - Browser akan membuka halaman prototype

3. **Copy HTML Source**
   - Tekan `Ctrl + U` (View Page Source)
   - Tekan `Ctrl + A` (Select All)
   - Tekan `Ctrl + C` (Copy)

4. **Import ke Figma**
   - Buka Figma
   - Install plugin: [html.to.design](https://www.figma.com/community/plugin/1159123024924461424/html.to.design)
   - Run plugin → Paste HTML code
   - Klik "Import"
   - Screen akan ter-convert menjadi Figma layers!

5. **Edit di Figma**
   - Semua element sudah jadi layers yang editable
   - Colors, typography, spacing sudah sesuai design system
   - Tinggal adjust dan customize sesuai kebutuhan

### Opsi 2: Screenshot untuk Reference

1. Buka screen di browser
2. Gunakan browser screenshot (F12 → Ctrl+Shift+P → "Screenshot")
3. Import gambar ke Figma sebagai reference
4. Trace manual dengan Figma tools

## 🎨 Design System

### Colors
- **Primary**: `#0A9294` (Hijau Sage)
- **Primary Dark**: `#067678`
- **Success**: `#2dce89`
- **Warning**: `#fb6340`
- **Danger**: `#f5365c`
- **Info**: `#11cdef`

### Typography
- **Font Family**: Open Sans, Segoe UI, sans-serif
- **Heading 1**: 28px, Bold
- **Heading 2**: 20px, Bold
- **Body**: 14px, Regular
- **Small**: 12px, Regular

### Spacing
- **Card Padding**: 25px
- **Button Padding**: 10px 20px
- **Gap**: 15-20px
- **Border Radius**: 6px (buttons), 10px (cards)

### Components
- **Buttons**: Rounded 6px, gradient background
- **Cards**: White, rounded 10px, shadow 0 2px 10px rgba(0,0,0,0.08)
- **Tables**: Alternating row hover, bordered cells
- **Badges**: Rounded 20px, colored backgrounds
- **Forms**: Input border 1px, focus state dengan border color primary

## 📱 Key Screens

### 1. Dashboard HR ⭐
**File**: `02-dashboard.html`

Features:
- 8 metric cards (Total Karyawan, Hadir, Izin/Cuti, Mangkir, dll)
- Bar Chart (Kehadiran Bulanan)
- Pie Chart (Status Hari Ini)
- Kalender Cuti Bersama (interactive)
- Tabel Kehadiran per Departemen

### 2. Data Missing ⭐⭐⭐ (MOST IMPORTANT!)
**File**: `12-transaksi-data-missing.html`

Features:
- Alert box untuk deadline 24 jam
- Mini stats (Total Anomali, Mangkir, Terlambat, Pulang Cepat)
- Filter: Jenis Anomali, Tanggal, NIK/Nama
- Table dengan kolom:
  - Jenis Anomali (badge: Mangkir/Terlambat/Pulang Cepat)
  - Jam Seharusnya vs Aktual
  - Status Hubungi
  - **Tombol Hubungi WhatsApp** (hijau #25D366)
- Section Riwayat (sudah dilaporkan)

### 3. Master Kontak Karyawan
**File**: `09-master-kontak-karyawan.html`

Features:
- Table: NIK, Nama, No. Telp, No. WhatsApp, Email
- Button "Hubungi WA" per row
- Form modal dengan fields:
  - NIK, Nama, No. Telp, No. WA, Email
  - Kontak Darurat & Nama Kontak Darurat

### 4. Report Finger
**File**: `13-report-finger.html`

Features:
- Filter section (Tanggal, Departemen, Shift, Status)
- Summary cards (Total Hadir, Izin, Alpha, %, dll)
- Export buttons (Excel, PDF)
- Detailed table dengan status badges
- Pagination

## 🔧 Customization di Figma

Setelah import, Anda bisa:

1. **Convert ke Components**
   - Select button → Create Component
   - Select card → Create Component
   - Reuse components untuk consistency

2. **Setup Auto Layout**
   - Select container → Add Auto Layout (Shift+A)
   - Set spacing dan padding

3. **Create Variants**
   - Button variants: Primary, Secondary, Success, Danger
   - Badge variants: Success, Warning, Danger, Info

4. **Setup Styles**
   - Text Styles untuk typography consistency
   - Color Styles untuk color palette
   - Effect Styles untuk shadows

5. **Add Interactions**
   - Button hover states
   - Modal open/close
   - Tab switching
   - Form validation states

## 📝 Notes

- Semua HTML sudah optimized untuk plugin html.to.design
- Inline CSS untuk compatibility maksimal
- Semantic HTML structure untuk clean conversion
- Dummy data sudah realistic untuk visualisasi
- Time picker fields sudah menggunakan input type="time"
- WhatsApp button menggunakan color #25D366 (official WA green)

## 🎯 Next Steps (di Figma)

1. Import semua screens ke Figma
2. Organize dalam pages/frames
3. Create component library
4. Setup prototype flows
5. Add interactive transitions
6. Present to stakeholders!

## 📞 Support

Jika ada masalah saat import:
- Pastikan copy ENTIRE HTML (termasuk style tags)
- Check plugin html.to.design sudah installed
- Try import satu section dulu (misal: hanya card, lalu table)
- Alternatif: Screenshot → manual trace di Figma

---

**Created for**: MSJ ABSENSI System  
**Design System**: MSJ Framework (Sage Green #0A9294)  
**Compatible with**: Figma plugin html.to.design  
**Date**: 11 Februari 2026
