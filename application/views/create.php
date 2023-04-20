<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Application - Create User</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>" >
</head>
<body>
    <div class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Crud Application</a>
        </div>
    </div>
    <div class="container pt-3">
        <h3>Create user</h3>
        <hr>
        <form name="createUser" method="post" action="<?php echo base_url().'index.php/User/create'; ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control">
                    <?php echo form_error('name'); ?>
                </div>
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control">
                    <?php echo form_error('email'); ?>
                </div>
                <div class="form-group mb-3">
                <button class="btn btn-primary">Create</button>
                <a href="<?php echo base_url().'index.php/user/index'; ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</body>
</html>