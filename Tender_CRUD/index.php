<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Tender CRUD</title>
</head>

<body>
    <?php require_once 'process.php';?>

    <?php if(isset($_SESSION['message'])):?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
    ?>

    </div>

    <?php endif ?>

    <div class="container">
        <?php $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM mytable") or die($mysqli->error);?>

        <div class="row justify-content-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                New Tender </button>
            <table class="table table-dark table-bordered">
                <thead>
                    <tr>
                        <th>Tender</th>
                        <th>Description</th>
                        <th colspan="3">Action</th>
                    </tr>
                </thead>
                <?php
            while($row=$result->fetch_assoc()):?>
                <tr>
                    <td><?php echo $row['tender'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Update</button>
                    </td>
                </tr>
                <?php endwhile;?>
            </table>
        </div>
        <?php
    function pre_r($array){
        echo'<pre>';
        print_r($array);
        echo'</pre>';
    }
    ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <form action="process.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <div class="form-group">
                                    <label>Tender</label>
                                    <input type="text" name="tender" class="form-control" value="<?php echo $tender; ?>" placeholder="Enter the name of a tender">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control" value="<?php echo $description; ?>" placeholder="Enter a description">
                                </div>
                                <div class="form-group">
                                    <?php if($update==true):?>
                                    <button type="submit" class="btn btn-warning" name="update">Update</button>
                                    <?php else:?>
                                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                                    <?php endif;?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function()){
                      $('.edit').on('click' function()){
        $('#editmodel').modal('show');
    });
                      });
    </script>
</body>

</html>