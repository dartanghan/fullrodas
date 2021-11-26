<?php include("pages/libs.php") ?>

<?php
	$wheelCompanies = getCompaniesByType( 2 );
	$companies = getCompaniesByType( 1 );
?>
<html>
	<head>
		<script language="javascript" type="text/javascript" src="js/jquery-1.3.js"></script>
		<script language="javascript" type="text/javascript" src="js/ui/i18n/jquery.ui.i18n.all.js"></script>
		<script language="javascript" type="text/javascript" src="js/ui/jquery-ui-personalized-1.6rc5.min.js"></script>

		<link href="css/full.all.css" rel="stylesheet" type="text/css"/>

		<!-- javascript desta pagina -->
		<script language="javascript" type="text/javascript" src="js/index.js"></script>
	</head>
	<body >

		<div class="pageClass">
			<div id="headerPanel" class="headerPanel"></div>
			<div id="mainPanel" class="mainPanel" >
				<div id="selectorsContainer" class="selectorsContainer">
					<div style="top:5;" class="itemComponent" onclick="hideAll();$('#selectCar').show()">
						<div class="menuBotao botaoCarro"></div>
					</div>
					<div style="top:15;" class="itemComponent" onmouseup="hideAll();$('#selectWheel').show()">
						<div class="menuBotao botaoRoda"></div>
					</div>
				</div>

				<div id="contentPanel" class="contentPanel">
					<div id="carroContainer" class="carroContainerCSS">
						<div id="carroEdit" class="carroCSS">
							<div id="sombraEdit" class="sombraCSS"></div>
							<div id="rodaDianteiraEdit" class="rodaDianteiraCSS"></div>
							<div id="rodaTraseiraEdit" class="rodaTraseiraCSS"></div>
						</div>
					</div>
					<div style="position: relative;width: 450px">
						<div style="float: left;width:200px">
							<div onclick="rebaixa(false)" class="botaoFuncao botaoLevante" ></div>
							<div onclick="rebaixa(true)" class="botaoFuncao botaoRebaixe" ></div>
						</div>
						<div style="float: right;width:200px">
							<div onclick="aumentaPerfilPneu(false)" class="botaoFuncao botaoMaisPerfil" ></div>
							<div onclick="aumentaPerfilPneu(true)" class="botaoFuncao botaoMenosPerfil" ></div>
						</div>
					</div>
				</div>
				<br/>



			</div>

			<div id="footerPanel" class="footerPanel">rodape

			</div>
			<!--
				Partes automaticas...
				-->
			<!-- Menu de escolha de carro. -->
	        <div id="selectCar" style="position:absolute;left:150;top:150;display:none;width:600px;z-index:100" >
	            <ul>
	            	<!--  menus definidos por "li" -->
					<?php for( $i = 0 ; $i < sizeof($companies) ; $i++ ){ ?>
						<!-- vamos carregar um IFRAME -->
	                	<li><a href="productsFrame.php?type=car&position=174&company=<?php print $companies[$i][0]?>"><span> <?php print $companies[$i][1]?> </span></a></li>
	                <?php } ?>
	            </ul>
	        </div>
			<!-- menu de escolha de rodas -->
	        <div id="selectWheel" style="position:absolute;left:150;top:150;display:none;width:600px;z-index:100" >
	            <ul>
	            	<!--  menus definidos por "li" -->
					<?php for( $i = 0 ; $i < sizeof($wheelCompanies) ; $i++ ){ ?>
						<!-- vamos carregar um IFRAME -->
	                	<li><a href="productsFrame.php?type=wheel&position=174&company=<?php print $wheelCompanies[$i][0]?>"><span> <?php print $wheelCompanies[$i][1]?> </span></a></li>
	                <?php } ?>
	            </ul>
	        </div>
		</div>


	</body>
</html>