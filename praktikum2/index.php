<?php
// =================================================================
// PRAKTIKUM 1: APLIKASI PENDAFTARAN EVENT - KODE DIPERBAIKI
// =================================================================

// KONSEP: CONSTANT
define('NAMA_EVENT', 'Belajar PHP 2025');
define('FILE_PENDAFTARAN', 'pendaftar.txt');

// KONSEP: GLOBAL VARIABLE
// Variabel ini akan digunakan untuk menampung pesan status (sukses atau kegagalan registrasi)
$status_message = null; 
$error_messages = [];

// KONSEP: FUNGSI & REGEX
// Fungsi untuk memvalidasi format email menggunakan Regular Expression.
function validateEmail($email) {
    // Pola regex untuk email
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email);
}

// Fungsi untuk memvalidasi format tanggal DD-MM-YYYY menggunakan Regular Expression.
function validateDate($date) {
    // Pola regex untuk tanggal DD-MM-YYYY
    $pattern = '/^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-(19[0-9]{2}|20[0-9]{2})$/';
    return preg_match($pattern, $date);
}

// KONSEP: FORM (POST) HANDLING
// Cek apakah request yang datang adalah POST (artinya form telah disubmit).
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // KONSEP: VARIABLE
    // Mengambil data dari form dan membersihkannya dari tag HTML berbahaya.
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);

    // Validasi input
    if (empty($nama) || empty($email) || empty($tanggal_lahir)) {
        $error_messages[] = "Semua field wajib diisi.";
    }
    if (!validateEmail($email)) {
        $error_messages[] = "Format email tidak valid.";
    }
    if (!validateDate($tanggal_lahir)) {
        $error_messages[] = "Format tanggal lahir harus DD-MM-YYYY.";
    }

    // Jika tidak ada error, simpan data
    if (empty($error_messages)) {
        // KONSEP: SIMPAN KE FILE TXT
        // Format data yang akan disimpan (dipisahkan oleh semicolon)
        $data_pendaftar = "{$nama};{$email};{$tanggal_lahir}\n";

        // Menyimpan data ke file pendaftar.txt.
        file_put_contents(FILE_PENDAFTARAN, $data_pendaftar, FILE_APPEND);

        // Mengatur pesan sukses
        $status_message = "Terima kasih, {$nama}! Pendaftaran Anda untuk event " . NAMA_EVENT . " berhasil.";
    }
}

// =================================================================
// BAGIAN LOGIKA UNTUK MEMBUAT BARIS TABEL PENDAFTAR
// Logika ini dipisahkan dari variabel global di atas agar dieksekusi dengan benar.
// =================================================================

// Variabel ini akan menampung seluruh baris (<tr>) untuk tabel pendaftar.
$table_rows_html = '';

// Cek apakah file pendaftar.txt ada
if (file_exists(FILE_PENDAFTARAN)) {
    // Membaca isi file baris per baris ke dalam array
    $pendaftar = file(FILE_PENDAFTARAN, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Melakukan loop untuk setiap baris data
    foreach ($pendaftar as $data) {
        // Memecah baris data berdasarkan pemisah semicolon
        @list($nama, $email, $tanggal_lahir) = explode(';', $data); // Menggunakan @ untuk menekan error jika baris rusak
        
        // Memastikan semua variabel terisi sebelum mencetak
        if (isset($nama, $email, $tanggal_lahir)) {
            $table_rows_html .= "<tr>";
            $table_rows_html .= "<td>" . htmlspecialchars(trim($nama)) . "</td>";
            $table_rows_html .= "<td>" . htmlspecialchars(trim($email)) . "</td>";
            $table_rows_html .= "<td>" . htmlspecialchars(trim($tanggal_lahir)) . "</td>";
            $table_rows_html .= "</tr>";
        }
    }
}

// Jika tidak ada baris yang dihasilkan, tampilkan pesan kosong
if (empty($table_rows_html)) {
    $table_rows_html = "<tr><td colspan='3'>Belum ada pendaftar.</td></tr>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Event Digital</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 8px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    
    <?php if (!empty($status_message)): ?>
    <p class="success"><?php echo $status_message; ?></p>
    <?php endif; ?>

    <?php if (!empty($error_messages)): ?>
    <div class="error">
        <strong>Terjadi kesalahan:</strong>
        <ul>
            <?php foreach ($error_messages as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <h1>Form Pendaftaran Event "<?php echo NAMA_EVENT; ?>"</h1>
    <p>Silakan isi data diri Anda untuk mendaftar pada event kami.</p>

    <form action="" method="POST"> <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" value="<?php echo isset($nama) ? htmlspecialchars($nama) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Alamat Email:</label>
            <input type="text" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir (DD-MM-YYYY):</label>
            <input type="text" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo isset($tanggal_lahir) ? htmlspecialchars($tanggal_lahir) : ''; ?>" required>
        </div>
        <button type="submit">Daftar Sekarang</button>
    </form>

    <hr>

    <h2>Daftar Peserta yang Sudah Mendaftar</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $table_rows_html; ?>
        </tbody>
    </table>

</body>
</html>