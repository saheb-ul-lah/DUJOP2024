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
    <h2>Edit Journal</h2>
    <?php
    include('includes/db_connect.php');

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $journal_id = $_POST['journal_id'];
        $journal_name = $_POST['journal_name'];
        $issn = $_POST['issn'];
        $editor_name = $_POST['editor_name'];
        $date = $_POST['date'];

        // Fetch current PDF filename from database
        $sql = "SELECT pdf FROM journals WHERE id='$journal_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $journal = $result->fetch_assoc();
            $current_pdf = $journal['pdf']; // Current PDF filename
        } else {
            echo "<p>No journal found with the specified ID.</p>";
            exit();
        }

        // Check if a new PDF file is uploaded
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
            $new_pdf = $_FILES['pdf']['name'];

            // Rename uploaded PDF file with current date and time
            $currentDateTime = date('Ymd_His');
            $target_dir = "uploads/";
            $target_file = $target_dir . $currentDateTime . '_' . basename($new_pdf);

            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $target_file)) {
                // Update PDF filename to new filename with datetime prefix
                $current_pdf = $currentDateTime . '_' . basename($new_pdf);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Update database with new journal information
        $sql = "UPDATE journals SET journal_name='$journal_name', issn='$issn', editor_name='$editor_name', date='$date', pdf='$current_pdf' WHERE id='$journal_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Journal updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
        }

        $conn->close();
    }

    // Fetch journal details for editing
    if (isset($_GET['id'])) {
        $journal_id = $_GET['id'];
        $sql = "SELECT * FROM journals WHERE id='$journal_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $journal = $result->fetch_assoc();
        } else {
            echo "<p>No journal found with the specified ID.</p>";
            exit();
        }
    } else {
        echo "<p>No journal selected to edit.</p>";
        exit();
    }
    ?>
    <form action="edit_journal.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="journal_id" value="<?php echo $journal['id']; ?>">
        <div class="form-group">
            <label for="journal_name">Journal Name:</label>
            <input type="text" class="form-control" id="journal_name" name="journal_name" value="<?php echo htmlspecialchars($journal['journal_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="issn">ISSN:</label>
            <input type="text" class="form-control" id="issn" name="issn" value="<?php echo htmlspecialchars($journal['issn']); ?>" required>
        </div>
        <div class="form-group">
            <label for="editor_name">Editor Name:</label>
            <input type="text" class="form-control" id="editor_name" name="editor_name" value="<?php echo htmlspecialchars($journal['editor_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($journal['date']); ?>" required>
        </div>
        <div class="form-group">
            <label for="pdf">Upload New PDF (if necessary):</label>
            <input type="file" class="form-control-file" id="pdf" name="pdf">
            <?php if ($journal['pdf']) : ?>
                <p>Current PDF: <a href="uploads/<?php echo htmlspecialchars($journal['pdf']); ?>" target="_blank"><?php echo htmlspecialchars($journal['pdf']); ?></a></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update Journal</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #333;
        margin: 0 0 120px 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow-y: scroll;
    }

    .container {
        max-width: 600px;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        animation: slideDown 0.5s ease;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 5px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: white;
        transition: background-color 0.3s, transform 0.2s;
        animation: fadeIn 0.5s ease 0.2s backwards;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .alert {
        margin-bottom: 20px;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    @keyframes slideDown {
        0% {
            transform: translateY(-20px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>