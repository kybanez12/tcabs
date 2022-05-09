<!-- This page allows an admin to register a new user and set role -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register User</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('admin-header.php');?>
    <div class="container">
        <h4 class="center">Register a new User</h4><br>
        <div class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data" action="includes/add.user.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="fname" type="text" class="validate">
                        <label for="fname">First Name</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="sname" type="text" class="validate">
                        <label for="lname">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="birthday" type="text" class="validate">
                        <label for="fname">Date of Birth</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="mobile" type="text" class="validate">
                        <label for="mobile">Mobile</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="text" class="validate">
                        <label for="mobile">Email</label>
                    </div>
                </div>
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