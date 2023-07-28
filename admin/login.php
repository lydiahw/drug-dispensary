


  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/login.css" />
    <title>Drug Dispensary</title>
  </head>
  <body>
    <div class="container">

      <div class="forms-container">

        <div class="signin-signup">
            
          <form action="code.php" class="admin-signin" method ="POST">
            <h2 class="title">Sign in</h2>
            <div class="form-group">
              <i class="fas fa-user"></i>
              <input type="email" name ="email"  placeholder="Enter Email Address...">
            </div>
            <div class="form-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password"  placeholder="Password">
            </div>
            <input type="submit" name="login_admin" class="btn solid" value = "Login">
            
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Welcome Back!</h3>

            <?php
                                   
            if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
             echo '<h2 class ="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
             unset($_SESSION['status']);
            }
         
         ?>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        
      </div>
    </div>

    
  </body>

