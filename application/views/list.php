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
    <div class="modal fade" id="createUser" tabindex="-1" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div id="response">

          </div>

        </div>
      </div>
    </div>


    <script type="text/javascript">
        function showModal(){
            $("#createUser").modal("show");

            $.ajax({
                url: '<?php echo base_url().'User/create'; ?>',
                type: 'POST',
                data: {},
                dataType: 'json',
                success: function(response){
                    $("#response").html(response["html"]);
                }
            })
        }

        $("body").on("submit","#createUser",function(e){
            e.preventDefault();
            // alert();
            $.ajax({
                url: '<?php echo base_url().'User/save'; ?>',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){
                    //$("#response").html(response["html"]);

                    if(response['status']== 0 ){

                        if(response["name"] != ""){
                            $(".nameError").html(response["name"]);
                        }

                        if(response["email"] != ""){
                            $(".emailError").html(response["email"]);
                        }
                    }
                }
            })
            
        });
    </script>
</body>
</html>