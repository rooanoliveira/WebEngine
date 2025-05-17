<?php
/**
 * CabalEngine CMS
 *
 * @version 1.0.0 / Based on WebEngine 1.2.6 by Lautaro Angelico <http://webenginecms.com/>
 * @Mod author Rooan Oliveira / Original author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2025 Lautaro Angelico, All Rights Reserved
 *
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

echo '<h1 class="page-header">Credit Manager</h1>';

$creditSystem = new CreditSystem();

if(isset($_POST['creditsconfig'], $_POST['identifier'], $_POST['credits'], $_POST['transaction'])) {
	try {
		$creditSystem->setConfigId($_POST['creditsconfig']);
		$creditSystem->setIdentifier($_POST['identifier']);
		switch($_POST['transaction']) {
			case 'add':
				$creditSystem->addCredits($_POST['credits'], $_POST['creditsbonus'] ?? 0);
				message('success', 'Transaction completed.');
				break;
			case 'subtract':
				$creditSystem->substractCredits($_POST['credits']);
				message('success', 'Transaction completed.');
				break;
			default:
				throw new Exception("Invalid transaction.");
		}
	} catch (Exception $ex) {
		message('error', $ex->getMessage());
	}
}

echo '<div class="row">';
	echo '<div class="col-md-4">';

		echo '<div class="panel panel-primary">';
		echo '<div class="panel-heading">Add/Subtract Credits</div>';
		echo '<div class="panel-body">';

			echo '<form role="form" method="post">';
				echo '<div class="form-group">';
					echo '<label>Credit Type:</label>';
					echo $creditSystem->buildSelectInput("creditsconfig", 1, "form-control");
				echo '</div>';
				echo '<div class="form-group">';
					echo '<label for="identifier1">UserNum:</label>';
					echo '<input type="text" class="form-control" id="identifier1" name="identifier" placeholder="UserNum">';
				echo '</div>';
				echo '<div class="form-group">';
					echo '<label for="credits1">Cash Value:</label>';
					echo '<input type="number" class="form-control" id="credits1" name="credits" placeholder="0">';
				echo '</div>';
				echo '<div class="form-group">';
					echo '<label for="credits2">Cash Bonus Value(s):</label>';
					echo '<input type="number" class="form-control" id="credits2" name="creditsbonus" placeholder="0">';
				echo '</div>';
				echo '<div class="radio">';
					echo '<label>';
						echo '<input type="radio" name="transaction" value="add" checked> Add';
					echo '</label>';
				echo '</div>';
				echo '<div class="radio">';
					echo '<label>';
						echo '<input type="radio" name="transaction" value="subtract"> Subtract';
					echo '</label>';
				echo '</div>';
				echo '<button type="submit" class="btn btn-default">Go</button>';
			echo '</form>';

		echo '</div>';
		echo '</div>';

	echo '</div>';
	echo '<div class="col-md-8">';

		echo '<div class="panel panel-default">';
		echo '<div class="panel-heading">Logs</div>';
		echo '<div class="panel-body">';
			$creditsLogs = $creditSystem->getLogs();
			if(is_array($creditsLogs)) {
				echo '<table id="credits_logs" class="table table-condensed table-hover">';
				echo '<thead>';
					echo '<tr>';
						echo '<th>Credit Type</th>';
						echo '<th>UserNum</th>';
						echo '<th>Cash</th>';
						echo '<th>Cash Bonus</th>';
						echo '<th>Transaction</th>';
						echo '<th>Date</th>';
						echo '<th>Module</th>';
						echo '<th>Ip</th>';
						echo '<th>AdminCP</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				foreach($creditsLogs as $data) {

					$in_admincp = ($data['log_inadmincp'] == 1 ? '<span class="label label-success">yes</span>' : '<span class="label label-default">No</span>');
					$transaction = ($data['log_transaction'] == "add" ? '<span class="label label-success">Add</span>' : '<span class="label label-danger">Subtract</span>');

					echo '<tr>';
						echo '<td>'.$data['log_config'].'</td>';
						echo '<td>'.$data['log_identifier'].'</td>';
						echo '<td>'.$data['log_credits'].'</td>';
						echo '<td>'.$data['log_creditsbonus'].'</td>';
						echo '<td>'.$transaction.'</td>';
						echo '<td>'.date("Y-m-d H:i", $data['log_date']).'</td>';
						echo '<td>'.$data['log_module'].'</td>';
						echo '<td>'.$data['log_ip'].'</td>';
						echo '<td>'.$in_admincp.'</td>';
					echo '</tr>';
				}
				echo '</tbody>';
				echo '</table>';
			} else {
				message('warning', 'There are no logs to display.');
			}
		echo '</div>';
		echo '</div>';

	echo '</div>';
echo '</div>';

// Script para ativar/desativar o campo de bônus
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
	const radios = document.querySelectorAll('input[name="transaction"]');
	const bonusInput = document.querySelector('input[name="creditsbonus"]');

	function toggleBonusInput() {
		const selected = document.querySelector('input[name="transaction"]:checked');
		if (selected && selected.value === 'subtract') {
			bonusInput.value = '';
			bonusInput.disabled = true;
		} else {
			bonusInput.disabled = false;
		}
	}

	// Inicializa no carregamento da página
	toggleBonusInput();

	// Adiciona listeners de mudança nos radios
	radios.forEach(function(radio) {
		radio.addEventListener('change', toggleBonusInput);
	});
});
</script>
