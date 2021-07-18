<?php
//INSERT INTO `notes` (`S.No`, `Title`, `Description`, `Date`) VALUES ('1', 'CRUD Project', 'This is a CRUD project and I will try to complete this project.', current_timestamp());
// Connecting to the Database
$insert = False;
$update = False;
$delete = False;
$servername = "localhost";
$username = "root";
$password = "";
$database = "inote";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
// Delete Operation
if (isset($_GET['delete'])){
    $sno = $_GET['delete'];
    
    $sql = "DELETE FROM `notes` WHERE `notes`.`S.No` = $sno";
    $result = mysqli_query($conn, $sql);
        if($result){
            $delete =true;
        }
        else{
            echo  mysqli_error($conn);
        } 

}
     //update the record
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset($_POST['snoEdit'])){
   
        $sno = $_POST['snoEdit'];
        $title = $_POST['titleEdit'];
        $description = $_POST['descriptionEdit'];
        $sql="UPDATE `notes` SET `Title` = '$title', `Description` = '$description' WHERE `notes`.`S.No` = $sno";
        $result = mysqli_query($conn, $sql);
            if($result){
                $update =true;
            }
            else{
                echo  mysqli_error($conn);
            } 
}
     //Insert the record

else {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql = "INSERT INTO `notes` (`Title`, `Description`, `Date`) VALUES ('$title', '$description', current_timestamp())";
    $result = mysqli_query($conn, $sql); 


if($result){
    /*echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You record was inserted Successfully.
    <button type="button" class="btn-close alert-success" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';*/
  $insert = true;
}
else{
    echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
}
}
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <title>iNotes</title>
</head>

<body>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit This Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form -->
                <form action="/project_crud/index.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group mb-3">
                            <label for="title">Note Title</label>
                            <input type="text" class="form-control" name="titleEdit" id="titleEdit"
                                aria-describedby="emailHelp">

                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Note Description</label>
                            <textarea class="form-control" name="descriptionEdit" id="descriptionEdit"
                                rows="3"></textarea>
                        </div>
                       

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">iNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">About iNotes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
    if($insert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You note was inserted Successfully.
    <button type="button" class="btn-close alert-success" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    if($update){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You note was updated Successfully.
    <button type="button" class="btn-close alert-success" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    if($delete){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You note was deleted Successfully.
    <button type="button" class="btn-close alert-success" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    ?>

    <div class="container my-4">
        <h1>Add Your Notes Here</h1>

        <form action="/project_crud/index.php" method="post">
            <div class="form-group mb-3 ">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">

            </div>
            <div class="form-group mb-3">
                <label for="description">Note Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>
    <div class="container my-3">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //to display the record from the databse
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                $sno=0;
                //loop to fetch the result from the database
                while($row = mysqli_fetch_assoc($result)){
                    $sno=$sno+1;
                    echo "<tr>
                    <th scope='row'>".$sno."</th>
                    <td>".$row['Title']."</td>
                    <td>".$row['Description']."</td>
                    <td><button class='edit btn-sm btn-primary'id=".$row['S.No'].">Edit</button> <button class='delete btn-sm btn-primary'id=d".$row['S.No'].">Delete</button></td>
                </tr>"; 
                }
       
            ?>


            </tbody>
        </table>


    </div>
    <hr>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>$(document).ready(function () {
            $('#myTable').DataTable();
        });</script>

    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');
            })
        });

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete",);
                tr = e.target.parentNode.parentNode;
                sno = e.target.id.substr(1,);
                if (confirm("Are you sure you want to delete?")) {
                    console.log("The record has been successfully deleted");
                    window.location = `/project_crud/index.php?delete=${sno}`;
                } else {
                    console.log("The record was not deleted");
                }
            })
        });
    </script>
</body>

</html>