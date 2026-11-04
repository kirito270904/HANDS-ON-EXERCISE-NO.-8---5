<?php require __DIR__ . '/header.php'; ?>

<main class="container">
    <div class="toolbar">
        <h2>Add Faculty</h2>
        <a href="index.php?action=index" class="btn btn-secondary">&larr; Back to List</a>
    </div>

    <?php if (!empty($this->errors['general'])): ?>
        <div class="alert alert-error"><?= $this->errors['general'] ?></div>
    <?php endif; ?>

    <form action="index.php?action=create" method="POST" class="faculty-form">
        <?php $record = $formData ?? []; $errors = $this->errors ?? []; require __DIR__ . '/form_fields.php'; ?>
        <button type="submit" class="btn btn-primary">Save Faculty</button>
    </form>
</main>

<?php require __DIR__ . '/footer.php'; ?>
