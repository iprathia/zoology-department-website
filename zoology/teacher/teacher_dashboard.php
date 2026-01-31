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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Dashboard | Zoology Department</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
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

  <a href="#" onclick="showSection('dashboard')" id="link"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="#" onclick="showSection('uploadNotes')"id="link1"><i class="bi bi-upload"></i> Upload Notes</a>
  <a href="#" onclick="showSection('studentsList')"id="link2"><i class="bi bi-people"></i> Students</a>
  <a href="#" onclick="showSection('smsPage')"id="link3"><i class="bi bi-chat-left-text"></i> Send SMS</a>
  <a href="#" onclick="showSection('noticePage')"id="link5"><i class="bi bi-megaphone"></i> Post Notice</a>
  <a href="/zoology/teacher/view_messages.php"><i class="bi bi-gear"></i>Student SMS</a>
  <a href="#" onclick="showSection('settings')"id="link6"><i class="bi bi-gear"></i> Settings</a>
  <a href="teacher.php" class="mt-3"id="link7"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- ▣ Main Content -->
 <main>
<!------------------------------ Dashboard ------------------------------->
<section id="dashboard" class="content-section">
  <h2>📊 Welcom To <?php echo $_SESSION['name']; ?></h2>

  <div class="row mt-3">
    <div class="col-md-4">
      <div class="card card-custom p-3 text-center">
        <h5>Total Uploaded Notes</h5>
        <h2 class="text-primary">6</h2>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-custom p-3 text-center">
        <h5>Total Students</h5>
        <h2 class="text-success">50</h2>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-custom p-3 text-center">
        <h5>Pending Messages</h5>
        <h2 class="text-danger">05</h2>
      </div>
    </div>
  </div>
<p class="paragrap"></p>
<div class="d-flex justify-content-end mb-3">
  <button class="btn btn-success"
          data-bs-toggle="modal"
          data-bs-target="#teachMoreModal">
    ➕ Add Chapter
  </button>
</div>
<!-- Add Chapter / Teach More Modal -->
<div class="modal fade" id="teachMoreModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">📘 Add / Teach Chapter</h5>
        <button type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
       <form id="chapterForm">

  <input type="text" id="chapter_no" class="form-control mb-2"
         placeholder="Chapter 1" required>

  <input type="text" id="chapter_title" class="form-control mb-2"
         placeholder="Cell Biology" required>

  <textarea id="chapter_desc" class="form-control mb-2"
            placeholder="Chapter description"></textarea>

  <input type="url" id="video_link" class="form-control mb-2"
         placeholder="YouTube link">

  <input type="file" id="notes_file" class="form-control mb-3"
         accept=".pdf,.doc,.docx">

  <button type="submit" class="btn btn-success w-100">
    ✅ Save Chapter
  </button>
</form>
      </div>

    </div>
  </div>
</div>


<h4 class="mt-4">📚 Uploaded Chapters</h4>

<div class="row" id="chapterList">
  <!-- New chapters will appear here -->
</div>


</section>
<!------------------------------ Upload Notes ------------------------------->
<section id="uploadNotes" class="content-section" style="display:none;">
  <h2>📚 Upload Study Notes</h2>

  <div class="card card-custom p-3 mt-3">
    <form id="notesForm">

      <label>Class</label>
      <select class="form-control mb-2" id="noteClass" required>
        <option value="">-- Select Class --</option>
        <option>Semester 1 </option>
        <option>Semester 2 </option>
        <option>Semester 3</option>
        <option>Semester 4 </option>
        <option>Semester 5 </option>
        <option>Semester 6 </option>
      </select>

      <label>Subject</label>
      <input class="form-control mb-2" id="noteSubject"
             placeholder="e.g., Zoology Chapter 1" required>

      <label>Upload PDF / DOC File</label>
      <input type="file" class="form-control mb-3"
             id="noteFile" accept=".pdf,.doc,.docx" required>

      <button type="submit" class="btn btn-primary w-100">
        Upload Notes
      </button>
    </form>
  </div>

  <h4 class="mt-4">📄 Uploaded Notes</h4>

  <table class="table table-bordered mt-2">
    <thead class="table-primary">
      <tr>
        <th>Class</th>
        <th>Subject</th>
        <th>File</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>

    <!-- ✅ tbody table के अंदर -->
    <tbody id="notesTableBody"></tbody>
  </table>
</section>

<script>
const notesForm = document.getElementById("notesForm");
const notesTableBody = document.getElementById("notesTableBody");
const noteClass = document.getElementById("noteClass");
const noteSubject = document.getElementById("noteSubject");
const noteFile = document.getElementById("noteFile");

/* Load notes on page load */
document.addEventListener("DOMContentLoaded", loadNotes);

/* Upload Note */
notesForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const file = noteFile.files[0];
  if (!file) return;

  const note = {
    id: Date.now(),
    className: noteClass.value,
    subject: noteSubject.value,
    fileName: file.name,
    fileUrl: URL.createObjectURL(file),
    date: new Date().toLocaleDateString()
  };

  let notes = JSON.parse(localStorage.getItem("notes")) || [];
  notes.push(note);
  localStorage.setItem("notes", JSON.stringify(notes));

  addNoteToTable(note);
  notesForm.reset();
});

/* Show notes */
function loadNotes() {
  let notes = JSON.parse(localStorage.getItem("notes")) || [];
  notes.forEach(addNoteToTable);
}

/* Add row in table */
function addNoteToTable(note) {
  const tr = document.createElement("tr");
  tr.id = "note-" + note.id;

  tr.innerHTML = `
    <td>${note.className}</td>
    <td>${note.subject}</td>
    <td>
      <a href="${note.fileUrl}" target="_blank">
        📄 ${note.fileName}
      </a>
    </td>
    <td>${note.date}</td>
    <td>
      <button class="btn btn-danger btn-sm"
        onclick="deleteNote(${note.id})">
        Delete
      </button>
    </td>
  `;

  notesTableBody.appendChild(tr);
}

/* Delete note */
function deleteNote(id) {
  let notes = JSON.parse(localStorage.getItem("notes")) || [];
  notes = notes.filter(note => note.id !== id);
  localStorage.setItem("notes", JSON.stringify(notes));

  document.getElementById("note-" + id).remove();
}
</script>


<!------------------------------ Students List ------------------------------->
<section id="studentsList" class="content-section" style="display:none;">
  <h2>👨‍🎓 Students List</h2>

  <button class="btn btn-success mb-3" onclick="toggleAddForm()">
    ➕ Add New Student
  </button>

  <div id="addStudentForm" class="card card-custom p-3 mb-3" style="display:none;">
    <h5>Add New Student</h5>
    <form id="studentForm"class="card p-3">

      <label>Student ID</label>
      <input type="text"
         class="form-control mb-2"
         name="id"
         placeholder="ST1001"
          id="sid" required>

      <label>Full Name</label>
      <input type="text"
         class="form-control mb-2"
         name="name"
         placeholder="Rahul Singh"
          id="sname" required>

      <label>Class</label>
      <select class="form-control mb-2" name="class" id="sclass" required>
        <option>Semester 1 </option>
        <option>Semester 2 </option>
        <option>Semester 3</option>
        <option>Semester 4 </option>
        <option>Semester 5 </option>
        <option>Semester 6 </option>
      </select>

      <label>Mobile Number</label>
      <input type="text"
         class="form-control mb-3"
         name="mobile"
         placeholder="9876543210" id="smobile" required>

      <button type="submit" class="btn btn-primary w-100">
    ➕ Add Student
  </button>
    </form>
  </div>

  <table class="table table-striped mt-3">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Class</th>
        <th>Mobile</th>
        <th>Action</th>
      </tr>
    </thead>

    <!-- ✅ tbody with id -->
    <tbody id="studentsTableBody"></tbody>
  </table>
</section>

<script>
document.addEventListener("DOMContentLoaded", loadStudents);

const studentForm = document.getElementById("studentForm");
const tableBody = document.getElementById("studentsTableBody");

// Show / Hide form
function toggleAddForm() {
  const form = document.getElementById("addStudentForm");
  form.style.display = form.style.display === "none" ? "block" : "none";
}

// Submit form
studentForm.addEventListener("submit", function(e){
  e.preventDefault();

  const student = {
    id: document.getElementById("sid").value,
    name: document.getElementById("sname").value,
    className: document.getElementById("sclass").value,
    mobile: document.getElementById("smobile").value
  };

  /* ✅ 1. Save in LocalStorage */
  let students = JSON.parse(localStorage.getItem("students")) || [];
  students.push(student);
  localStorage.setItem("students", JSON.stringify(students));

  /* ✅ 2. Save in MySQL using PHP */
  fetch("/zoology/add_student.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body:
      `id=${student.id}&name=${student.name}&class=${student.className}&mobile=${student.mobile}`
  })
  .then(res => res.text())
  .then(data => {
    if(data === "success"){
      console.log("Saved in MySQL");
    }else{
      alert("success Saved in MySQL");
    }
  });

  addStudentRow(student);
  studentForm.reset();
  toggleAddForm();
});

// Load students on refresh
function loadStudents(){
  let students = JSON.parse(localStorage.getItem("students")) || [];
  students.forEach(student => addStudentRow(student));
}

// Add row in table
function addStudentRow(student){
  const tr = document.createElement("tr");

  tr.innerHTML = `
    <td>${student.id}</td>
    <td>${student.name}</td>
    <td>${student.className}</td>
    <td>${student.mobile}</td>
    <td>
      <button class="btn btn-danger btn-sm"
        onclick="deleteStudent('${student.id}')">
        Delete
      </button>
    </td>
  `;

  tableBody.appendChild(tr);
}

// Delete student
function deleteStudent(id){
  let students = JSON.parse(localStorage.getItem("students")) || [];
  students = students.filter(s => s.id !== id);
  localStorage.setItem("students", JSON.stringify(students));
  location.reload();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




<!------------------------------ Send SMS ------------------------------->
<section id="smsPage" class="content-section" style="display:none;">
  <h2>📩 Send SMS to Students</h2>

  <div class="card card-custom p-3 mt-3">
   <form action="send_sms.php" method="POST">
  <label>Select Class</label>
  <select name="class" class="form-control mb-2" required>
    <option>Semester 1</option>
    <option>Semester 2</option>
    <option>Semester 3</option>
    <option>Semester 4</option>
    <option>Semester 5</option>
    <option>Semester 6</option>
  </select>

  <label>Message</label>
  <textarea name="message" class="form-control mb-3"
            placeholder="Type important message..." required></textarea>

  <button class="btn btn-success w-100">Send SMS</button>
</form>

  </div>
</section>


<!------------------------------ Post Notice ------------------------------->
<section id="noticePage" class="content-section" style="display:none;">
  <h2>📢 Post Notice / Announcement</h2>

  <!-- Notice Form -->
  <div class="card card-custom p-3 mt-3">
    <form id="noticeForm">
      <input class="form-control mb-2"
             id="noticeTitle"
             placeholder="Notice Title" required>

      <textarea class="form-control mb-3"
                id="noticeDesc"
                rows="4"
                placeholder="Notice Description..." required></textarea>

      <button class="btn btn-warning w-100">
        Post Notice
      </button>
    </form>
  </div>

  <!-- Posted Notices -->
  <h4 class="mt-4">📄 Posted Notices</h4>

  <div id="noticeList"></div>
</section>
<script>
const noticeForm = document.getElementById("noticeForm");
const noticeList = document.getElementById("noticeList");

/* Load notices on refresh */
document.addEventListener("DOMContentLoaded", loadNotices);

/* Post Notice */
noticeForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const notice = {
    id: Date.now(),
    title: noticeTitle.value,
    desc: noticeDesc.value,
    datetime: new Date().toLocaleString() // date + time
  };

  let notices = JSON.parse(localStorage.getItem("notices")) || [];
  notices.unshift(notice);
  localStorage.setItem("notices", JSON.stringify(notices));

  addNotice(notice);
  noticeForm.reset();
});

/* Load Notices */
function loadNotices() {
  let notices = JSON.parse(localStorage.getItem("notices")) || [];
  notices.forEach(addNotice);
}

/* Display Notice */
function addNotice(notice) {
  const div = document.createElement("div");
  div.className = "card card-custom p-3 mb-3";
  div.id = "notice-" + notice.id;

  div.innerHTML = `
    <h5 class="text-primary">${notice.title}</h5>
    <p>${notice.desc}</p>
    <small class="text-muted">
      📅 Posted on: ${notice.datetime}
    </small>
    <br>
    <button class="btn btn-sm btn-danger mt-2"
            onclick="deleteNotice(${notice.id})">
      Delete
    </button>
  `;

  noticeList.prepend(div);
}

/* Delete Notice */
function deleteNotice(id) {
  let notices = JSON.parse(localStorage.getItem("notices")) || [];
  notices = notices.filter(n => n.id !== id);
  localStorage.setItem("notices", JSON.stringify(notices));

  document.getElementById("notice-" + id).remove();
}
</script>



<!------------------------------ Settings ------------------------------->
<section id="settings" class="content-section" style="display:none;">
  <h2>⚙️ Account Settings</h2>

  <div class="card card-custom p-3 mt-3">
    <label>Name</label>
    <input class="form-control mb-2" value="Dr. Anil Sharma">

    <label>Email</label>
    <input class="form-control mb-2" value="anil.sharma@college.com">

    <label>Password</label>
    <input type="password" class="form-control mb-3" placeholder="••••••••">

    <button class="btn btn-primary w-100">Save Changes</button>
  </div>
</section>
 </main>

<footer>
  © 2025 Teacher Panel | Zoology Department
</footer>



<script>
function showSection(id) {
  document.querySelectorAll(".content-section").forEach(sec => sec.style.display = "none");
  document.getElementById(id).style.display = "block";
}

      const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("sidebarToggle");

if (toggleBtn) {
  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
  });
}


const link0 =  document.getElementById("link");
const link1 =  document.getElementById("link1");
const link2 =  document.getElementById("link2");
const link3 =  document.getElementById("link3");
const link4 =  document.getElementById("link4");
const link5 =  document.getElementById("link5");
const link6 =  document.getElementById("link6");
const link7 =  document.getElementById("link7");
let alllink =[link0,link1,link2,link3,link4,link5,link6,link7];
for(let i = 0; i<=7; i++)
{
if (alllink[i]) {
  alllink[i].addEventListener("click", () => {
    sidebar.classList.toggle("active");
  });
}
}


const chapterForm = document.getElementById("chapterForm");
const chapterList = document.getElementById("chapterList");

document.addEventListener("DOMContentLoaded", loadChapters);

// Submit form
chapterForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const fileInput = document.getElementById("notes_file");
  let fileData = null;

  if (fileInput.files.length > 0) {
    const file = fileInput.files[0];
    fileData = {
      name: file.name,
      url: URL.createObjectURL(file)
    };
  }

  const chapter = {
    id: Date.now(),
    number: chapter_no.value,
    title: chapter_title.value,
    desc: chapter_desc.value,
    video: video_link.value,
    file: fileData
  };

  saveChapter(chapter);
  addChapterToPage(chapter);

  chapterForm.reset();
  bootstrap.Modal.getInstance(
    document.getElementById("teachMoreModal")
  ).hide();
});

// Save
function saveChapter(chapter) {
  let chapters = JSON.parse(localStorage.getItem("chapters")) || [];
  chapters.push(chapter);
  localStorage.setItem("chapters", JSON.stringify(chapters));
}

// Load
function loadChapters() {
  let chapters = JSON.parse(localStorage.getItem("chapters")) || [];
  chapters.forEach(ch => addChapterToPage(ch));
}

// Delete
function deleteChapter(id) {
  let chapters = JSON.parse(localStorage.getItem("chapters")) || [];
  chapters = chapters.filter(ch => ch.id !== id);
  localStorage.setItem("chapters", JSON.stringify(chapters));
  document.getElementById("chapter-" + id).remove();
}

// UI Card
function addChapterToPage(chapter) {
  const col = document.createElement("div");
  col.className = "col-md-3 mb-3";
  col.id = "chapter-" + chapter.id;

  col.innerHTML = `
    <div class="card shadow-sm h-100">
      <div class="card-body d-flex flex-column">
        <h5>${chapter.number}</h5>
        <strong>${chapter.title}</strong>
        <p class="small">${chapter.desc || ""}</p>

        ${chapter.video ? `
          <a href="${chapter.video}" target="_blank"
             class="btn btn-sm btn-outline-primary mb-1">
             ▶ Video
          </a>` : ""}

        ${chapter.file ? `
          <a href="${chapter.file.url}" target="_blank"
             class="btn btn-sm btn-outline-success mb-1">
             📄 ${chapter.file.name}
          </a>` : ""}

        <button onclick="deleteChapter(${chapter.id})"
          class="btn btn-sm btn-danger mt-auto">
          🗑 Delete
        </button>
      </div>
    </div>
  `;

  chapterList.appendChild(col);
}

</script>

</body>
</html>
