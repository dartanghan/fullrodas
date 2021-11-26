
/*
 * Reduz a distancia das rodas
 * com o carro em 1px ou amplia-a.
 */
function rebaixa( rebaixar ){
	var rodaDi = document.getElementById("rodaDianteiraEdit");
	var rodaTr = document.getElementById("rodaTraseiraEdit");
	var sombra = document.getElementById("sombraEdit");

	var variavel = 1;
	if( rebaixar )
		variavel = variavel * -1;
	rodaDi.style.top = ( parseInt(rodaDi.style.top.substring(0,rodaDi.style.top.length-2)) +variavel)+'px';
	rodaTr.style.top = rodaDi.style.top ;
	sombra.style.top = ( parseInt(rodaDi.style.top.substring(0,rodaDi.style.top.length-2)) + 105)+'px';

}

/*
 * Forneça a roda e a
 * imagem do carro e aprecie =)
 */
function carregarCarro( imgCarro, eixoDiant, entreEixos, alturaEixo, imgRoda ){
	var carro = document.getElementById("carroEdit");
	var rodaDi = document.getElementById("rodaDianteiraEdit");
	var rodaTr = document.getElementById("rodaTraseiraEdit");
	var sombra = document.getElementById("sombraEdit");

	alturaEixo = alturaEixo - 20;

	carro.style.background = 'transparent url('+imgCarro+') no-repeat';

	rodaDi.style.top = alturaEixo+'px';
	rodaDi.style.left = eixoDiant+'px';

	rodaTr.style.top = (alturaEixo)+'px';
	rodaTr.style.left = (eixoDiant+entreEixos)+'px';

	sombra.style.top = alturaEixo+105+'px';

	if( imgRoda ){
		rodaDi.style.background = 'transparent url('+imgRoda+') no-repeat';
		rodaTr.style.background = 'transparent url('+imgRoda+') no-repeat';
	}
}

function carregarRoda( imgRoda , alturaEixo ){
	var rodaDi = document.getElementById("rodaDianteiraEdit");
	var rodaTr = document.getElementById("rodaTraseiraEdit");
	alturaEixo = alturaEixo - 20;
	rodaDi.style.background = 'transparent url('+imgRoda+') no-repeat';
	rodaTr.style.background = 'transparent url('+imgRoda+') no-repeat';

	if( alturaEixo ){
		rodaDi.style.top = alturaEixo+'px';
		rodaTr.style.top = alturaEixo+'px';
	}
}