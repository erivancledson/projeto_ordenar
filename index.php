<?php
try {
	$pdo = new PDO("mysql:dbname=projeto_ordenar;host=localhost", "root", "root");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
//ordem  = nome do select
if(isset($_GET['ordem']) && empty($_GET['ordem']) == false) {
	$ordem = addslashes($_GET['ordem']);
	$sql = "SELECT * FROM usuarios ORDER BY ".$ordem;
} else {
	$ordem = '';
	$sql = "SELECT * FROM usuarios";
}
?>
	<!--envia de forma automatica a opção escolhida onchange="this.form.submit()-->
<form method="GET">
	<select name="ordem" onchange="this.form.submit()">
		<option></option>
		<!--ordena pelo o nome -->
		<!--echo para manter o nome selecionado ou a idade -->
		<option value="nome" <?php echo ($ordem=="nome")?'selected="selected"':''; ?>>Pelo nome</option>
		<!--ordena pela idade -->
		<option value="idade" <?php echo ($ordem=="idade")?'selected="selected"':''; ?>>Pela idade</option>
	</select>
</form>

<table border="1" width="400">
	<tr>
		<th>Nome</th>
		<th>Idade</th>
	</tr>
	<?php
	

	$sql = $pdo->query($sql);
	if($sql->rowCount() > 0) {

		foreach($sql->fetchAll() as $usuario):
			?>

			<tr>
				<td><?php echo $usuario['nome']; ?></td>
				<td><?php echo $usuario['idade']; ?></td>
			</tr>

			<?php
		endforeach;

	}
	?>
</table>