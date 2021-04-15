<?php

include 'model.php';

$obj = new Model();

if (isset($_POST['submit'])) {
    $obj->insertRecord($_POST);
}

if (isset($_POST['update'])) {
    $obj->updateRecord($_POST);
}

if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];
    $obj->deleteRecord($deleteid);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation Using OOPS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <h2 class="text-center bg-dark text-light">CREATE, READ, UPDATE and DELETE Using PHP OOPS</h2>
    <div class="container">
        <?php
        if (isset($_GET['msg']) and $_GET['msg'] == 'ins') {
            echo '<div class="alert alert-success" role="alert">
                Record Inserted Successfully!!!
            </div>';
        }
        if (isset($_GET['msg']) and $_GET['msg'] == 'ups') {
            echo '<div class="alert alert-primary" role="alert">
                        Record Updated Successfully!!!
                    </div>';
        }
        if (isset($_GET['msg']) and $_GET['msg'] == 'dlt') {
            echo '<div class="alert alert-danger" role="alert">
                        Record Deleted Successfully!!!
                    </div>';
        }

        ?>
        <?php
        if (isset($_GET['editid'])) {
            $editid = $_GET['editid'];
            $myrecord = $obj->displayRecordById($editid);

        ?>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="hidden" name="hid" value="<?php echo $myrecord['id']; ?>">
                <input type="text" name="name" value="<?php echo $myrecord['name']; ?>" class="form-control"
                    placeholder="Enter Your Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo $myrecord['email']; ?>" class="form-control"
                    placeholder="Enter Your Email">
            </div>
            <div class="form-group">
                <input type="submit" value="Update Record" name="update" class="btn btn-info">
            </div>
        </form>
        <?php
        } else {
        ?>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter Your Email">
            </div>
            <div class="form-group">
                <input type="submit" value="Add Record" name="submit" class="btn btn-success">
            </div>
        </form>
        <?php
        }
        ?>
        <hr>
        <h4 class="text-center text-danger">Display Record</h4>
        <table class="table table-bordered">
            <tr class="bg-success text-center">
                <th>S.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            #Display Record

            $data = $obj->displayRecord();
            $sno = 1;
            foreach ($data as $value) {
            ?>
            <tr class="text-center">
                <td><?php echo $sno++; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td>
                    <a href="index.php?editid=<?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="index.php?deleteid=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>