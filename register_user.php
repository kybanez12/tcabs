<!DOCTYPE html>
<html lang="en">
<head>
<title>PHP Add User</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('includes/admin.header.php');?>
    <div class="container">
        <h3 class="center">Register a new User</h3>
        <div id="login">
            <form method="POST" enctype="multipart/form-data" action="includes/add.user.php">
                <div class="label">First Name: <input type="text" name="fname"></div>
                <div class="label">Surname: <input type="text" name="sname"></div>
                <div class="label">D-O-B: <input type="text" name="birthday"></div>
                <div class="label">Mobile: <input type="text" name="mobile"></div>
                <div class="label">Email: <input type="text" name="email"></div>
                <div class="input-field">
                    <select class="display: block;" name="role">
                        <option value=" " disabled selected>Choose your option</option>
                        <option value="convenor">Convenor</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="student">Student</option>
                        <option value="admin">Admin</option>
                    </select>
                    <label>Select Role</label>
                </div>
                <div class="submit"><input type="submit" name="add_user" value="Add User" /></div>
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquey-3.3.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sel = document.querySelectorAll('select');
            M.FormSelect.init(sel);
        });
    </script>

  <?php include('includes/footer.php'); ?>
  </html>