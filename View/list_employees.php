<?php include "../config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include Config::TEMPLATE_PATH . "head.php"; ?>
</head>

<body>
    <?php include Config::TEMPLATE_PATH . "header.php"; ?>
    <?php
    include Config::CONTROLLER_PATH . "EmployeeController.php";
    $ec = new EmployeeController;
    $list_employees = $ec->getAll();
    ?>

    <div class="container ">
        <div class="row align-items-center w-100">
            <?php while ($row = $list_employees->fetch()) { ?>
                <div class="card m-3 p-2 align-items-center col-3">
                    <img src="<?php echo Config::IMAGES_PATH . "employee_" . $row['genre'] . ".png"; ?>" class="card-img">
                    <div class="card-body w-100">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <p class="card-text"><?php echo $row['area'] ?></p>
                        <p class="card-text">
                            <small class="text-muted">
                                <b>Last update:</b>
                                <?php echo date('l jS \of F Y h:i:s A', strtotime($row['updated_at'])) ?>
                            </small>
                        </p>
                        <div class="card-body">
                            <a class="btn btn-light" data-toggle="modal" data-target="#modalEdit" onclick="openModal(<?php echo $row['id'] ?>)">Edit</a>
                            <a class="btn btn-light text-danger" onclick="openModal(<?php echo $row['id'] ?>)">Delete</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">
                        Nuevo Empleado
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <?php include Config::TEMPLATE_PATH . "footer.php"; ?>
    <?php include Config::TEMPLATE_PATH . "scripts.php"; ?>
    <script type="text/javascript" src="<?php echo Config::JS_PATH . "logicEmployees.js"; ?>"></script>
</body>

</html>