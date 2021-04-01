<div class="container">       
    <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
        </div>    
    <?php } else if($this->session->flashdata('error')){  ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
        </div>    
    <?php } ?>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_default_1">
            <div class="well well-sm">
                <h4>PERSONAL DATA</h4>
            </div>
            <p align="right">
                <a href="<?= base_url('edit-user') ?>" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </a>
            </p>
            <table class="table bio-table">
                <tbody>
                    <tr>      
                        <td><strong>Username</strong></td>
                        <td>: <?=$user['user_name'];?></td> 
                    </tr>
                    <tr>    
                        <td><strong>Email</strong></td>
                        <td>: <?=$user['user_email'];?></td>
                    </tr>
                    <tr>    
                        <td><strong>Age</strong></td>
                        <td>: <?=$user['age'];?></td>       
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td>: <?=$user['city'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Post Code</strong></td>
                        <td>: <?=$user['post_code'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td>: <?=$user['address'];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
