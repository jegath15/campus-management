<?php 
include("../assets/config.php");
include("../assets/noSessionRedirect.php"); 
include("./verifyRoleRedirect.php"); 
// $user_data is now globally available from verifyRoleRedirect.php

$active_page = 'workspace';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Workspace | CMS</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" href="../shared/style.css">
    <link rel="stylesheet" href="style.css">

    <style>
        #myInput {
            background-image: url('search.svg');
            background-position: 15px center;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 45px;
            border: 1px solid var(--glass-border);
            margin-bottom: 1.5rem;
            border-radius: 12px;
            background-color: var(--bg-card);
            color: var(--text-main);
        }

        #myTable {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        #myTable th {
            background-color: var(--primary);
            color: white;
            padding: 15px;
            text-align: left;
        }

        #myTable td {
            background-color: var(--bg-card);
            padding: 15px;
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }

        #myTable tr td:first-child { border-left: 1px solid var(--glass-border); border-radius: 12px 0 0 12px; }
        #myTable tr td:last-child { border-right: 1px solid var(--glass-border); border-radius: 0 12px 12px 0; }

        .btn {
            background-color: var(--primary);
            border: none;
            color: white;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            transition: opacity 0.2s;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <?php include('partials/_header.php'); ?>

    <?php include('partials/_sidebar.php'); ?>

    <div class="content">
        <?php include("../admin_panel/partials/_navbar.php"); ?>

        <main>
            <h1>Student Workspace</h1>
            <p class="text-muted" style="margin-bottom: 2rem;">Access and download course materials shared by your teachers.</p>

            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for subjects or titles...">

            <div class="table-responsive">
                <table id="myTable">
                  <thead>
                      <tr class="header">
                        <th>Subject</th>
                        <th>Title</th>
                        <th>Downloads</th>
                        <th>Date</th>
                      </tr>
                  </thead>
                  <tbody id="geeks">
                    <?php
                       $class = $user_data['class'];
                       $query="select * from notes where class='$class' order by s_no desc";
                       $result=mysqli_query($conn,$query);
                       if($result->num_rows>0){
                        while($rows=$result->fetch_assoc()) {
                            $dateDB = $rows['timestamp'];
                            $formattedDate = date("d M, Y", strtotime($dateDB));

                            echo "<tr>
                                    <td>".$rows['subject']."</td>
                                    <td>".$rows['title']."</td>
                                    <td><a href='../notesUploads/".$rows['file']."' class='btn' download><i class='bx bx-cloud-download' style='font-size:1.1rem;'></i> Download</a></td>
                                    <td>".$formattedDate."</td>
                                  </tr>";
                        }
                       } else {
                        echo '<tr><td colspan="4" style="text-align:center; padding: 3rem;">No notes available for your class yet.</td></tr>';
                       }
                     ?>
                   </tbody>
                </table> 
            </div>
        </main>
    </div>

    <script src="app.js"></script>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) {
                td = tr[i];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
