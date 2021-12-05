<?php
require_once "../config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once Config::TEMPLATE_PATH . "head.php"; ?>
    <link rel="stylesheet" href="<?php echo Config::CSS_PATH . "custom_styles.css"; ?>">
</head>

<body>
    <script type="text/javascript" src="<?php echo Config::JS_PATH . "urls.js"; ?>"></script>
    <?php require_once Config::TEMPLATE_PATH . "header.php"; ?>
    <?php
    require_once Config::CONTROLLER_PATH . "EmployeeController.php";
    $ec = new EmployeeController;
    $list_employees = $ec::getAll();
    ?>
    <h2 class="title text-center mt-2">Employees</h2>
    <div class="container ">
        <div class="row align-items-center w-100">
            <?php
            $index = 1;
            while ($employee_item = $list_employees->fetch()) {
            ?>
                <div class="card m-3 p-2 align-items-center col-3">
                    <img src="<?php echo Config::IMAGES_PATH . "employee_" . $employee_item['genre'] . ".png"; ?>" class="card-img">
                    <div class="card-body w-100">
                        <h5 class="card-title"><?php echo $employee_item['name'] ?></h5>
                        <p class="card-text"><?php echo $employee_item['area'] ?></p>
                        <p class="card-text">
                            <small class="text-muted">
                                <b>Last update:</b>
                                <?php echo date('l jS \of F Y h:i:s A', strtotime($employee_item['updated_at'])) ?>
                            </small>
                        </p>

                        <div class="card-body p-0">
                            <a class="btn btn-light float-right" onclick="openModalEmployee(2,<?php echo $employee_item['id'] ?>)">Edit</a>
                            <a class="btn btn-light text-danger float-right" onclick="deleteEmployee(<?php echo $employee_item['id'] ?>)">Delete</a>
                        </div>
                    </div>
                </div>
            <?php
                $index++;
            }
            if ($index == 1) {
                echo '<h3 class="w-100 text-center mb-3 mt-3">There is not data here!</h3>';
            } ?>
        </div>
    </div>

    <i class="fas fa-plus-circle position-fixed fa-5x text-primary cursor-pointer" style="right: 3%;bottom: 3%;" title="Add Employee" onclick="openModalEmployee(1)">
    </i>

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
                    <form id="formEmployee">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name *</label>
                            <input type="text" class="form-control" id="nameInput" onkeyup="validateButton()" placeholder="Enter name">
                        </div>
                        <div class="form-group mb-0">
                            <label for="exampleInputEmail1">Genre *</label>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" onchange="validateButton()" name="genreInput" id="genreInput1" value="w" checked>
                                <label class="form-check-label" for="genreInput2">Woman</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" onchange="validateButton()" name="genreInput" id="genreInput2" value="m">
                                <label class="form-check-label" for="genreInput2">Man</label>
                            </div>
                            <?php
                            require_once Config::CONTROLLER_PATH . "AreaController.php";
                            $ac = new AreaController;
                            $list_areas = $ac::getAll();
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="areaInput">Area *</label>
                            <select class="form-control" onchange="validateButton()" id="areaInput">
                                <option value="">Choose an area</option>
                                <?php while ($area_item = $list_areas->fetch()) { ?>
                                    <option value="<?php echo $area_item['id'] ?>">
                                        <?php echo $area_item['name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="areaInput">Jobs *</label>
                            <div class="w-100" style="overflow:auto;max-height:300px">
                                <table class="table" id="tableEmployees">
                                    <tbody id="tableAreasContent">
                                        <?php
                                        require_once Config::CONTROLLER_PATH . "JobController.php";
                                        $jc = new JobController;
                                        $list_jobs = $jc::getAll();
                                        while ($job_item = $list_jobs->fetch()) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-control mt-1 cbxJob" name="cbxJob<?php echo $job_item['id'] ?>" id="cbxJob<?php echo $job_item['id'] ?>" onchange="addId(<?php echo $job_item['id'] ?>)">
                                                </td>
                                                <td><?php echo $job_item['name'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSave" onclick="saveEmployee()" disabled>Save</button>
                </div>
            </div>
        </div>
    </div>
    <?php require_once Config::TEMPLATE_PATH . "footer.php"; ?>
    <?php require_once Config::TEMPLATE_PATH . "scripts.php"; ?>
    <script type="text/javascript" src="<?php echo Config::JS_PATH . "logicEmployees.js"; ?>"></script>
</body>

</html>