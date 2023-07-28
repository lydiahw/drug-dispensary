<?php
session_start();
require_once( "connection.php");

// Retrieve the user's ID from the session
$user_id = $_SESSION['user_id'];

// Retrieve the user's information from the database
$stmt = $conn->prepare("SELECT Name, Email, Address FROM doc_pat WHERE UserID = ?");
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
        $stmt = $conn->prepare("UPDATE doc_pat SET Name=?, Address=?, Email=? WHERE UserID=?");
        $stmt->bind_param("sssi", $name, $address, $email, $user_id);
        $stmt->execute();
        $stmt->close();

        // Update the user variable for displaying updated information
        $user['Name'] = $name;
        $user['Email'] = $email;
        $user['Address']=$address;
    }
}

?>

<!DOCTYPE html>
<html>
	<head>
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
		        <div class="logo">PillaRx</div>
		        <div class="buttons">
		            <form action="logout.php" method="post">
		            <button type="submit" class="logout-btn">Logout</button>
		            </form>
		        </div>
		    </nav>

			    <section class="main-content">
			    	<h2 class="topic">Doctor Bio</h2>
			      <div class="bio-section">
		            <div class="profile-picture">
		                <img src="images/avatar.png" alt="Profile Picture">
		            </div>

				        <div class="user-details">
							    <h2>Dr. <?php echo $user['Name']; ?></h2>
							    <p>Email: <?php echo $user['Email']; ?></p>
							    <p>Address: <?php echo $user['Address']; ?></p>
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

			<div class="categories">
			    <div class="category" onclick="toggleList('drug')">
			        <p class="category-name">Medicine</p>
			        <img class="category-image" src="images/image2.jpg">
			    </div>
			    <div class="category" onclick="toggleList('patient')">
			        <p class="category-name">Patients</p>
			        <img class="category-image" src="images/image3.jpg">
			    </div>
			</div>

			<div class="drug-list" id="drug-list">
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
			            echo "<tr><td colspan='4'>No drug found</td></tr>";
			        }

			        $stmt->close();
			        ?>
			    </table>
			</div>


			<div class="patient-list" id="patient-list">
			    <h2 class="topic">Patient List</h2>
			    <table>
			        <tr>
			            <th>Name</th>
			            <th>Age</th>
			            <th>Email</th>
			            <th>Address</th>
			        </tr>
			        <?php
			        $stmt1 = $conn->prepare("SELECT Name, Age, Email, Address FROM doc_pat WHERE Role = 'patient'");
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
			            echo "<tr><td colspan='4'>No patients found</td></tr>";
			        }

			        $stmt1->close();
			        ?>
			    </table>
			</div>









			  

			   

			   <div class="prescriptions">
	<h2 class="topic">Prescriptions</h2>

						<?php
						// Retrieve items from the "items" table
							  $sql = "SELECT * FROM doc_pat WHERE Role = 'patient'";
								$result = $conn->query($sql);
								$items = array();
								if ($result->num_rows > 0) {
								    while ($row = $result->fetch_assoc()) {
								        $items[] = $row;
								    }
								}


							$sql2 = "SELECT * FROM doc_pat WHERE Role = 'pharmacy'";
								$result2 = $conn->query($sql2);
								$items2 = array();
								if ($result2->num_rows > 0) {
								    while ($row = $result2->fetch_assoc()) {
								        $items2[] = $row;
								    }
								}

								$sql3 = "SELECT * FROM drug";
								$result3 = $conn->query($sql3);
								$items3 = array();
								if ($result3->num_rows > 0) {
								    while ($row = $result3->fetch_assoc()) {
								        $items3[] = $row;
								    }
								}

								$conn->close();	



						?>



	<button id="showFormButton">+ Add a new prescription</button>
<form id="myForm" class="myForm" style="display: none;" action="prescription.php" method="POST">
    <div class="form-group">
        <label for="patient-name">Patient Name:</label>
        <select name="patient-name" id="patient-name" class="form-control">
            <option value="">Select patient</option>
            <?php foreach ($items as $item) { ?>
                <option value="<?php echo $item['Name']; ?>"><?php echo $item['Name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="drug-name">Drug Name:</label>
        <select name="drug-name" id="drug-name" class="form-control">
            <option value="">Select drug</option>
            <?php foreach ($items3 as $item) { ?>
                <option value="<?php echo $item['Name']; ?>"><?php echo $item['Name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="frequency">Frequency:</label>
        <input type="text" name="frequency" id="frequency" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
    </div>

    <input type="hidden" name="doctor-name" value="<?php echo $_SESSION['name']; ?>">

    <button class="btn btn-primary">Prescribe</button>
</form>






			  
			</section>

			<footer>
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
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

function toggleCategory(category) {
        var drugList = document.getElementById('drug-list');
        var doctorList = document.getElementById('doctor-list');

       

    }


			<script>
			   function toggleEditForm() {
			  const editForm = document.querySelector('.edit-form');
			  editForm.classList.toggle('show');
			}

			

			function toggleList(category) {
  var drugList = document.getElementById('drug-list');
  var patientList = document.getElementById('patient-list');

   if (category === 'drug') {
        if (drugList.classList.contains('show')) {
            drugList.classList.remove('show');
        } else {
            drugList.classList.add('show');
            patientList.classList.remove('show'); // Hide the history list if it's visible
        }
    } else if (category === 'patient') {
        if (patientList.classList.contains('show')) {
            patientList.classList.remove('show');
        } else {
            patientList.classList.add('show');
            drugList.classList.remove('show'); // Hide the pending list if it's visible
        }
            
 
    }
}
const showFormButton = document.getElementById('showFormButton');
const myForm = document.getElementById('myForm');

showFormButton.addEventListener('click', function() {
    myForm.style.display = 'block';
    showFormButton.style.display = 'none';
});



			</script>
</div>
	</body>

</html>
