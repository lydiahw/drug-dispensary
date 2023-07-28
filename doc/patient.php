<?php
session_start();
require_once( "connection.php");

// Retrieve the user's ID from the session
$user_id = $_SESSION['user_id'];

// Retrieve the user's information from the database
$stmt = $conn->prepare("SELECT Name, Email, Age, Address FROM doc_pat WHERE UserID = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Check if the form is submitted for profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form1_submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];

        // Update the user's information in the database
        $stmt = $conn->prepare("UPDATE doc_pat SET Name=?, Address=?,Age=?, Email=? WHERE UserID=?");
        $stmt->bind_param("sisi", $name, $age, $email, $user_id);
        $stmt->execute();
        $stmt->close();

        // Update the user variable for displaying updated information
        $name = $user['Name'];
        $user['Email'] = $email;
        $user['Age'] = $age;
        $user['Address'] = $address;

    }
}

?>

<!DOCTYPE html>
<html>
    <head>
         <!-- Meta tags and stylesheets -->            
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="doctor.css">
        <title>PillaRx</title>
    </head>
    <body>
            <div class="container">
                <nav>
                    <!-- Navigation bar content -->
                    <div class="logo">PillaRx</div>
                    <div class="buttons">
                        <form action="logout.php" method="post">
                        <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                </nav>
                
                    <section class="main-content">
                        <h2 class="topic">Patient Bio</h2>
                       <!-- User bio section content -->

                      <div class="bio-section">
                        <div class="profile-picture">
                            <img src="images/avatar.png" alt="Profile Picture">
                        </div>

                            <div class="user-details">
                                    <h2><?php echo $name; ?></h2>
                                    <p>Email: <?php echo $user['Email']; ?></p>
                                    <p>Age: <?php echo $user['Age']; ?></p>                               
                                    <p>Address: <?php echo $user['Address']; ?></p>
                                    <!-- Edit button and form for editing user details -->
                                    <button class="edit-button" onclick="toggleEditForm()">Edit</button>
                                    </div>

                           <div class="edit-form" style="display: none;">
                                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <input type="text" name="name" placeholder="Name">
                                        <br>
                                        <input type="text" name="age" placeholder="Age">
                                        <br>
                                        <input type="email" name="email" placeholder="Email">
                                        <br>
                                        <input type="text" name="address" placeholder="Address">
                                        <br>
                                        <button type="submit" name="form1_submit">Save</button>
                                                <button class="edit-button" onclick="toggleEditForm()">Edit</button>
                                         </form>
                                     </div>
                        </div>

                        <h2 class="topic">Categories</h2>
                         <!-- Categories for displaying Medicine and Doctors -->
                         <div class="categories">
                            <div class="category" onclick="toggleCategory('drug')">
                                <p class="category-name">Medicine</p>
                                <img class="category-image" src="images/image2.jpg">
                            </div>
                            <div class="category" onclick="toggleCategory('doctor')">
                                <p class="category-name">Doctors</p>
                                <img class="category-image" src="images/doc.png">
                            </div>
                        </div>

                        <div class="drug-list" id="drug-list">
                        <!-- Drug list table -->
                        <h2 class="topic">Drug List</h2>
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Total Volume</th>
                                    <th>Price</th>
                                </tr>
                                <?php
                                $stmt = $conn->prepare("SELECT Name, Type, Quantity, Price FROM drug");
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>".$row['Name']."</td>";
                                        echo "<td>".$row['Type']."</td>";
                                        echo "<td>".$row['Quantity']."</td>";
                                        echo "<td>".$row['Price']."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No drugs found</td></tr>";
                                }

                                $stmt->close();
                                ?>
                        </table>
                                                                </div>

                                                                <div class="doctor-list" id="doctor-list">
                                                                    <!-- Doctor list table -->
                                                                    <h2 class="topic">Doctor List</h2>
                                                                    <table>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Age</th>
                                                                            <th>Email</th>
                                                                            <th>Address</th>
                                                                        </tr>
                                                                        <?php
                                                                        $stmt1 = $conn->prepare("SELECT Name, Age, Email, Address FROM doc_pat WHERE Role = 'doctor'");
                                                                        $stmt1->execute();
                                                                        $result1 = $stmt1->get_result();

                                                                        if ($result1->num_rows > 0) {
                                                                            while ($row = $result1->fetch_assoc()) {
                                                                                echo "<tr>";
                                                                                echo "<td>".$row['Name']."</td>";
                                                                                echo "<td>".$row['Age']."</td>";
                                                                                echo "<td>".$row['Email']."</td>";
                                                                                echo "<td>".$row['Address']."</td>";
                                                                                echo "</tr>";
                                                                            }
                                                                        } else {
                                                                            echo "<tr><td colspan='4'>No doctors found</td></tr>";
                                                                        }

                                                                        $stmt1->close();
                                                                        ?>
                                                                    </table>
                                                                </div>


                                                    <h2 class="topic">Prescriptions</h2>
                                                     <!-- Categories for displaying Pending and History prescriptions -->

                                                                <div class="categories">
                                                                    <div class="category" onclick="togglePrescriptionCategory('pending')">

                                                                        <p class="category-name">Pending</p>
                                                                        <img class="category-image" src="images/work-in-progress.png">
                                                                    </div>
                                                                    <div class="category" onclick="togglePrescriptionCategory('history')">
                                                                                        <!-- List of history prescriptions -->

                                                                        <p class="category-name">History</p>
                                                                        <img class="category-image" src="images/folder.png">
                                                                    </div>
                                                                </div>



                                                                       <?php
                                                    $user_id = $_SESSION['user_id']; // Retrieve the user's ID from the session

                                                    // Retrieve the prescription data for the logged-in user
                                                    $sql = "SELECT p.PrescriptionID, d.Name AS DrugName, ud.Name AS DoctorName, up.Name AS PatientName, d.Quantity, p.Frequency, p.Total, p.Status,d.Type
                                                            FROM prescription p
                                                            INNER JOIN drug d ON p.DrugID = d.DrugID
                                                            INNER JOIN doc_pat ud ON p.DoctorID = ud.UserID
                                                            INNER JOIN doc_pat up ON p.PatientID = up.UserID
                                                            WHERE p.PatientID = ?";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->bind_param("i", $user_id);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();

                                                    // Check if there are any prescriptions
                                                    if ($result->num_rows > 0) {
                                                        // Display pending prescriptions table
                                                        echo "<div class='pending-list' id='pending-list'>";
                                                        echo "<h2 class='topic'>Pending Prescriptions</h2>";
                                                        echo "<table>";
                                                        echo "<tr>";
                                                        echo "<th>Drug Name</th>";
                                                        echo "<th>Type</th>";
                                                        echo "<th>Total Volume</th>";
                                                        echo "<th>Frequency</th>";
                                                        echo "<th>Price</th>";
                                                        echo "<th>Prescribed by</th>";
                                                        echo "</tr>";

                                                        // Loop through each prescription
                                                        while ($row = $result->fetch_assoc()) {
                                                            $prescriptionID = $row['PrescriptionID'];
                                                            $drugName = $row['DrugName'];
                                                            $doctorName = $row['DoctorName'];
                                                            $patientName = $row['PatientName'];
                                                            $quantity = $row['Quantity'];
                                                            $frequency = $row['Frequency'];
                                                            $total = $row['Total'];
                                                            $status = $row['Status'];
                                                            $type = $row['Type'];

                                                            // Process the prescription data based on the status
                                                            if ($status == 'Pending') {
                                                                echo "<tr>";
                                                                echo "<td>" . $drugName . "</td>";
                                                                echo "<td>" . $type . "</td>";
                                                                echo "<td>" . $quantity . "</td>";
                                                                echo "<td>" . $frequency . "</td>";
                                                                echo "<td>" . $total . "</td>";
                                                                echo "<td>" . $doctorName . "</td>";
                                                                echo "</tr>";
                                                            }
                                                        }

                                                        // Close the pending table
                                                        echo "</table>";
                                                        echo "</div>";

                                                        // Display history prescriptions table
                                                        echo "<div class='history-list' id='history-list'>";
                                                        echo "<h2 class='topic'>History</h2>";
                                                        echo "<table>";
                                                        echo "<tr>";
                                                        echo "<th>Drug Name</th>";
                                                        echo "<th>Type</th>";
                                                        echo "<th>Total Volume</th>";
                                                        echo "<th>Frequency</th>";
                                                        echo "<th>Price</th>";
                                                        echo "<th>Prescribed by</th>";
                                                        echo "</tr>";

                                                        // Reset the data pointer in the result set to fetch history prescriptions
                                                        $result->data_seek(0);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $prescriptionID = $row['PrescriptionID'];
                                                            $drugName = $row['DrugName'];
                                                            $doctorName = $row['DoctorName'];
                                                            $patientName = $row['PatientName'];
                                                            $quantity = $row['Quantity'];
                                                            $frequency = $row['Frequency'];
                                                            $total = $row['Total'];
                                                            $status = $row['Status'];
                                                            $type = $row['Type'];

                                                            // Process the prescription data based on the status
                                                            if ($status == 'Dispensed') {
                                                                echo "<tr>";
                                                                echo "<td>" . $drugName . "</td>";
                                                                echo "<td>" . $type . "</td>";
                                                                echo "<td>" . $quantity . "</td>";
                                                                echo "<td>" . $frequency . "</td>";
                                                                echo "<td>" . $total . "</td>";
                                                                echo "<td>" . $doctorName . "</td>";
                                                                echo "</tr>";
                                                            }
                                                        }

                                                        // Close the history table
                                                        echo "</table>";
                                                        echo "</div>";
                                                    } else
                                                    // Display a message if no prescriptions found for the user
                                                     {
                                                        echo "No prescriptions found for the logged-in user.";
                                                    }

                                                    $stmt->close();
                                                    ?>
                    </section>



                    <footer>
                        <!-- Contact Us section -->
                        <div class="contact-us" id="contact-us">
                        <h2 class="topic">Contact Us</h2>
                        <p style="text-align: center;margin-bottom:20px;">Do have any questions, comments or suggestions for PillaRx?<br>
                        Feel free to contact us on the platforms below and we will be more than happy to assist you.</p>
                        <div class="contact-categories">
                            <div class="contact-category">
                                <h3>Our Office</h3><hr>
                                <p>+254700001111</p><br>
                                <a class="link" href="mailto:info@pillarx.com">info@pillarx.com</a>
                                <p>Email Us Here</p><br><br>
                                <p>123 Westlands Square<br>10th Floor,Westie Building<br>Nairobi<br>0100</p>
                            </div>
                            <div class="contact-category message">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <h3>Say Hello</h3><hr>
                                    <input type="text" name="name" id="name" placeholder="Name">
                                    <input type="text" name="phone" id="phone" placeholder="Telephone">
                                    <input type="email" name="email" id="email"placeholder="Email">
                                    <textarea type="text" name="comment" id="comment" placeholder="Comment" rows="5" cols="10"></textarea>
                                    <button class="submit" name="form2_submit">Submit</button>
                                </form>
                            </div>
                            <div class="contact-category">
                                <h3>Keep Connected</h3><hr>
                                <a class="link" href="https://twitter.com" target="_blank">Twitter</a><br>
                                <a class="link" href="https://facebook.com" target="_blank">Facebook</a>
                            </div>
                        </div>
                        </div>
                </footer>

                <?php
                // PHP code for form submission
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                // Code for processing form1_submit
                 {
                    if (isset($_POST['form1_submit'])) {
                        $name = $_POST['name'];
                        $age = $_POST['age'];
                        $email = $_POST['email'];
                        $user_id = $_SESSION['user_id'];
                        $stmt = $conn->prepare("UPDATE doc_pat SET Name=?, Age=?, Email=?,Address=? WHERE UserID=?");
                        $stmt->bind_param("sssi", $name, $age, $email, $user_id); 
                        $stmt->execute();
                        $stmt->close();
                    }
                    // Code for processing form2_submit
                    elseif (isset($_POST['form2_submit'])) {
                        $name = $_POST['name'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $comment = $_POST['comment'];

                        $stmt = $conn->prepare("INSERT INTO comment(Name, Telephone, Email, Comment) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $name, $phone, $email, $comment);
                        $stmt->execute();
                        $stmt->close();
                        $conn->close();
                    }
                }
                ?>




                <script>
                                                            // JavaScript code for toggleEditForm function
                                                           function toggleEditForm() {
                                                          const editForm = document.querySelector('.edit-form');
                                                          editForm.classList.toggle('show');
                                                        }
                                                        // JavaScript code for toggleCategory function
                                                        function toggleCategory(category) {
                                                    var drugList = document.getElementById('drug-list');
                                                    var doctorList = document.getElementById('doctor-list');

                                                    if (category === 'drug') {
                                                    if (drugList.classList.contains('show')) {
                                                        drugList.classList.remove('show');
                                                    } else {
                                                        drugList.classList.add('show');
                                                        doctorList.classList.remove('show'); // Hide the history list if it's visible
                                                    }
                                                } else if (category === 'doctor') {
                                                    if (doctorList.classList.contains('show')) {
                                                        doctorList.classList.remove('show');
                                                    } else {
                                                        doctorList.classList.add('show');
                                                        drugList.classList.remove('show'); // Hide the pending list if it's visible
                                                    }
                                                        
                                             
                                                }

                                                }


                                              // JavaScript code for togglePrescriptionCategory function 
                                            function togglePrescriptionCategory(category) {
                                                var pendingList = document.getElementById('pending-list');
                                                var historyList = document.getElementById('history-list');
                                            if (category === 'pending') {
                                                    if (pendingList.classList.contains('show')) {
                                                        pendingList.classList.remove('show');
                                                    } else {
                                                        pendingList.classList.add('show');
                                                        historyList.classList.remove('show'); // Hide the history list if it's visible
                                                    }
                                                } else if (category === 'history') {
                                                    if (historyList.classList.contains('show')) {
                                                        historyList.classList.remove('show');
                                                    } else {
                                                        historyList.classList.add('show');
                                                        pendingList.classList.remove('show'); // Hide the pending list if it's visible
                                                    }
                                                }
                                                
                                            }
                </script>
            </div>
    </body>
</html>

<?php
require_once("connection.php");

// Retrieve the user's ID from the session
$user_id = $_SESSION['user_id'];

// Retrieve the user's information from the database
$stmt = $conn->prepare("SELECT Name, Email, Age, Address FROM doc_pat WHERE UserID = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Check if the form is submitted for profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form1_submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];

        // Update the user's information in the database
        $stmt = $conn->prepare("UPDATE doc_pat SET Name=?, Address=?, Age=?, Email=? WHERE UserID=?");
        $stmt->bind_param("ssisi", $name, $address, $age, $email, $user_id);
        $stmt->execute();
        $stmt->close();

        // Update the user variable for displaying updated information
        $user['Name'] = $name;
        $user['Email'] = $email;
        $user['Age'] = $age;
        $user['Address'] = $address;
    }
}
?>

    
                
                

               
            
           