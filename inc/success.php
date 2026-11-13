    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <ul class="mb-0">
                <?php foreach ($_SESSION['success'] as $success) : ?>
                    <li><?= $success ?></li>
                <?php endforeach; ?>
                <?php unset($_SESSION['success']) ?>
            </ul>
        </div>
    <?php endif; ?>