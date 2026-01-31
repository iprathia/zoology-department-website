<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header("Location: login.php"); // login page
  exit();
}
?>

<!DOCTYPE html>
<html lang="hi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Zoology</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
      body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        font-family: "Poppins", sans-serif;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #fff;
      }
      .navbar {
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(8px);
      }
      .navbar-brand {
        font-weight: 700;
        background: linear-gradient(90deg, #22d3ee, #818cf8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 1.6rem;
      }

      label {
        color: #93c5fd;
        font-weight: 600;
      }

      footer {
        text-align: center;
        padding: 15px;
        background: rgba(0, 0, 0, 0.9);
        color: #cbd5e1;
        font-size: 1rem;
        margin-top: auto;
      }

      /* Modal Styling */
      .modal-content {
        background: linear-gradient(145deg, #0f172a, #1e293b);
        color: #e2e8f0;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.4);
      }
      .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }
      .modal-title {
        background: linear-gradient(90deg, #22d3ee, #818cf8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
      }
      .modal-body h3 {
        color: #93c5fd;
      }
      .step {
        margin-bottom: 15px;
      }

      html,
      body {
        height: 100%;
        margin: 0;
        font-family: "Poppins", sans-serif;
      }

      body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: #f0f5fa;
      }

      main {
        flex: 1;
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
        z-index: 999;
      }

      .sidebar.active {
        left: 0;
      }

      .sidebar a {
        display: block;
        color: white;
        padding: 12px 20px;
        text-decoration: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .sidebar a:hover,
      .sidebar a.active {
        background-color: #00695c;
      }

      .logout {
        background-color: #c62828;
        text-align: center;
        font-weight: bold;
      }

      /* Footer */
      footer {
        background-color: #004d40;
        color: white;
        text-align: center;
        padding: 15px 0;
        margin-top: auto;
      }
      .hero {
        margin-top: 56px; /* navbar space */
      }

      .carousel-item img {
        height: 70vh;
        object-fit: cover;
      }

      .carousel-caption {
        bottom: 20%;
        text-shadow: 1px 1px 4px black;
      }

      #carousel-caption1 {
        bottom: 50%;
        text-shadow: 1px 1px 4px black;
      }
      .link1{
        text-decoration: none;
        color: #f0f5fa;
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
    <div class="sidebar" id="sidebar">
      <a href="teacher.php" class="active">🏠 होम</a>
      <a href="about.html">ℹ️ परिचय</a>
      <a href="faculty.html">👨‍🏫 शिक्षकगण</a>
      <a href="notes.html">📚 नोट्स</a>
      <a href="timetable.html">🕒 समय सारणी</a>
      <a href="gallery.html">📸 गैलरी</a>
      <a href="teacher_dashboard.php">👨‍🏫Admin</a>
       <a class="nav-link text-white" href="setting.php">👨‍🏫मेरा खाता</a>
     <a href="/zoology/index.html" class="btn btn-danger">Logout</a>
    </div>
   

    <main>
      <section id="home">
        <div
          id="zoologyCarousel"
          class="carousel slide"
          data-bs-ride="carousel"
        >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/zoology/img/img1.png" class="d-block w-100" alt="Zoology 1" />

              <div
                class="carousel-caption bg-dark bg-opacity-50 rounded"
                id="carousel-caption1"
              >
                <h1>
                  किरोडीमल शासकीय कला एवं विज्ञान महाविद्यालय (डिग्री कॉलेज
                  रायगढ़)
                </h1>
                <h3>
                  “हमारे कॉलेज में आपका स्वागत है — यहाँ शिक्षा केवल डिग्री
                  नहीं, बल्कि जीवन को दिशा देती है।”
                </h3>
              </div>

              <div class="carousel-caption bg-dark bg-opacity-50 rounded">
                <h3>Welcome to Department of Zoology</h3>
                <p>
                  प्रकृति और जीव-जंतुओं के अध्ययन की दुनिया में आपका स्वागत है।
                </p>
                <h1>Welcome To <?php echo $_SESSION['name']; ?></h1>
              </div>
            </div>

            <div class="carousel-item">
              <img src="/zoology/img/img2.png" class="d-block w-100" alt="Zoology 1" />
              <div class="carousel-caption bg-dark bg-opacity-50 rounded">
                <h3>Welcome to Department of Zoology</h3>
                <p>
                  प्रकृति और जीव-जंतुओं के अध्ययन की दुनिया में आपका स्वागत है।
                </p>
                <button type="button" class="btn btn-danger">
                 <a href="about.html" class="link1"> Explore Department</a>
                </button>
                <button type="button" class="btn btn-warning"><a href="gallery.html" class="link1">Lab</a></button>
              </div>
            </div>

            <div class="carousel-item">
              <img src="/zoology/img/img1.png" class="d-block w-100" alt="Zoology 2" />
              <div class="carousel-caption bg-dark bg-opacity-50 rounded">
                <h3>Modern Biology Lab</h3>
                <p>उन्नत प्राणिविज्ञान प्रयोगशालाएँ और अनुसंधान केंद्र।</p>
                <button type="button" class="btn btn-danger"><a href="gallery.html" class="link1">Events</a></button>
                <button type="button" class="btn btn-warning">
                  <a href="timetable.html" class="link1">Time Table</a>
                </button>
              </div>
            </div>

            <div class="carousel-item">
              <img src="/zoology/img/img3.png" class="d-block w-100" alt="Zoology 3" />
              <div class="carousel-caption bg-dark bg-opacity-50 rounded">
                <h3>Field Studies</h3>
                <p>प्राकृतिक जीवन और पर्यावरण का अध्ययन।</p>
                <button type="button" class="btn btn-danger"><a href="notes.html" class="link1">Notes</a></button>
                <button type="button" class="btn btn-warning"><a href="other.html" class="link1">Other</a></button>
              </div>
            </div>
          </div>

          <!-- Controls -->
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#zoologyCarousel"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#zoologyCarousel"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </section>
    </main>
    <div class="row g-4 pt-5">
      <div class="col-md-4 text-center">
        <img
          src="/zoology/img/m5.png"
          class="rounded-circle"
          width="120"
          alt=""
        />
        <h5>श्रीमती अनीता पांडे</h5>
        <p>प्रोफेसर </p>
      </div>
      <div class="col-md-4 text-center">
        <img
          src="/zoology/img/ranjana sahu.jpeg"
          class="rounded-circle"
          width="120"
          alt=""
        />
        <h5>श्रीमती रंजना साहू </h5>
        <p>प्रोफेसर </p>
      </div>
      <div class="col-md-4 text-center">
        <img
          src="/zoology/img/vinita pandey.jpeg"
          class="rounded-circle"
          width="120"
          alt=""
        />
        <h5>श्रीमती विनीता पाण्डेय </h5>
        <p>प्रोफेसर </p>
      </div>
    </div>

    <footer>© 2026 | Designed by ishwar </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
