<!DOCTYPE html>
<html lang="en">
<head>
<title>Register Team</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('includes/admin-header.php');?>
    <div class="container">
        <h3 class="center">Register a Team</h3>
        <div class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="unit_ID" type="text" class="validate">
                        <label for="unit_ID">Student ID</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="unit_name" type="text" class="validate">
                        <label for="unit_ID">Unit ID</label>
                    </div>
                </div>
                
                <div class="submit"><input type="submit" name="enrol_student" value="Enrol Student" /></div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var sel = document.querySelectorAll('select');
        M.FormSelect.init(sel);
        });
    </script>


  <?php include('includes/footer.php'); ?>
  </html>