<?php require __DIR__ . '/header.php'; ?>

<main class="container">
    <div class="toolbar">
        <h2>Edit Faculty</h2>
        <a href="index.php?action=index" class="btn btn-secondary">&larr; Back to List</a>
    </div>

    <?php if (!empty($this->errors['general'])): ?>
        <div class="alert alert-error"><?= $this->errors['general'] ?></div>
    <?php endif; ?>

    <form action="index.php?action=edit&id=<?= htmlspecialchars($record['faculty_id']) ?>" method="POST" class="faculty-form">
        <?php $errors = $this->errors ?? []; require __DIR__ . '/form_fields.php'; ?>
        <button type="submit" class="btn btn-primary">Update Faculty</button>
    </form>
</main>

<?php require __DIR__ . '/footer.php'; ?>
