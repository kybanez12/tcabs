<!DOCTYPE html>
<html>
  <?php include('templates/header.php'); ?>
  <div class="container">
  <h1>Register Student</h1>
  <form>
    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="fname"><br>
    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="lname"><br>
    <label for="mobile">Mobile:</label><br>
    <input type="text" id="mobile" name="mobile"><br>   
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email"><br>
    <input type="submit" name="submit" id="submit" class="btn brand z-depth-0">
  </form>

  </div>
  <?php include('templates/footer.php'); ?>
</html>

