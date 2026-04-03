<?php include('partials/_header_revised.php') ?>
<?php session_start();
if (!isset($_SESSION['uid']) || $_SESSION['role'] != 'teacher') {
    header('Location: ../errors/error.html');
    exit();
}
?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="smart-quiz" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <?php include("partials/_navbar.php"); ?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Smart Quiz Generator</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Tools</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-bulb'></i>
                    <h3>Generate Quiz</h3>
                </div>
                
                <div class="mt-3">
                    <label>Enter Topic:</label>
                    <input type="text" id="quiz-topic" class="form-control" placeholder="e.g., Photosynthesis or World War 2" required>
                    <button class="btn btn-primary mt-3" onclick="generateQuiz()">Generate Quiz</button>
                    <div id="quiz-loading" class="mt-3 text-primary" style="display:none;font-weight:bold;">
                        <i class='bx bx-loader bx-spin'></i> Generating smart assessment...
                    </div>
                </div>
                
                <div id="quiz-result" class="mt-4 p-3 bg-light border rounded" style="display:none;"></div>
            </div>
        </div>
    </main>
</div>

<script>
function generateQuiz() {
    var topic = document.getElementById("quiz-topic").value;
    if(!topic) return;
    
    document.getElementById("quiz-loading").style.display = "block";
    document.getElementById("quiz-result").style.display = "none";
    
    fetch("smart-quiz-backend.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "topic=" + encodeURIComponent(topic)
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById("quiz-loading").style.display = "none";
        document.getElementById("quiz-result").style.display = "block";
        if(data.quiz) {
            document.getElementById("quiz-result").innerHTML = data.quiz;
        } else {
            document.getElementById("quiz-result").innerHTML = "<div class='text-danger'>Error: " + data.error + "</div>";
        }
    })
    .catch(e => {
        document.getElementById("quiz-loading").style.display = "none";
        document.getElementById("quiz-result").style.display = "block";
        document.getElementById("quiz-result").innerHTML = "<div class='text-danger'>Network or format error occurred.</div>";
    });
}
</script>

<?php include("partials/_footer.php"); ?>
