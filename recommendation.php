<?php
include 'db.php'; // Pastikan file ini sesuai dengan nama dan lokasinya

// Ambil data dari POST
$skin_color = $_POST['skin_color'];
$body_shape = $_POST['body_shape'];
$height = $_POST['height'];
$weight = $_POST['weight'];

// Query untuk memilih rekomendasi berdasarkan kombinasi warna kulit dan bentuk tubuh
$query = "SELECT recommendation, image_url FROM recommendations WHERE skin_color = ? AND body_shape = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $skin_color, $body_shape);
$stmt->execute();
$result = $stmt->get_result();

// Ambil data hasil query
$data = $result->fetch_assoc();

if ($data) {
    echo json_encode($data); // Mengembalikan rekomendasi dalam format JSON
} else {
    echo json_encode(['error' => 'Tidak ada rekomendasi yang ditemukan.']);
}
?>
