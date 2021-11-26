<?php
	include './pages/libs.php';
	include './selectionItem.php';

?>

<html>
	<title>
		Full rodas
	</title>
	<head>
		<script type="text/javascript" language="javascript">

			/**
			 * Neste metodo selecionamos qual painel
			 * será usado para exibição.
			 */
			var lastDisplayedPanelId;
			function enableSelectionPanel( idPanel ){
				if( lastDisplayedPanelId ){ // se tivermos previamente selecionado um painel
					document.getElementById( lastDisplayedPanelId ).style.display = 'none'	; // vamos desativá-lo
				}
				document.getElementById( idPanel ).style.display = ''; // vamos exibir o desejado
				lastDisplayedPanelId = idPanel; // no futuro poderemos desligá-lo...
			}

		</script>
	</head>
	<body>
		<!-- SESSAO DE COMPONENTES ABSOLUTE POSITION -->
		<div id="painelCarros" style="position:absolute;left:100;top:100;display:none">
		<?php
			$objectId = "carItem";
			$companies = array(
				array("001", "FIAT", "http://standpt.net/mk_img/fiat.jpg" ),
				array("002", "HONDA", "http://anunciautos.com.br/marcas_logo/honda.jpg" ),
				array("003", "CHEVROLLET", "" )
			);
			printProductPanel($objectId , $companies, "001" , -1);
		?>
		</div>
		<div id="painelRodas" style="display:none">
		<?php
			$objectIdRoda = "wheelItem";
			$companiesComp = array(
				array("011", "TSW", "http://standpt.net/amk_img/fiat.jpg" ),
				array("012", "MOMO", "http://anunciautosa.com.br/marcas_logo/honda.jpg" ),
				array("013", "BINO", "" )
			);
			printProductPanel($objectIdRoda , $companiesComp, "011" , -1);
		?>
		</div>
		<!-- FIM SESSAO DE COMPONENTES ABSOLUTE POSITION -->

		<table>

			<tr height="70">
				<td colspam="3"></td>
			</tr>
			<tr>
				<td width="120" valign="top">
					<a onclick="enableSelectionPanel( 'painelCarros' )">Carro</a>
					<br/>
					<a onclick="enableSelectionPanel( 'painelRodas' )">Roda</a>

				</td>
				<td>
				</td>
				<td></td>
			</tr>
			<tr>
				<td colspam="3"></td>
			</tr>
		</table>



	</body>
</html>
