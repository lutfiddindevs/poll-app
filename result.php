<?php
include 'functions.php';
// Connect to MySQL
$pdo = pdo_connect_mysql();
// If the GET request "id" exists (poll id)...
if (isset($_GET['id'])) {
    // MySQL query that selects the poll records by the GET request "id"
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the record
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the poll record exists with the id specified
    if ($poll) {
        // MySQL Query that will get all the answers from the "poll_answers" table ordered by the number of votes (descending)
        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ? ORDER BY votes DESC');
        $stmt->execute([$_GET['id']]);
        // Fetch all poll answers
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Total number of votes, will be used to calculate the percentage
        $total_votes = 0;
        foreach ($poll_answers as $poll_answer) {
            // Every poll answers votes will be added to total votes
            $total_votes += $poll_answer['votes'];
        }
    } else {
        die ('Poll with that ID does not exist.');
    }
} else {
    die ('No poll ID specified.');
}
?>

<?=template_header('Poll Results')?>

<div class="content poll-result">
    <h2><?=$poll['title']?></h2>
    <p><?=$poll['description']?></p>
    <div class="wrapper">
        <?php foreach ($poll_answers as $poll_answer): ?>
            <div class="poll-question">
                <p><?=$poll_answer['title']?> <span>(<?=$poll_answer['votes']?> Votes)</span></p>
                <div class="result-bar" style= "width:<?=@round(($poll_answer['votes']/$total_votes)*100)?>%">
                    <?=@round(($poll_answer['votes']/$total_votes)*100)?>%
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>
