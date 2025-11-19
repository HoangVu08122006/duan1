<?php

function homeIndex() {
    $homeUrl = 'index.php?act=/';

    // Nếu muốn dùng trong view
    require __DIR__ . '/../views/home.php';
}
