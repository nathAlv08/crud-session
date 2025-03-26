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
