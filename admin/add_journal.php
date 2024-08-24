<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Retrieve admin information if needed
$admin_id = $_SESSION['admin_id'];
$admin_email = $_SESSION['admin_email'];
?>
<?php include('includes/header.php'); ?>

<div class="container">
    <h2>Add Journal</h2>
    <form action="add_journal.php" method="POST">
        <div class="form-group">
            <label for="journal_name">Journal Name:</label>
            <input type="text" class="form-control" id="journal_name" name="journal_name" required>
        </div>
        <div class="form-group">
            <label for="issn">ISSN:</label>
            <input type="text" class="form-control" id="issn" name="issn" required>
        </div>
        <div class="form-group">
            <label for="editor_name">Editor Name:</label>
            <input type="text" class="form-control" id="editor_name" name="editor_name" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Journal</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('includes/db_connect.php');

    $journal_name = $_POST['journal_name'];
    $issn = $_POST['issn'];
    $editor_name = $_POST['editor_name'];
    $date = $_POST['date'];

    $sql = "INSERT INTO journals (journal_name, issn, editor_name, date) VALUES ('$journal_name', '$issn', '$editor_name', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>showToast('New journal added successfully.');</script>";
    } else {
        echo "<script>showToast('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>

<div id="toast" class="toast">Notification</div>

<?php include('includes/footer.php'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
    body {
        background-color: #f8f9fa;
        color: #333;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow-y: scroll;
    }

    .container {
        max-width: 600px;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: white;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .toast {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
        transition: visibility 0s, opacity 0.5s linear;
        opacity: 0;
    }

    .toast.show {
        visibility: visible;
        opacity: 1;
    }
</style>

<script>
    function showToast(message) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.className = 'toast show';
        setTimeout(() => { toast.className = toast.className.replace('show', ''); }, 3000);
    }
</script>