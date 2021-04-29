<?php
define('TITLE','Work Order') ;
define('PAGE','Work') ;
include('../dbConnection.php') ;
include('includes/header.php') ;


session_start() ;
if(isset($_SESSION['is_adminlogin'])){
    $aemail= $_SESSION['aEmail'];
}else{
    echo "<script>location.href='AdminLogin.php'</script>" ;
}
?>

    <div class="col-sm-9 col-md-10 mt-5">
        <?php
        $sql= "SELECT * FROM assign_work" ;
        $result = $conn->query($sql) ;
        if($result->num_rows>0){
             echo '<table class="table">
                              <thead>
                              
                              <th>Req ID</th>
                              <th>Req Info</th>
                              <th>Name</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>Mobile</th>
                              <th>Technician</th>
                              <th>Assigned Date</th>
                              <th>Action</th>
                              
                              </thead>
                              <body>';
                              while($row = $result->fetch_assoc()){
                              echo '<tr>';
                              echo'<td>'.$row["request_id"].'</td>' ;
                              echo'<td>'.$row["request_info"].'</td>' ;
                              echo'<td>'.$row["user_name"].'</td>' ;
                              echo'<td>'.$row["user_add2"].'</td>' ;
                              echo'<td>'.$row["user_city"].'</td>' ;
                              echo'<td>'.$row["user_mobile"].'</td>' ;
                              echo'<td>'.$row["assign_tech"].'</td>' ;
                              echo'<td>'.$row["assign_date"].'</td>' ;
                              echo '<td>
                              <form action="viewassignwork.php" method="POST" class="d-inline">
                              <input type="hidden" name="id" value='.$row["request_id"].'>
                              <button class="btn btn-danger mt-2" name="view" value="View" type="submit"><i class ="far fa-eye"></i></button>
                              </form>
                              <form action="" method="POST" class="d-inline">
                              <input type="hidden" name="id" value='.$row["request_id"].'>
                              <button class="btn btn-secondary mt-2" name="delete" value="Delete" type="submit"><i class ="far fa-trash-alt"></i></button>
                              </form>
                              </td>
                              ' ;
                              echo'</tr>';
                              }
                              echo'</body>

                              </table>
                              ';
        }
        
        
        
        else{
            echo '0 result' ;
        }
        if(isset($_REQUEST['delete'])){
$sql = "DELETE  FROM assign_work WHERE request_id ={$_REQUEST['id']}";
if($conn->query($sql)==TRUE) {
    echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>' ;
}else{
    echo "Unable to Delete" ;
}
}
        ?>
    </div> 




<?php
include('includes/footer.php') ;
?>