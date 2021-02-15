<?php
include 'functions.php';
// connect to the database
$pdo = pdo_connect_mysql();
// MySQL query that selects all the polls and poll answers
$stmt = $pdo->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id');
$polls = $stmt->fetchAll();
?>

<?=template_header('Polls')?>

<div class="content home">
    <h2>Polls</h2>
    <p>Welcome to the index page, you can view the list of polls below.</p>
    <a href="create.php" class="create-poll">Create Poll</a>
    <table>
        <thead>
        <tr>
            <td>#</td>
            <td>Title</td>
            <td>Answers</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($polls as $poll): ?>
            <tr>
                <td><?=$poll['id']?></td>
                <td><?=$poll['title']?></td>
                <td><?=$poll['answers']?></td>
                <td class="actions">
                    <a href="vote.php?id=<?=$poll['id']?>" class="view" title="View Poll"><i class="fas fa-eye fa-xs"></i></a>
                    <a href="delete.php?id=<?=$poll['id']?>" class="trash" title="Delete Poll"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?=template_footer()?>
