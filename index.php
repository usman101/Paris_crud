<?php

    // ------------------- //
    // --- Paris Active Record Crud Application Demo --- //
    //This is simple application demonstrating how idiorm works , This is just a concept you can explore it more about
    // this using idiorm documention.
    // ------------------- //

require'idiorm.php';
require'paris.php';
require'mysql.php';



    /*define("PROJECT", "tododemo");
    define("HTTP_REQUEST", 'http://'.$_SERVER['HTTP_HOST'].'/'.PROJECT);*/

    //Configuring ORM //

    
     //Display user record
    class User extends Model{          
    }

    $users_list = Model::factory('User')->find_array();

    // Counting User table rows and getting values into object $user_list 
    $users_count = Model::factory('User')->count();
        //Insert New User Record From form into database
    if (!empty($_POST)){

        $user_post = Model::factory('User')->create();

        if(isset($_POST['id'])){
            $user_post = Model::factory('User')->find_one($_POST['id']);
        }             
        $user_post->first_name = $_POST['fname'];
        $user_post->last_name = $_POST['lname'];
        $user_post->email = $_POST['email'];
        $user_post->address = $_POST['address'];
        $user_post->save();

        header('Location: ' . basename(__FILE__));
        exit();
    }
    
    if (isset($_GET['delete'])) {

        $user_delete = Model::factory('User')->find_one($_GET['delete']);
        $user_delete->delete();
        header('Location: ' . basename(__FILE__));
        exit();        
    }

    if (isset($_GET['edit'])) {
        $user_update = Model::factory('User')->find_one($_GET['edit']);
    }
        //echo HTTP_REQUEST;


    ?>


    <html>
    <head>
        <title>Crud Application</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
                <div class="row col-sm-12  custyle">
                    <h2> Total No of User : <?php echo $users_count; ?></h2>
                    <table class="table table-striped custab">
                        <thead>    
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead><?php foreach ($users_list as $userinfo):?>
                        <tr>              
                            <td><?php echo $userinfo['id'] ?></td>
                            <td><?php echo $userinfo['first_name']; ?></td>
                            <td><?php echo $userinfo['last_name']; ?></td>
                            <td><?php echo $userinfo['email']; ?></td>
                            <td><?php echo $userinfo['address']; ?></td>
                            <td class="text-center"><a class='btn btn-info btn-xs' href="index.php?edit=<?php echo $userinfo['id']; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="index.php?delete=<?php echo $userinfo['id']; ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <div class="container">
        <div class="row col-sm-8 col-sm-offset-2 custyle ">
            <h2>Please input your Details</h2>
            <fieldset>
                <form method="post" action="">
                    <?php if((isset($user_update) && $user_update)): ?>
                        <input type="hidden" value="<?php echo  $user_update->id ; ?>" name="id"  class="form-control" id="">
                    <?php endif  ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" value="<?php echo (isset($user_update) && $user_update)? $user_update->first_name :''; ?>" name="fname"  class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Last Name</label>
                        <input type="text" value="<?php echo (isset($user_update) && $user_update)? $user_update->last_name:''; ?>" name="lname" class="form-control" id="exampleInputPassword1" placeholder="Enter Last Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" value="<?php echo (isset($user_update)&& $user_update)? $user_update->email: ''; ?>" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Address</label>
                        <input type="text" value="<?php echo (isset($user_update) && $user_update)? $user_update->address: ''; ?>" name="address" class="form-control" id="exampleInputPassword1" placeholder="Address">
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </fieldset>
        </div>
    </div>
</body>
</html>
