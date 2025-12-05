<?php
function getAdminByUsername($username) {
    $conn = connectDB();
    $sql = "SELECT * FROM admin WHERE name_admin = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    return $stmt->fetch();
}
