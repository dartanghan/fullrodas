<?php include("pages/libs.php") ?>
<?php
/*
 * Created on 16/02/2009
 *
 * Este frame é o conteúdo da aba selecionada =)
 */


	if( $_REQUEST['type'] == 'wheel' ){
		$productList = getWheelsByCompany( $_REQUEST['company'] );
		$image = true;
		$wheel = true;
	}else if( $_REQUEST['type'] == 'car' ){
		$productList = getCarsByCompany( $_REQUEST['company'] );
		$image = false;
		$wheel = false;
	}

?>
<table>
	<?php
		for( $i = 0 ; $i < sizeof($productList) ; $i++ ){
			if( $wheel ){ // se for roda o methodo a chamarmos será um....
				// vamos informar qual a roda e em qual posição será inserida.
				//carregarRoda( 'imagem', altura )
				$method = "parent.carregarRoda('".$productList[$i][2]."',".$_REQUEST['position'].");";
			}else{ // se nao for roda sera outro...
				// vamos informar qual carro e em qual posição será inserida.
				//carregarCarro( 'imagem', X_eixo_1 , Entre_eixos, altura_eixo )
				$method = "parent.carregarCarro('".$productList[$i][2]."',".$productList[$i][4].",".($productList[$i][5]-$productList[$i][4]).",".$productList[$i][6].");";
			}
			?>
			<TD onclick="<?php print $method?>;parent.hideAll()">
				<?php // devemos mostrar a image? apenas para a roda, sim.
					if ( $image ){ ?>
						<img src = "<?php print $productList[$i][2]?>"></img><br/>
				<?php
					}
					print $productList[$i][1]?>
			</TD>
	<?php
		} ?>
</table>
