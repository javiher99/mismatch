<?php        
        ini_set('display_error',1);
        error_reporting(E_ALL);

        require_once('header.php');

        define("DB_HOST", 'localhost');
        define("DB_USER", 'root');
        define("DB_PASS", 'root');
        define("DB_NAME", 'mismatch');

        require_once('DBConnection.php');

        if(isset($_POST['submit'])){
          $dbconnection = new DBConnection();
          $user = new users($_POST);
          
          $mensaje = $user->getMessage();
          $sql = "INSERT INTO users VALUES(".implode()."):";    
          echo $sql;   
        }

?>
<form id="form" class="topBefore" action="<?php echo $_SERVER['PHP_SELF']?>">
<div class="page">
  <div class="container">
    <div class="left">
      <div class="login">Login Mismatch</div>
      <div class="eula">Admin profile</div>
    </div>
    <div class="right">
      <svg viewBox="0 0 320 300">
        <defs>
          <linearGradient
                          inkscape:collect="always"
                          id="linearGradient"
                          x1="13"
                          y1="193.49992"
                          x2="307"
                          y2="193.49992"
                          gradientUnits="userSpaceOnUse">
            <stop
                  style="stop-color:#ff00ff;"
                  offset="0"
                  id="stop876" />
            <stop
                  style="stop-color:#ff0000;"
                  offset="1"
                  id="stop878" />
          </linearGradient>
        </defs>
        <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
      </svg>
      <div class="form">
      <label for="password">Password</label>
        <input type="password" id="password">
        <label for="password">Repyte Password</label>
        <input type="password" id="password">

        <label for="username">Username</label>
        <input type="text" id="username">

        <label for="lastname">Lastname</label>
        <input type="text" id="lastname">

        <label for="firstname">Firstname</label>
        <input type="text" id="firstname">

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="male"> Male
        <input type="radio" name="gender" value="female" checked> Female

        <label for="date">Birthday</label>
        <input type="date" id="date">

        <label for="city">City</label>
        <input type="text" id="city">

        <label for="state">State</label>
        <input type="text" id="state">

        <input type=file id="archivo" value=“mi_archivo” >

        <input type="submit" id="submit" value="Submit">
      </div>
    </div>
  </div>
</div>

</form>

<?php
require_once('footer.php');
?>