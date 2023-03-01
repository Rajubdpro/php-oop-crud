<?php
/*-------Include database file-----*/
include 'database.php';
$obj = new database();

/*----Insert data-----*/
if (isset($_POST['submit'])) {
    $obj->insertRecord($_POST);
} //if isset close

/*----Update data-----*/
if (isset($_POST['update'])) {
    $obj->updateRecord($_POST);
} //if isset close

/*----Delate data-----*/
if (isset($_GET['deleteid'])) {
    $delid = $_GET['deleteid'];
    $obj->deleteRecord($delid);
} //if isset close

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php oop crud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container">
    <div class="card card-header">
    <h2 class="text-center text-primary">PHP OOP CRUD</h2>
    </div>
        <!-- Success message -->
        <?php
        if (isset($_GET['msg']) and $_GET['msg'] == 'ins') {
            echo '<div class="alert alert-primary" role="alert">
            Record inserted seccessfully!
         </div>';
        }
        if (isset($_GET['msg']) and $_GET['msg'] == 'ups') {
            echo '<div class="alert alert-info" role="alert">
        Record Updated seccessfully!
        </div>';
        }
        if (isset($_GET['msg']) and $_GET['msg'] == 'del') {
            echo '<div class="alert alert-danger" role="alert">
                Record Deleted seccessfully!
                </div>';
        }

        ?>
        <?php
        /*----fatch record for updation---*/
        if (isset($_GET['editid'])) {
            $editid = $_GET['editid'];
            $myrecord = $obj->displayRecordById($editid);
        ?>
            <!---update form----->
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $myrecord['name']; ?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $myrecord['email']; ?>" placeholder="Enter your email">
                </div>
                <br>
                <div class="form-group">
                    <input type="hidden" name="hid" value="<?php echo $myrecord['id'] ?>">
                    <input type="submit" class="btn btn-info" name="update" value="update" style="width: 150px;">
                </div>
            </form>
        <?php
        } else {
        ?>
            <div class="card card-body" style="border: 1px solid #ccc;">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" name="submit" value="Submit" style="width: 150px;">
                    </div>
                </form>
            </div>
        <?php } //else close 
        ?>
        <br>
        <h4 class="text-center text-danger">Display Records</h4>
        <table class="table table-bordered">
            <tr class="text-center bg-primary text-white">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            /*--display record---*/
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
                        <a href="index.php?deleteid=<?php echo $value['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php
            } //foreach close
            ?>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>