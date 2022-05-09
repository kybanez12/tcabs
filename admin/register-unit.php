<!-- This page allows an admin to register a new unit -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register Unit</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('admin-header.php');?>
    <div class="container">
        <h3 class="center">Register a new Unit</h3>
        <div class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="unit_ID" type="text" class="validate">
                        <label for="unit_ID">Unit ID</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="unit_name" type="text" class="validate">
                        <label for="unit_ID">Unit Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="description" class="materialize-textarea"></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
                <div class="submit"><input type="submit" name="add_unit" value="Register Unit" /></div>
            </form>
        </div>
    </div>
  <?php include('includes/footer.php'); ?>
  </html>