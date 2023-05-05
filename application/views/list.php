<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Application - Users List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>" >
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.6.4.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.min.js';?>"></script>
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
        <!-- <h3 class="float-start my-3" >Users List</h3><a href="<?php //echo base_url().'user/create'; ?>" class="float-end btn btn-primary my-3">Create</a> -->

        <h3 class="float-start my-3" >Users List</h3><a href="javascript:void(0);" onclick="showModal();" class="float-end btn btn-primary my-3">Create</a>

        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
               
                </tr>
            </thead>
            <tbody>
                
                <?php if(!empty($users)) { foreach($users as $user) { ?>
                <tr>
                <th><?php echo $user['user_id']; ?></th>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a href="<?php echo base_url().'user/edit/'.$user['user_id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="<?php echo base_url().'user/delete/'.$user['user_id']; ?>" class="btn btn-danger">Delete</a>
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

    <!-- Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="ajaxRes"></p>
            <form name="createUser" id="createUser" method="post" action="<?php echo base_url().'User/create'; ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" class="form-control">
                    <?php //echo form_error('name'); ?>
                    <p class="nameError"></p>
                </div>
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control">
                    <?php //echo form_error('email'); ?>
                    <p class="emailError"></p>
                </div>
                <div class="form-group mb-3">
                <!-- <button class="btn btn-primary">Create</button>
                <a href="<?php //echo base_url().'user/index'; ?>" class="btn btn-secondary">Cancel</a> -->
                </div>
            </div>
        </div>
       
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
           </form>
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript">
        function showModal(){
            $("#createUserModal").modal("show");
        }

        $("body").on("submit","#createUser",function(e){
            e.preventDefault();
            console.log($(this).serializeArray());
            // alert();
            $.ajax({
                url: '<?php echo site_url().'index.php/User/save'; ?>',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){
                    //$("#response").html(response["html"]);

                    if(response.status == 0 ){
                        if(response["name"] != ""){
                            $(".nameError").html(response["name"]);
                        }

                        if(response["email"] != ""){
                            $(".emailError").html(response["email"]);
                        }
                    }else{
                        $(".ajaxRes").text('Success').addClass('text-success');
                    }
                }
            })
            
        });
    </script>
</body>
</html>