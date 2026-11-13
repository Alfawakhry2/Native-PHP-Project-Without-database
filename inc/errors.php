    <?php if (isset($_SESSION['errors'])) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($_SESSION['errors'] as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']) ?>
            </ul>
        </div>
    <?php endif; ?>