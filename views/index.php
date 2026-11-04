<?php require __DIR__ . '/header.php'; ?>

<main class="container">

    <?php if (!empty($_SESSION['flash_message'])): ?>
        <div class="alert alert-success" id="flash-message">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
        <script>
            const flashEl = document.getElementById('flash-message');
            setTimeout(function () {
                flashEl.classList.add('fade-out');
                setTimeout(function () {
                    flashEl.remove();
                }, 600);
            }, 2500);
        </script>
    <?php endif; ?>

    <div class="toolbar">
        <h2>Faculty List</h2>
        <a href="index.php?action=create" class="btn btn-primary">+ Add Faculty</a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($facultyList)): ?>
                    <tr>
                        <td colspan="8" class="empty-row">No faculty records yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($facultyList as $f): ?>
                        <tr>
                            <td><?= htmlspecialchars($f['faculty_id']) ?></td>
                            <td>
                                <?= htmlspecialchars($f['first_name']) ?>
                                <?= htmlspecialchars($f['middle_name'] ? $f['middle_name'] . ' ' : '') ?>
                                <?= htmlspecialchars($f['last_name']) ?>
                            </td>
                            <td><?= htmlspecialchars($f['age']) ?></td>
                            <td><?= htmlspecialchars($f['gender']) ?></td>
                            <td><?= htmlspecialchars($f['address']) ?></td>
                            <td><?= htmlspecialchars($f['position']) ?></td>
                            <td>&#8369; <?= number_format($f['salary'], 2) ?></td>
                            <td class="actions">
                                <a href="index.php?action=edit&id=<?= $f['faculty_id'] ?>" class="btn btn-small btn-edit">Edit</a>
                                <a href="index.php?action=delete&id=<?= $f['faculty_id'] ?>"
                                   class="btn btn-small btn-delete"
                                   onclick="return confirm('Delete this faculty record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require __DIR__ . '/footer.php'; ?>
