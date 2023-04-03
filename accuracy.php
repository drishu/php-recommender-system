<?php

require_once './vendor/autoload.php';

use Drishu\RecommendationSystem\RecommendationStrategy\RandomGuessingStrategy;

$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = 'root';
$db_db = 'netflix';
$db_port = 8889;

// Create a connection to the database
$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
    $db_port
);

if ($mysqli->connect_errno) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
}

// Count the number of probes
$sql = "SELECT COUNT(*) AS count FROM probe";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$num_probes = $row['count'];

// Initialize the total and correct counts
$total_count = 0;
$correct_count = 0;

// Define the batch size
$batch_size = 1000;

// Create a new instance of the RandomGuessingStrategy class
$strategy = new RandomGuessingStrategy();

// Loop over the probes in batches
$sql = "SELECT * FROM probe LIMIT $batch_size";
$offset = 0;
while ($result = $mysqli->query($sql)) {
    // Check if there are any rows returned
    if ($result->num_rows == 0) {
        break;
    }

    // Loop over the rows in the batch
    while ($row = $result->fetch_assoc()) {
        $movie_id = $row['movie_id'];
        $user_id = $row['user_id'];
        $guess = $strategy->estimateUserRating($movie_id, $user_id, $mysqli);

        // Check if the guess matches the actual rating
        $sql2 = "SELECT rating FROM ratings WHERE movie_id = $movie_id AND user_id = $user_id";
        $result2 = $mysqli->query($sql2);
        if ($row2 = $result2->fetch_assoc()) {
            $rating = $row2['rating'];
            if ($guess == $rating) {
                $correct_count++;
            }
            $total_count++;
        }
    }

    // Update the offset and fetch the next batch
    $offset += $batch_size;
    $sql = "SELECT * FROM probe LIMIT $batch_size OFFSET $offset";

    // Display the progress bar
    $progress_percentage = $offset / $num_probes;
    $progress_bar_length = 30;
    $progress_bar = str_repeat('#', intval($progress_percentage * $progress_bar_length))
        . str_repeat(' ', $progress_bar_length - intval($progress_percentage * $progress_bar_length));

    printf("\r[%s] %d%%", $progress_bar, intval($progress_percentage * 100));
    flush();
}

// Compute the accuracy
if ($total_count > 0) {
    $accuracy = $correct_count / $total_count;
} else {
    $accuracy = 0;
}

// Print the accuracy
echo "\nRandom guesses were correct for $correct_count out of $total_count probes, with an accuracy of " . number_format($accuracy * 100, 2) . "%.";

// Close the database connection
$mysqli->close();
