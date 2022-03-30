<?php require(ROOT_PATH  . 'layout/top.php');?>
<body class="text-center">
  
    <img class="mb-4" id="fun" src="public/favicon.ico" alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <form method="post" action=""> 
    <div class="form-floating w-25 mx-auto p-1">
      <input type="password" name ="password" class="form-control" placeholder="Password">
    </div>
    
    <button class="w-25 btn btn-dark btn-lg btn-primary" type="submit">Sign in</button>
  </form>
<?php require(ROOT_PATH . 'layout/bottom.php');?>