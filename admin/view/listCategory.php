<?php
session_start();
include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";

$cat = $_SESSION['categories'] ?? [];
?>

<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">

                <div class="card-body px-5 py-5">
                    <h3 class="card-title text-left mb-3">All Categories</h3>

                    <?php 
                    include '../../inc/errors.php';
                    include '../../inc/success.php';
                    ?>

                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php if (!empty($cat)) : ?>
                                <?php foreach ($cat as $index => $c) : ?>
                                    <tr>
                                        <th scope="row"><?= $index ?></th>

                                        <td><?= $c['title']?></td>

                                        <td class="text-end">
                                            <a
                                                class="btn btn-sm btn-outline-primary me-2"
                                                href="editCategory.php?id=<?= $index ?>">
                                                Edit
                                            </a>
                                            <a
                                                class="btn btn-sm btn-outline-danger me-2"
                                                href="deleteCategory.php?id=<?= $index ?>">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else : ?>

                                <tr>
                                    <td colspan="3" class="text-center">
                                        No categories found
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- row ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<?php
include "../view/footer.php";
?>