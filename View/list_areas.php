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
    require_once Config::CONTROLLER_PATH . "AreaController.php";
    $ac = new AreaController;
    $list_areas = $ac::getAll();
    ?>
    <h2 class="title text-center mt-2">Areas</h2>
    <div class="container ">
        <div class="row align-items-center w-100">
            <?php
            $index = 1;
            while ($area_item = $list_areas->fetch()) {
            ?>
                <div class="card m-3 p-2 align-items-center col-3">
                    <img src="<?php echo Config::IMAGES_PATH . "area.png"; ?>" class="card-img">
                    <div class="card-body w-100">
                        <h5 class="card-title"><?php echo $area_item['name'] ?></h5>
                        <p class="card-text">
                            <small class="text-muted">
                                <b>Employees:</b>
                                <?php echo $area_item['employees'] ?>
                            </small>
                        </p>
                        <p class="card-text">
                            <small class="text-muted">
                                <b>Last update:</b>
                                <?php echo date('l jS \of F Y h:i:s A', strtotime($area_item['updated_at'])) ?>
                            </small>
                        </p>
                        <div class="card-body p-0">
                            <a class="btn btn-light float-right" onclick="openModalArea(2,<?php echo $area_item['id'] ?>)">Edit</a>
                            <a class="btn btn-light text-danger float-right" onclick="deleteArea(<?php echo $area_item['id'] ?>)">Delete</a>
                        </div>
                    </div>
                </div>
            <?php $index++;
            }
            if ($index == 1) {
                echo '<h3 class="w-100 text-center mb-3 mt-3">There is not data here!</h3>';
            } ?>
        </div>
    </div>

    <i class="fas fa-plus-circle position-fixed fa-5x text-primary cursor-pointer" style="right: 3%;bottom: 3%;" title="Add Area" onclick="openModalArea(1)">
    </i>

    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formArea">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="nameInput" onkeyup="validateButton()" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <table class="table" id="tableEmployees">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Genre</th>
                                    </tr>
                                </thead>
                                <tbody id="tableAreasContent">

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSave" onclick="saveArea()" disabled>Save</button>
                </div>
            </div>
        </div>
    </div>
    <?php require_once Config::TEMPLATE_PATH . "footer.php"; ?>
    <?php require_once Config::TEMPLATE_PATH . "scripts.php"; ?>
    <script type="text/javascript" src="<?php echo Config::JS_PATH . "logicAreas.js"; ?>"></script>
</body>

</html>