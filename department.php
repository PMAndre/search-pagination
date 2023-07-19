<?php
session_start();

include 'dbcon.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style5.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Department</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
               <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7f/Philippine_Military_Academy_%28PMA%29.svg/1200px-Philippine_Military_Academy_%28PMA%29.svg.png" alt="">
            </div>

            <span class="logo_name">CIS</span>
        </div>

        <div class="sue">
            <ul>
                <li class="main-link">
                    <a href="/cssbackupv2/user_panel.php" class="link-text">
                        <i class="uil uil-estate"></i>Dashboard</a>
                </li>
                <li class="main-link">
                    <i class="uil uil-folder"></i>
                    File Maintenance
                    <i class="uil uil-arrow-right rotate"></i>
                    <ul class="sublink"></li>
                        <li><a href="/cssbackupv2/file_maintenance/cadets/cadet.php">Cadets</a></li>
                        <li><a href="/cssbackupv2/file_maintenance/department/department.php">Department</a></li>
                        <li><a href="/cssbackupv2/file_maintenance/faculty/faculty.php">Faculty</a></li>
                        <li><a href="/cssbackupv2/file_maintenance/course/course.php">Course</a></li>
                    </ul>
                </li>
                <li class="main-link">
                    <i class="uil uil-facebook"></i>
                    Main Link 2
                    <ul class="sublink">
                        <li>Sublink 1
                            <ul class="subbuttonlink">
                                <li>Subbuttonlink 1</li>
                                <li>Subbuttonlink 2</li>
                                <li>Subbuttonlink 3</li>
                            </ul>
                        </li>
                        <li>Sublink 2</li>
                        <li>Sublink 3</li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <button>
                <i class="uil uil-bars sidebar-toggle"></i>
            </button>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" id="searchInput" placeholder="Search here..." oninput="searchTable()" style="text-transform: uppercase;">
            </div>
            
            <!--<img src="images/profile.jpg" alt="">-->
            <div class="norms">
                <div class="loki" onclick="menuToggle();">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVWQTWRsXnQBqP30w3bP2Il7Y9nnybYopPVg&usqp=CAU" width="50" height="50">
                </div>
                    <div class="logout">
                    <!-- Name of the profile
                        <h3>Famous<br><span>Tinapay Enjoyer</span></h3> -->
                    <ul>
                        <li><a href="logout.php">
                            <i class="uil uil-signout">Logout</i></a>
                        </li>
                        <li><a href="#">
                                <i class="uil uil-setting"></i>
                                Settings
                            </a>
                        </li>
                        <li>
                            <i class="uil uil-moon"></i>
                            <span class="link-name">
                                Dark Mode
                            </span>
                            <div class="mode-toggle">
                                <span class="switch"></span>
                            </div>
                        </li>
                    </ul>
                </div>    
            </div>
        </div>


        <div class="dash-content">
            <div class="overview">
            
                <div class="container mt-4">
                    <div class="activity">
                    

                        <?php include('message.php'); ?>
                        <?php include('deptconfig.php'); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            <i class="uil uil-briefcase-alt deplogo"></i>
                                            <span class="text">Department</span>
                                            <a href="dept-create.php" class="btn btn-primary float-end">Add Department</a>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="td">DEPTCODE</th>
                                                <th contenteditable="true" class="td">DEPTNAME</th>
                                                <th contenteditable="true" class="td">DEPTHEAD</th>
                                                <th contenteditable="true" class="td">DEPTGROUP</th>
                                                <th class="td"></th>
                                            </tr>
                                        </thead>
                                         <tbody id="tableBody">
                                            <?php 
                                                $query = "SELECT * FROM department LIMIT $entriesPerPage OFFSET $offset";
                                                $query_run = mysqli_query($conn, $query);

                                                $rowNum = ($currentPage - 1) * $entriesPerPage + 1;
                                                while ($dept = mysqli_fetch_assoc($query_run)) {

                                                     // Store the department details in JavaScript-accessible variables
                                                    $deptCode = $dept['deptcode'];
                                                    $deptName = $dept['deptname'];
                                                    $deptHead = $dept['depthead'];
                                                    $deptGroup = $dept['deptgroup'];
                                                    ?>
                                                    <tr class="myList">
                                                        <td><?= $dept['deptcode']; ?></td>
                                                        <td><?= $dept['deptname']; ?></td>
                                                        <td><?= $dept['depthead']; ?></td>
                                                        <td><?= $dept['deptgroup']; ?></td>
                                                        <td>
                                                            <div class="inline">
                                                                <a href="dept-edit.php?department_id=<?= $dept['department_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                            </div>
                                                            <div class="inline">
                                                                <form action="department.php" method="POST" class="d-inline">
                                                                    <a href="" name="delete_student" value="<?= $dept['department_id']; ?>" class="btn btn-danger btn-sm">Withdraw</a>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $rowNum++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>







                                        
                                        
                                        
                                        <!-- Pagination -->
                                            <div class="pagination">
                                                <ul class="pagination-list">
                                                    <?php
                                                    if ($totalPages > 1) {
                                                        if ($currentPage > 1) {
                                                            echo '<li><a href="department.php?page=' . ($currentPage - 1) . '">&laquo;</a></li>';
                                                        }
                                                        for ($i = 1; $i <= $totalPages; $i++) {
                                                            if ($i == $currentPage) {
                                                                echo '<li class="active"><span>' . $i . '</span></li>';
                                                            } else {
                                                                echo '<li><a href="department.php?page=' . $i . '">' . $i . '</a></li>';
                                                            }
                                                        }
                                                        if ($currentPage < $totalPages) {
                                                            echo '<li><a href="department.php?page=' . ($currentPage + 1) . '">&raquo;</a></li>';
                                                        }
                                                    }
                                                    ?>
                                            </ul>
                                        </div>



                                        

                                        




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>