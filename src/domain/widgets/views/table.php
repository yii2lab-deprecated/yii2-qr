<?php

/**
 * @var $matrix array
 * @var $size integer
 * @var $margin integer
 */

?>

<table cellspacing="0" cellpadding="0" style="padding: 0; margin: <?= $size * $margin ?>px">

<?php

foreach($matrix as $line) {
	echo '<tr>';
	foreach($line as $cell) {
		?>
		<td
			height="<?= $size ?>"
			width="<?= $size ?>"
			style="line-height: 0; margin: 0; padding: 0; background-color: <?= ($cell ? 'black' : '') ?>"
		></td>
		<?php
	}
	echo '</tr>';
}
?>
</table>
