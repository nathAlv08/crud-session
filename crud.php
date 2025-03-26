<?php
session_start();

if (!isset($_SESSION['alltugas'])) {
    $_SESSION['alltugas'] = [];
}

if (isset($_POST['tambah'])) {
    $tugas = $_POST['tugas'];
    $waktu = $_POST['waktu'];
    if (!empty($tugas) && !empty($waktu)) {
        $_SESSION['alltugas'][] = ['tugas' => $tugas, 'waktu' => $waktu];
    }
    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    exit;
}


$selectedTugas = null;
if (isset($_GET['lihat'])) {
    $index = (int)$_GET['lihat'];
    if (isset($_SESSION['alltugas'][$index])) {
        $selectedTugas = $_SESSION['alltugas'][$index];
    } else {
        $selectedTugas = ['tugas' => 'Tugas tidak ditemukan', 'waktu' => 'N/A'];
    }
}

if (isset($_GET['hapus'])) {
    $index = (int)$_GET['hapus'];
    if (isset($_SESSION['alltugas'][$index])) {
        unset($_SESSION['alltugas'][$index]);
        $_SESSION['alltugas'] = array_values($_SESSION['alltugas']); 
    }
    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    exit;
}

if (isset($_POST['edit'])) {
    $index = (int)$_POST['index'];
    $newTugas = trim($_POST['tugas']);
    $newWaktu = trim($_POST['waktu']);
    if (isset($_SESSION['alltugas'][$index])) {
        if (!empty($newTugas) && !empty($newWaktu)) {
            $_SESSION['alltugas'][$index] = ['tugas' => $newTugas, 'waktu' => $newWaktu];
            header('Location: ' . $_SERVER['SCRIPT_NAME'] . '?lihat=' . $index);
            exit;
        } else {
            echo "<script>alert('Tugas dan waktu tidak boleh kosong!');</script>";
        }
    }
}

?>



<!DOCTYPE html>
<html>
<head>
    <title>Manajemen List Tugas</title>
</head>
<body>
    <h1>Manajemen List Tugas</h1>
    
    <form method="POST">
        <input type="text" name="tugas" placeholder="Masukkan tugas" required>
        <input type="text" name="waktu" placeholder="Waktu yang diperlukan" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>
    
    <h2>Daftar Tugas</h2>
    <ol>
        <?php foreach ($_SESSION['alltugas'] as $index => $tugas): ?>
            <li>
                <?= htmlspecialchars($tugas['tugas']) ?> - <?= htmlspecialchars($tugas['time']) ?>
                <a href="?lihat=<?= $index ?>">[Lihat]</a>
                <a href="?hapus=<?= $index ?>" onclick="return confirm('Hapus tugas ini?');">[Hapus]</a>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="index" value="<?= $index ?>">
                    <input type="text" name="tugas" value="<?= htmlspecialchars($tugas['tugas']) ?>">
                    <input type="text" name="waktu" value="<?= htmlspecialchars($tugas['waktu']) ?>">
                    <button type="submit" name="edit">Edit</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ol>
    
    <?php if ($selectedTugas): ?>
        <h2>Detail Tugas</h2>
        <p><strong>Tugas:</strong> <?= htmlspecialchars($selectedTugas['tugas']) ?></p>
        <p><strong>Waktu yang diperlukan:</strong> <?= htmlspecialchars($selectedTugas['waktu']) ?></p>
    <?php endif; ?>
</body>
</html>
