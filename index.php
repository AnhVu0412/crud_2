<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Add product</title>
</head>
<body>


<!-- Add -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="insert.php" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name Product</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter name's product">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input name="price" type="text" class="form-control" id="exampleInputPassword1"
                               placeholder="price">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input name="description" class="form-control" id="description" type="text"
                               placeholder="description">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="btn_insert">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="update.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name Product</label>
                        <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp"
                               placeholder="Enter name's product">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input name="price" type="text" class="form-control" id="price" placeholder="price">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input name="description" class="form-control" id="des" type="text" placeholder="description">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="btn_update">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-- Delete -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="delete.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <h4>Do you want delete this product !!!</h4>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" name="btn_delete">YES</button>
                </div>
            </form>
        </div>

    </div>
</div>


<div class="container">
    <div class="jumbotron">
        <div class="card">
            <h2>CREATE</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                    Add product
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <?php
                $connect = mysqli_connect("localhost", "root", "");
                $db = mysqli_select_db($connect, "vux_test");

                $sql = "select * from product";
                $result = mysqli_query($connect, $sql);
                ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <?php
                    if ($result) {
                        foreach ($result as $row) {
                            ?>
                            <tbody>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td>
                                    <button class="btn btn-success editbtn">Edit</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger deletebtn">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                            <?php
                        }
                    } else {
                        echo " No Record found";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>


<script>
    $(document).ready(function () {
        $('.deletebtn').on('click', function () {
            $('#deletemodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            console.log(data);

            $('#delete_id').val(data[0]);
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.editbtn').on('click', function () {
            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            console.log(data);

            $('#update_id').val(data[0]);
            $('#name').val(data[1]);
            $('#price').val(data[2]);
            $('#des').val(data[3]);
        });
    });
</script>

</body>
</html>