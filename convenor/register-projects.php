<!-- This page allows a convenor to register a project -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register Team</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('convenor-header.php');?>
    <div class="container">
        <h3 class="center">Register a Team</h3>
        <div class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="pname" type="text" class="validate">
                        <label for="pname">Project Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="pdescription" type="text" class="validate">
                        <label for="pdescription">Project Description</label>
                    </div>
                </div>
              <div class="submit"><input type="submit" name="reg_project" value="Register Project" /></div>
            </form>
        </div>
    </div>

  <?php include('../includes/footer.php'); ?>
  </html>