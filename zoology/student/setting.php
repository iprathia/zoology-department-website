<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header("Location: login.php"); // login page
  exit();
}

$name = $_SESSION['user_name'];
$email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="theme.css">
<script src="theme.js" defer></script>
    <style>
/* Dark mode styles */
.dark-mode {
    background-color: #121212;
    color: #ffffff;
}

.dark-mode .card {
    background-color: #1e1e1e;
    color: #ffffff;
}

.dark-mode .btn {
    background-color: #333;
    color: #fff;
    border: none;
}
</style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">⚙️ Account Settings</h2>

   <!-- Profile Info -->
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">🧑 Profile Information</h5>

        <!-- Static view -->
        <div id="profileView">
            <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            
            <a href="update_profile.php" class="btn btn-primary  btn-sm">Edit Profile</a>
        </div>


    </div>
</div>


    <!-- Change Password -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">🔒 Change Password</h5>
            <a href="change_password.php" class="btn btn-warning btn-sm">Change Password</a>
        </div>
    </div>

    <!-- Theme Setting 
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">🌗 Theme</h5>
            <button class="btn btn-secondary btn-sm" onclick="alert('Dark/Light mode coming soon!')">Toggle Theme</button>
        </div>
    </div>-->

    <!-- Theme Setting -->
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">🌗 Theme</h5>
       <!-- सिर्फ एक पेज पर Toggle Button -->
<button class="btn btn-secondary btn-sm" onclick="toggleTheme()">Toggle Theme</button>

    </div>
</div>

<script>
// Toggle dark/light class on body
function toggleTheme() {
    const body = document.body;
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme === 'dark') {
        body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
    } else {
        body.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark');
    }
}

// Load theme on page load
window.onload = function() {
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }
};
</script>




    <!-- Language Setting -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">🌐 Language</h5>
            <select class="form-select w-50">
                <option selected>English</option>
                <option>Hindi</option>
                <option>Spanish</option>
            </select>
        </div>
    </div>

    <!-- Logout -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">🚪 Logout</h5>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</div>
<script>
    <script>
function showEditForm() {
    document.getElementById('profileView').style.display = 'none';
    document.getElementById('editForm').style.display = 'block';
}

function cancelEdit() {
    document.getElementById('editForm').style.display = 'none';
    document.getElementById('profileView').style.display = 'block';
}
</script>

</script>
</body>
</html>
