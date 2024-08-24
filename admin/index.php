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
    <h2>Welcome, <?php echo htmlspecialchars($admin_email); ?></h2>
    <p>This is the admin dashboard.</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<?php include('includes/footer.php'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow-y: scroll; /* Enable vertical scrolling */
    }

    .container {
        max-width: 100%; /* Adjust as per your design */
        padding: 30px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease;
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        animation: slideDown 0.5s ease;
    }

    p {
        margin-bottom: 30px;
    }

    .btn-danger {
        padding: 12px 20px;
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
        color: white;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: scale(1.05);
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

    @media (max-width: 768px) {
        .container {
            width: 90%; /* Responsive width for smaller screens */
        }
    }
</style>