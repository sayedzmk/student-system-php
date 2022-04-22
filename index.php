<?php

$host = "localhost";
$user = "root";
$password = '';
$name = "student";

$conn = mysqli_connect($host, $user, $password, $name);

if (isset($_POST['send'])) {
    $Student_iamge = $_POST['studentimg'];
    $Student_id = $_POST['studentid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $gard_year = $_POST['gard'];
    $insert = "INSERT INTO `students` VALUES ('$Student_iamge',$Student_id,'$firstname','$lastname','$email','$birthdate',$gard_year)";

    $i = mysqli_query($conn, $insert);
    // if ($i) {
    //     echo "<div class='alert alert-info mx-auto w-50'>
    //         Insert DONE 
    //     </div>";
    // } else {
    //     echo "<div class='alert alert-danger mx-auto w-50'>
    //         Insert FAlSe 
    //     </div>";
    // }
}
#################Read############
$select = "SELECT * FROM `students` ";
$s = mysqli_query($conn, $select);
############Delete################
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delet = "DELETE FROM `students` WHERE student_id=$id";
    $d = mysqli_query($conn, $delet);
    header("location:index.php");
}
##########Update##########
$student_img='';
$student_id='';
$firstname='';
$lastname='';
$email='';
$birthdate='';
$gard_year='';
$update=false;
if (isset($_GET['edit'])) {
    $update=true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `students` WHERE  Student_id=$id";
    $su = mysqli_query($conn, $select);
    $data=mysqli_fetch_assoc($su);
    $student_img=$data['Student_photo'];
    $student_id=$data['Student_id'];
    $firstname=$data['first_name'];
    $lastname=$data['last_name'];
    $email=$data['email'];
    $birthdate=$data['data_of_birth'];
    $gard_year=$data['Graduation_year'];
    
    if (isset($_POST['update'])) {
        $Student_iamge = $_POST['studentimg'];
        $Student_id = $_POST['studentid'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
        $gard_year = $_POST['gard'];
        $update = "UPDATE `students` SET Student_photo='$Student_iamge', Student_id=$Student_id,first_name='$firstname',
        last_name='$lastname ',email='$email' , data_of_birth='$birthdate' ,Graduation_year=$gard_year WHERE Student_id=$id";
        $u = mysqli_query($conn, $update);
        header("location:index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Student</title>
</head>

<body>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="card border-0 shadow p-3">
                    <div class="form-floating mb-3 tetx-center">
                        <h4 class="text-center text-warning">Add Student</h4>
                    </div>
                    <form method="POST">
                        <div class="form-floating mb-3">
                            <label for="firstname">Student ID</label>
                            <input type="text" value="<?php echo $student_id?>" class="form-control" name="studentid">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="firstname">Student Image</label>
                            <input type="text" value="<?php echo $student_img?>" class="form-control" name="studentimg">

                        </div>
                        <div class="form-floating mb-3">
                            <label for="firstname">First name</label>
                            <input type="text" value="<?php echo $firstname?>" class="form-control" name="firstname">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" value="<?php echo $lastname?>" class="form-control" name="lastname">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="email">Email address</label>
                            <input type="email" value="<?php echo $email?>" class="form-control" name="email">

                        </div>
                        <div class="form-floating mb-3">
                            <label for="mobile">BirthDate</label>
                            <input type="date" value="<?php echo $birthdate?>" class="form-control" name="birthdate">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="mobile">Graduation year</label>
                            <input type="number" value="<?php echo $gard_year?>" min="2011" max="2021" step="1" value="2019" class="form-control" name="gard">
                        </div>
                        <?php if($update): ?>
                        <button name="update" class="btn btn-outline-info btn-block">Update Student</button>
                        <?php   else: ?>
                        <button name="send" class="btn btn-outline-success btn-block">Add Student</button>
                        <?php endif; ?>

                    </form>
                </div>
            </div>
            <div class="col-md-8 mt-2">
                <h3 class="text-danger text-center"> Student List</h3>
                <div class="card p-3 shadow">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Student Image</th>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">BirthDate</th>
                                    <th scope="col">Graduation year</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($s as $data) { ?>
                                    <tr>
                                        <td> <img src="<?php echo $data['Student_photo'] ?>" style="width:100px" alt=""></td>
                                        <td> <?php echo $data['Student_id'] ?></td>
                                        <td> <?php echo $data['first_name'] ?></td>
                                        <td> <?php echo $data['last_name'] ?></td>
                                        <td> <?php echo $data['email'] ?></td>
                                        <td> <?php echo $data['data_of_birth'] ?></td>
                                        <td class="text-center"> <?php echo $data['Graduation_year'] ?></td>
                                        <td> <a href="index.php?edit=<?php echo $data['Student_id'] ?>" class="btn btn-info">Edit</a>
                                            <a onclick="return confirm('Are You Sure ? ')" href="index.php?delete=<?php echo $data['Student_id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>