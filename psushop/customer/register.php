<!DOCTYPE html>
<html lang="en">

<head>

    <title>PSU SHOP</title>
    <?php include('../header.php'); ?>
</head>

<body>
    <div class="container">
        <h2>สมัครสมาชิก</h2>
        <form action="registerDB.php" method="post">
            <div class="form-group">
                <label>User ID :</label>
                <input type="text" class="form-control" id="user_id" placeholder="Enter User ID" name="user_id">
            </div>
            <div class="form-group">
                <label>Password :</label>
                <input type="password" class="form-control" id="user_password" placeholder="Enter Password" name="user_password">
            </div>
            <div class="form-group">
                <label> Name :</label>
                <input type="text" class="form-control" id="user_name" placeholder="Enter Name" name="user_name">
            </div>
            <div class="form-group">
                <label> Lastname :</label>
                <input type="text" class="form-control" id="user_lastname" placeholder="Enter Lastname" name="user_lastname">
            </div>
            <div class="form-group">
                <label> Tel :</label>
                <input type="text" class="form-control" id="Tell" placeholder="Enter Tell" name="Tell">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label> Address :</label>
                <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
            </div>

           
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>