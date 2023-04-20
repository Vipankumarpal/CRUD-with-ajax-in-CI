<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Application - Users List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>" >
</head>
<body>
    <div class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Crud Application</a>
        </div>
    </div>
    <div class="container my-3">
        <div class="row">
            <div class="col-md-12">
                <?php 
                $success = $this->session->userdata('success');
                if($success != ""){
                    ?>
                    <div class="alert alert-success"><?php echo $success ?></div>
               <?php } ?>

               <?php 
                $failure = $this->session->userdata('failure');
                if($failure != ""){
                    ?>
                    <div class="alert alert-danger"><?php echo $failure ?></div>
               <?php } ?>
                
            </div>
        </div>
        <h3 class="float-start my-3" >Users List</h3><a href="<?php echo base_url().'index.php/user/create'; ?>" class="float-end btn btn-primary my-3">Create</a>

        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                
                <?php if(!empty($users)) { foreach($users as $user) { ?>
                <tr>
                <th><?php echo $user['user_id']; ?></th>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a href="<?php echo base_url().'index.php/user/edit/'.$user['user_id']; ?>" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <a href="<?php echo base_url().'index.php/user/delete/'.$user['user_id']; ?>" class="btn btn-danger">Delete</a>
                </td>
                </tr>
                <?php } }
                 else{ 
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="alert alert-danger">Records Not Found!
                            
                        </div>
                        </div>
                    </div>
                    
                <?php  } ?>
                
            </tbody>
            </table>
    </div>
</body>
</html>