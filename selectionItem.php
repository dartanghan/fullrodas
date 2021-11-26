<!--
	Esta pagina é usada para criar aquela tela
	de seleção de elementos.
	Sejam estes carros, rodas ou outros.
-->
<?php
	/**
	 * Monta uma tabela com tabs para a seleção dos produtos e companhias...
	 *
	 * $objectId: uma nome qualquer valido para representar os itens e subitens desta tabela de seleção
	 * $companies: array multidimensional com: codigo, nome, imagem...
	 * $selectedCompany: codigo da companhia
	 * $selectedProduct: codigo do produto
	 */
	function printProductPanel( $objectId , $companies, $selectedCompany, $selectedProduct ){?>
		<script language="javascript" type="text/javascript">
			var <?php echo $objectId?>SelCompany = '<?php echo $selectedCompany;?>';
			var <?php echo $objectId?>SelCompanyOld = '<?php echo $selectedCompany;?>';

			function selectCompany<?php echo $objectId?>( companyCode ){
				//vamos salvar a companhia anterior para voltar a cor..
				<?php echo $objectId?>SelCompanyOld = <?php echo $objectId?>SelCompany;
				// vamo definir a companhia atual...
				<?php echo $objectId?>SelCompany = companyCode;
				// carregando produtos...
				document.getElementById('<?php echo $objectId?>IFRAME').src='./pages/loadProducts.php?company='+companyCode;
				preSelectItems<?php echo $objectId?>();
			}

			function preSelectItems<?php echo $objectId?>(){
				//alert('<?php echo $objectId?>'+'Company');
				document.getElementById( '<?php echo $objectId?>Company'+<?php echo $objectId?>SelCompanyOld ).style.background='#ffffff' ;
				document.getElementById( '<?php echo $objectId?>Company'+<?php echo $objectId?>SelCompany ).style.background='#999999' ;
			}
		</script>
		<table id="<?php echo $objectId?>Table" border="1" width="400" height="400" cellpadding="0" cellspacing="0">
			<tr height="50">
				<?php for( $i = 0 ; $i < sizeof($companies) ; $i++ ){ ?>
					<td id="<?php echo $objectId."Company".$companies[$i][0]; ?>" width="50" align="center" valign="bottom" style="font-size:8;"
						onclick="selectCompany<?php echo $objectId?>('<?php echo $companies[$i][0] ?>')">
						<img src="<?php echo $companies[$i][2] ?>" />
						<?php echo $companies[$i][1] ?>
					</td>
				<?php } ?>
				<td/>
			</tr>
			<tr>
				<td colspan="<?php echo sizeof($companies)+1;?>">
					<iframe id="<?php echo $objectId?>IFRAME" src="" frameborder="0" width="100%" height="100%" ></iframe>
				</td>
			</tr>
		</table>

		<?php
	}
?>
