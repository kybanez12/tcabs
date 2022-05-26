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
            <form class="col s12" method="POST" action="add.unit.php">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="unitCode" name="unitCode" type="text" class="validate">
                        <label for="unitCode">Unit Code</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="unitName" name="unitName" type="text" class="validate">
                        <label for="unitName">Unit Name</label>
                    </div>
                </div>
                <div class="submit"><input type="submit" name="add_unit" id="add_unit" value="Register Unit" /></div>
            </form>
        </div>
    </div>
    
    
  <?php include('includes/footer.php'); ?>
  </html>