<?php
$conn = mysqli_connect("localhost","root","","zoology");

$result = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="hi">
<head>
  <meta charset="UTF-8">
  <title>Contact Messages</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  <style>
    table {
      width: 80%;
      margin:40px;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #333;
      padding: 8px;
    }
    th {
      background: #0d6efd;
      color: white;
    }
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

body {
  background: #eef3ff;
  font-family: 'Poppins', sans-serif;
  display: flex;
  flex-direction: column;
}

/* Navbar */
.navbar {
  background-color: #004d40;
  color: white;
  padding: 10px;
}

.navbar-brand {
  color: white !important;
  font-weight: 600;
}

#sidebarToggle {
  background-color: white;
  border: none;
  color: #004d40;
  font-size: 20px;
  padding: 5px 10px;
  border-radius: 5px;
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  left: -250px;
  width: 250px;
  height: 100%;
  background-color: #00332c;
  color: white;
  padding-top: 60px;
  transition: all 0.3s;
  z-index: 1;
}

.sidebar.active { left: 0; }

.sidebar a {
  display: block;
  color: white;
  padding: 12px 20px;
  text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

.sidebar a:hover, .sidebar a.active {
  background-color: #00695c;
}

.logout {
  background-color: #c62828;
  text-align: center;
  font-weight: bold;
}

/* Main Content */
main {
  flex: 1;          /* Important → pushes footer to bottom */
  padding: 80px 20px 20px; 
}
/* Card Design */
.card-custom {
  border-radius: 12px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

/* Footer */
footer {
  background: #0d6efd;
  padding: 10px;
  color: white;
  text-align: center;
  margin-top: auto;
}
</style>
</head>

<body>
 <nav class="navbar fixed-top">
  <div class="container-fluid">
    <button id="sidebarToggle">☰</button>
    <a class="navbar-brand ms-2" href="#">Zoology Dept.</a>
    
  </div>
</nav>
<!-- ▣ Sidebar -->
<div class="sidebar" id="sidebar">
  <h4 class="text-center mb-4">👨‍🏫 Teacher Panel</h4>

  <a href="teacher_dashboard.php" onclick="showSection('dashboard')" id="link"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="teacher_dashboard.php" onclick="showSection('uploadNotes')"id="link1"><i class="bi bi-upload"></i> Upload Notes</a>
  <a href="teacher_dashboard.php" onclick="showSection('studentsList')"id="link2"><i class="bi bi-people"></i> Students</a>
  <a href="teacher_dashboard.php" onclick="showSection('smsPage')"id="link3"><i class="bi bi-chat-left-text"></i> Send SMS</a>
  <a href="teacher_dashboard.php" onclick="showSection('noticePage')"id="link5"><i class="bi bi-megaphone"></i> Post Notice</a>
  <a href="/zoology/teacher/view_messages.php"><i class="bi bi-gear"></i>Student SMS</a>
  <a href="teacher_dashboard.php" onclick="showSection('settings')"id="link6"><i class="bi bi-gear"></i> Settings</a>
  <a href="teacher.php" class="mt-3"id="link7"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<h2 style="text-align:center;">📩 Contact Messages</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Message</th>
  </tr>

  <?php while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['message']; ?></td>
  </tr>
  <?php } ?>

</table>
<footer>
  © 2026 SMS Portal | Zoology Department
</footer>

<script src="script.js"></script>
<script>
  const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("sidebarToggle");

if (toggleBtn) {
  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
  });
}
</script>
</body>
</html>
