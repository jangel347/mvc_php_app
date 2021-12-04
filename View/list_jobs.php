<?php
require_once "../config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include Config::TEMPLATE_PATH . "head.php"; ?>
    <link rel="stylesheet" href="<?php echo Config::CSS_PATH . "custom_styles.css"; ?>">
</head>

<body>
    <script type="text/javascript" src="<?php echo Config::JS_PATH . "urls.js"; ?>"></script>
    <?php include Config::TEMPLATE_PATH . "header.php"; ?>
    <?php
    include Config::CONTROLLER_PATH . "JobController.php";
    $jc = new JobController;
    $list_jobs = $jc::getAll();
    ?>
    <h2 class="title text-center mt-2">Jobs</h2>
    <div class="container ">
        <div class="row align-items-center w-100">
            <table class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    while ($area_item = $list_jobs->fetch()) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $index ?>
                            </td>
                            <td>
                                <?php echo $area_item['name'] ?>
                            </td>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <?php echo date('l jS \of F Y h:i:s A', strtotime($area_item['updated_at'])) ?>
                                </small>
                            </td>
                            <td>
                                <a class="btn btn-light" onclick="openModalJob(2,<?php echo $area_item['id'] ?>)">Edit</a>
                                <a class="btn btn-light text-danger" onclick="deleteJob(<?php echo $area_item['id'] ?>)">Delete</a>
                            </td>

                        </tr>
                    <?php
                        $index++;
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <i class="fas fa-plus-circle position-fixed fa-5x text-primary cursor-pointer" style="right: 3%;bottom: 3%;" title="Add Job" onclick="openModalJob(1)">
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
                    <form id="formJob">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="nameInput" placeholder="Enter name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveJob()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php include Config::TEMPLATE_PATH . "footer.php"; ?>
    <?php include Config::TEMPLATE_PATH . "scripts.php"; ?>
    <script type="text/javascript" src="<?php echo Config::JS_PATH . "logicJobs.js"; ?>"></script>
</body>

</html>