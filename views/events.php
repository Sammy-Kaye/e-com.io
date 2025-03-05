<?php
// Start the session at the beginning
session_start(); // Start session to store cart data

include '../includes/header.php';
include_once '../database/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}
else {
    $user_name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
}

// Fetch events from the database
$sql = "SELECT * FROM events ORDER BY date ASC";
$result = $conn->query($sql);
?>

<div class="container">
    <h1>Upcoming Events</h1>

    <div class="events-grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="event-card">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($row['date']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>

                    <button class="btn btn-success register-btn" data-event-id="<?php echo $row['event_id']; ?>" data-event-name="<?php echo htmlspecialchars($row['name']); ?>">Register</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-events">No upcoming events at the moment. Check back later!</p>
        <?php endif; ?>
    </div>
</div>

<!-- Custom modal for registration confirmation -->
<div id="registration-modal" class="registration-modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h3>Registration Confirmation</h3>
        <p id="registration-message"></p>
    </div>
</div>

<link rel="stylesheet" href="../assets/css/events.css"> <!-- Link to the events CSS file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
<style>
    /* Styles for the registration modal */
    .registration-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    .registration-modal .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border-radius: 5px;
        width: 50%;
        max-width: 500px;
        text-align: center;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .close-button {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
    }
    
    .close-button:hover {
        color: #2e7d32;
    }
    
    #registration-message {
        margin: 20px 0;
        font-size: 18px;
    }
</style>
<script>
    $(document).ready(function() {
        // Get user name from PHP
        const userName = <?php echo json_encode($user_name); ?>;
        
        $('.register-btn').click(function() {
            const eventId = $(this).data('event-id');
            const eventName = $(this).data('event-name');

            $.ajax({
                url: 'views/event_register.php',
                type: 'POST',
                data: { event_id: eventId },
                success: function(response) {
                    // Show the custom modal with user's name
                    $('#registration-message').text(`Thank you ${userName} for registering for "${eventName}"!`);
                    $('#registration-modal').css('display', 'block');
                    
                    // Set a timeout to redirect after 3 seconds
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 3000);
                },
                error: function() {
                    alert('An error occurred while registering. Please try again.');
                }
            });
        });
        
        // Close the modal when the close button is clicked
        $('.close-button').click(function() {
            $('#registration-modal').css('display', 'none');
            window.location.href = 'index.php';
        });
        
        // Close the modal when clicking outside of it
        $(window).click(function(event) {
            if ($(event.target).is('#registration-modal')) {
                $('#registration-modal').css('display', 'none');
                window.location.href = 'index.php';
            }
        });
    });
</script>

<?php include '../includes/footer.php'; ?>
