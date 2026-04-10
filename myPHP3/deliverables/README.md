# Deliverables

- N1: CSDL.sql (backup CSDL MySQL)
- N2: Folder source code (chính thư mục project này)
- N3: BaoCao.doc (báo cáo)

## Tạo file CSDL.sql

```powershell
C:\xampp\mysql\bin\mysqldump.exe -u root php3_lab2 > deliverables\CSDL.sql
```

## Đóng gói ZIP

Ví dụ đặt tên: `PHP3_PS12345_Thanh_Assignment.zip`

```powershell
$zipName = "PHP3_PS12345_Ten_Assignment.zip"
Compress-Archive -Path ".\deliverables\CSDL.sql", ".\deliverables\BaoCao.doc", ".\" -DestinationPath ".\$zipName" -Force
```
