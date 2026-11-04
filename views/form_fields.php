<?php
$record = $record ?? [];
$errors = $errors ?? [];
function old($record, $field) {
    return htmlspecialchars($record[$field] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<div class="form-row">
    <label for="first_name">First Name *</label>
    <input type="text" id="first_name" name="first_name" value="<?= old($record, 'first_name') ?>" required>
    <?php if (!empty($errors['first_name'])): ?><span class="field-error"><?= $errors['first_name'] ?></span><?php endif; ?>
</div>

<div class="form-row">
    <label for="middle_name">Middle Name</label>
    <input type="text" id="middle_name" name="middle_name" value="<?= old($record, 'middle_name') ?>">
</div>

<div class="form-row">
    <label for="last_name">Last Name *</label>
    <input type="text" id="last_name" name="last_name" value="<?= old($record, 'last_name') ?>" required>
    <?php if (!empty($errors['last_name'])): ?><span class="field-error"><?= $errors['last_name'] ?></span><?php endif; ?>
</div>

<div class="form-row">
    <label for="age">Age *</label>
    <input type="number" id="age" name="age" min="18" max="80" value="<?= old($record, 'age') ?>" required>
    <?php if (!empty($errors['age'])): ?><span class="field-error"><?= $errors['age'] ?></span><?php endif; ?>
</div>

<div class="form-row">
    <label>Gender *</label>
    <div class="radio-group">
        <label><input type="radio" name="gender" value="Male" <?= (($record['gender'] ?? '') === 'Male') ? 'checked' : '' ?> required> Male</label>
        <label><input type="radio" name="gender" value="Female" <?= (($record['gender'] ?? '') === 'Female') ? 'checked' : '' ?>> Female</label>
    </div>
    <?php if (!empty($errors['gender'])): ?><span class="field-error"><?= $errors['gender'] ?></span><?php endif; ?>
</div>

<div class="form-row">
    <label for="address">Address *</label>
    <input type="text" id="address" name="address" value="<?= old($record, 'address') ?>" required>
    <?php if (!empty($errors['address'])): ?><span class="field-error"><?= $errors['address'] ?></span><?php endif; ?>
</div>

<div class="form-row">
    <label for="position">Position *</label>
    <input type="text" id="position" name="position" placeholder="e.g. Instructor, Professor" value="<?= old($record, 'position') ?>" required>
    <?php if (!empty($errors['position'])): ?><span class="field-error"><?= $errors['position'] ?></span><?php endif; ?>
</div>

<div class="form-row">
    <label for="salary">Salary *</label>
    <input type="number" id="salary" name="salary" step="0.01" min="0" value="<?= old($record, 'salary') ?>" required>
    <?php if (!empty($errors['salary'])): ?><span class="field-error"><?= $errors['salary'] ?></span><?php endif; ?>
</div>
