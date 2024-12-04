Mencegah SQL Injection:

Menggunakan intval() untuk memastikan $book_id hanya berisi angka.
Sangat disarankan untuk menggunakan prepared statements dengan mysqli atau PDO.
Menggabungkan Data Buku dan Kategori:

Query menggunakan LEFT JOIN untuk menggabungkan tabel books dan categories berdasarkan category_id.
Memastikan Hasil Query Valid:

Mengecek apakah $result memiliki data dengan mysqli_num_rows() > 0.
Jika tidak ada data, tampilkan pesan kesalahan seperti "Buku tidak ditemukan."
Efisiensi Query:

Mengurangi redundansi dengan hanya menjalankan satu query untuk mendapatkan semua data yang diperlukan.