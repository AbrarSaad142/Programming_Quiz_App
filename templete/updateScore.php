<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if score is set
    if (isset($data['score'])) {
        // Store the score in the session
        $_SESSION['score'] = $data['score'];
        
        // Return a success message
        echo json_encode(['status' => 'success', 'score' => $_SESSION['score']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Score not provided']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
