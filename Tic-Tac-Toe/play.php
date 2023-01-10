<?php
require_once "templates/header.php";

if (! playersRegistered()) {
    header("location: index.php");
}

if ($_POST['cell']) {
    $win = play($_POST['cell']);

    if ($win) {
        header("location: result.php?player=" . getTurn());
    }
}

if (playsCount() >= 9) {
    header("location: result.php");
}
?>

<form method="post" action="play.php">
    <table class="tic-tac-toe" cellpadding="0" cellspacing="0">
        <tbody>
        <?php
        $lastRow = 0;
        for ($i = 1; $i <= 25; $i++) {
            $row = ceil($i / 5);

            if ($row !== $lastRow) {
                $lastRow = $row;

                if ($i > 1) {
                    echo "</tr>";
                }

                echo "<tr class='row-{$row}'>";
            }
            $additionalClass = '';
           
            if ($i == 6 || $i == 24) {
                $additionalClass = 'vertical-border';
            }
            else if ($i == 8 || $i == 16) {
                $additionalClass = 'horizontal-border';
            }
            else if ($i == 9) {
                $additionalClass = 'center-border';
            }
            ?>
            <td class="cell-<?= $i ?> <?= $additionalClass ?>">
                <?php if (getCell($i) === 'x'): ?>
                    X
                <?php elseif (getCell($i) === 'o'): ?>
                    O
                <?php else: ?>
                    <input type="radio" name="cell" value="<?= $i ?>" onclick="enableButton()"/>
                <?php endif; ?>
            </td>

        <?php } ?>

        </tr>
        </tbody>
    </table>
    <h2><?php echo currentPlayer() ?>'s turn</h2>
    <button type="submit" disabled id="play-btn">Play</button>
  
</form>

<script type="text/javascript">
    function enableButton() {
        document.getElementById('play-btn').disabled = false;
    }
</script>

<?php
require_once "templates/footer.php";
