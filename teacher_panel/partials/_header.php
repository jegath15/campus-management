<?php include(dirname(__DIR__, 2) . "/assets/config.php"); include(dirname(__DIR__, 2) . "/assets/noSessionRedirect.php"); include(dirname(__DIR__) . "/verifyRoleRedirect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../shared/style.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<?php 
   
    $theme = "light";
   
    $uid = $_SESSION['uid'];
    $query = "SELECT theme FROM users WHERE id='$uid'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
   
      $theme = $row['theme'];
    }
?>
<body class='<?php echo $theme; ?>'>


 
<div class='toast-container position-fixed text-success bottom-0 end-0 p-3' style="z-index: 9000;">
    <div id='liveToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' style="color:black;">
    <div class='d-flex'>
      <div class='toast-body' id="toast-alert-message">
        
      </div>
      <button type='button' class='btn-close me-2 m-auto text-danger' data-bs-dismiss='toast' aria-label='Close'></button>
    </div>
    </div>
  </div>




