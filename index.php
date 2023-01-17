<?php include 'includes/header.php';

/*INSERT*/
/*Insert new template*/
if (isset($_POST['templateName'])) {

    $templateName = $_POST['templateName'];

    //Check if Template Name is existing
    $sql = "SELECT * FROM template WHERE name='" . $templateName . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<h5 style="margin-top:10px;text-align:center; color:red">Template already exists.</h5>';
    } else {
        mysqli_query($conn, "INSERT INTO `template` (`name`) VALUES ('$templateName') ");

    }
}


/*DELETE*/
/*Delete template*/
if (isset($_POST['delId'])) {
    $delId = $_POST['delId'];
    $delQuery = "DELETE FROM template WHERE id=?";
    $sql = $conn->prepare($delQuery);
    $sql->bind_param("i", $delId);
    $sql->execute();


}
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTemplateModal">
                New Template
            </button>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-sm customerTablePage">
                <thead>
                    <tr>
                        <th scope="col-md-2">No</th>
                        <th scope="col-md-6">Templates Name</th>
                        <th scope="col-md-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('config/connectdb.php');


                    $sql = mysqli_query($conn, "SELECT *  FROM template");
                    while ($row = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td>
                                <?php echo $row['name'] ?>
                            </td>
                            <td>
                                <div class="row">
                                    <a href='editor.php?id=<?php echo $row['id'] ?>' class='ml-3'>Edit</a>

                                    <a href="#" onclick="document.getElementById('myForm').submit()" class='ml-3'>Delete</a>

                                    <form id="myForm" method="post" action="index.php">
                                        <input type="hidden" name="delId" value="<?php echo $row['id'] ?>">
                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

    <!----------
    MODALS
------------>
    <!-- Button trigger modal -->

    <!-- Insert customers -->
    <div class="modal fade" id="addTemplateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Template</h5>
                </div>
                <form action="index.php" method="POST" id="addTemplateForm">
                    <div class="modal-body">

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" name="templateName" id="templateName"
                                placeholder="Template Name" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Template</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>