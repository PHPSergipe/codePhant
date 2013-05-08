// JavaScript Document
/*****************************************************
AGENCIA KAZOO - 2012 - http://www.agenciakazoo.com.br
Autores: Felipe Leão - http://www.felipeleao.com
Thiago Machado - tserram23@gmail.com
******************************************************/
var subOn;
/**********************
FUNÇÃO PRINCIPAL 
***********************/
$(function($){
	menu();
	cliqueMenu();
	socialMedia();
	if($('body').attr('id')==='indexPage'){
		$("body").ezBgResize({
			img     : "images/background01.jpg",
			center  : true
		});	
	}
	else if($('body').attr('id')==='kazooPage'){
		$("body").ezBgResize({
			img     : "images/background03.jpg",
			center  : true
		});	
		frases();
	}else if($('body').attr('id')==='portfolioPage'){
		$("body").ezBgResize({
				img     : "images/background02.jpg",
				center  : true
			});	
		toolTip();
		//verProjeto();
	}else if($('body').attr('id')==='contatoPage'){
		$("body").ezBgResize({
				img     : "images/background04.jpg",
				center  : true
			});	
		inputClick();
		optList();
		butFormHover();
	}else if($('body').attr('id')==='clippingPage'){
		$("body").ezBgResize({
				img     : "images/background05.jpg",
				center  : true
			});	
	}else if($('body').attr('id')==='clientePage'){
		$("body").ezBgResize({
				img     : "images/background05.jpg",
				center  : true
			});
			clienteHover();
	}
});
/**********************
MÁSCARA - DEFINE O TAMANHO DA TELA PARA QUE OS QUADRADOS OCUPEM TODO O ESPAÇO
***********************/
function mascara(){
	$('#maskScreen').height($(document).height());
}
/**********************
 MENU - SCRIPTS DO MENU PRINCIPAL (HOVER, CLICK, ETC)
***********************/
function menu(){
	$('.menuOpt').mouseover(function(){
		$(this).stop(true,true).animate({
				'color':'#575757'		
		},600);
	});
	$('.menuOpt').mouseout(function(){
			$(this).stop(true,true).animate({
				'color':'#B5B6AF'		
		},800);	
	});	
	$('.menuSub').mouseover(function(){
		$(this).stop(true,true).animate({
				'color':'#575757'		
		},500);
	});
	$('.menuSub').mouseout(function(){
			$(this).stop(true,true).animate({
				'color':'#B5B6AF'		
		},700);	
	});	
}
function cliqueMenu(){
	subOn = 0;
	var tamanho;
	$('#portfolio').click(function(){
		if(subOn == 0){
		tamanho = $('.subHolder').height();
		$('.menuSubHolder').stop(true,true).animate({
				'height':tamanho,
				'marginLeft':'40px'
		},600,'easeOutBounce');
		subOn = 1;
		$('#rodape').css('display','none');
		}else{
			closeSubMenu(tamanho);
			$('#rodape').css('display','block');
		}
	});
}
function closeSubMenu(tamanho){
	$('.menuSubHolder').stop(true,true).animate({
		'height':'0px',
		'marginLeft':'-20px'
	},400,'swing');
	subOn = 0;	
}
/**********************
 VER PROJETO - MOUSE OVER SOBRE A DIV <VER PROJETO>
**********************
function verProjeto(){
	$('.verProjeto').mouseenter(function(){
			$(this).stop(true,true).animate({
				'backgroundColor':'#989484'
			},300);
	});
	$('.verProjeto').mouseleave(function(){
			$(this).stop(true,true).animate({
				'backgroundColor':'#58585a'
			},500);
	});
}*/
/**********************
FORMULÁRIO - EFEITOS DA PÁGINA FORMULÁRIO
***********************/
function inputClick(){
	$('.campoForm').focusin(function(){
		$(this).stop(true,true).animate({
			'borderColor':'#D7D5A5'
		},300);						   
	});
	$('.campoForm').focusout(function(){
		$(this).stop(true,true).animate({
			'borderColor':'#58585a'
		},300);						   
	});
}
function optList(){
	$('.txtOptList,.verProjeto').mouseover(function(){
			$(this).stop(true,true).animate({
				'backgroundColor':'#fff',
				'color':'#333'
			},400);
	});
	$('.txtOptList,.verProjeto').mouseout(function(){
			$(this).stop(true,true).animate({
				'backgroundColor':'#58585a',
				'color':'#fff'
			},600);
	});
}
function butFormHover(){
	$('.botaoForm').mouseenter(function(){
		$(this).stop(true,true).animate({
			'color':'#808040'
		},200);
	});
	$('.botaoForm').mouseleave(function(){
		$(this).stop(true,true).animate({
			'color':'#000'
		},600);
	});
	$('#enviarMSG').click(function(){
		$('#enviarForm').click();
	});
	$('#limparMSG').click(function(){
		$('#limparForm').click();
	});
}
/**********************
EFEITO HOVER DOS CLIENTES (SOBE IMAGEM - ABRE A DIV)
***********************/
function clienteHover(){
	$('.clienteConteudo').mouseenter(function(){
			$(this).stop(true,true).animate({
					height:'290px'						
			},400,'swing');
	});
	$('.clienteConteudo').mouseleave(function(){
			$(this).stop(true,true).animate({
					height:'177px'						
			},400);
	});
	$('.imgCliente').mouseenter(function(){
			$(this).stop(true,true).animate({
					'marginTop':'-177px'
			},500,'swing');
	});
	$('.imgCliente').mouseleave(function(){
			$(this).stop(true,true).animate({
					'marginTop':'0px'
			},600,'swing');
	});
}
/**********************
FRASES - HOVER SOBRE AS IMAGENS DOS INTEGRANTES
***********************/
function frases(){
	 $('.holderBlackBox').infoBox({
        animation: ['bottom'],
        offsetX: 4,
        offsetY: -10,
        bottomPos: true
      });
}
/**********************
SIGA-NOS - HOVER SOBRE OS ÍCONES DAS REDES SOCIAIS
***********************/
function socialMedia(){
	$('.midiaSocial').mouseover(function(){
			if($(this).attr('id')==='_01'){
				socialIn('#twitter');
			}else if($(this).attr('id')==='_02'){
				socialIn('#facebook');
			}else if($(this).attr('id')==='_03'){
				socialIn('#youtube');
			}else if($(this).attr('id')==='_04'){
				socialIn('#flickr');
			}
	});
	$('.midiaSocial').mouseout(function(){
			if($(this).attr('id')==='_01'){
				socialOut('#twitter');
			}else if($(this).attr('id')==='_02'){
				socialOut('#facebook');
			}else if($(this).attr('id')==='_03'){
				socialOut('#youtube');
			}else if($(this).attr('id')==='_04'){
				socialOut('#flickr');
			}
	});
}
function socialIn(elemento){
	$(elemento).stop(true,true).animate({
		'marginTop':'-26px'	
	},400);
}
function socialOut(elemento){
	$(elemento).stop(true,true).animate({
		'marginTop':'0px'	
	},600);
}
/********************************
TOOLTIP QUE APARECE NOS SERVIÇOS
********************************/
function toolTip(){
	$('.icon').tinyTips('title');
}

/*****************************************
FUNÇÃO QUE CHAMA OS CLIENTES DO PORTIFÓLIO
*****************************************/
function xmlAjax(id){

  $string=/portfolio.php\b/;
  $result=$string.exec(location.href);
	
  if($result==null){
	location.href='/portfolio.php?client='+id;
  }else{
	$('.clientPort').css('display','none');
	$('.clientPort').remove();
	$('.loaderPort').fadeIn();
			  
	$.ajax({
		type: "GET",
		url: "xml/portifolio.xml",
		dataType: "xml",
		success: function(xml) {
			var $json=null;
			$('.loaderPort').css('display','none');
			$(xml).find('clientes cliente').each(function(){
				
				if ($(this).attr('id')==id){
					if ($(this).find('assunto').length){
						$json='<div class="clientPort"><div class="tituloAssunto">'+$(this).find('assunto').text()+'</div>';
					}
					if ($(this).find('titulo').length){
						$json+='<div class="tituloPortfolio">'+$(this).find('titulo').text()+'</div>';
					}
					if ($(this).find('descricao').length){
						$json+='<div class="textoBack"><span class="texto">'+$(this).find('descricao').text()+'</span></div>';
					}
					if ($(this).find('clientedesc').length){
						$json+='<div class="textoBack"><span class="texto">'+$(this).find('clientedesc').text()+'</span></div>';
					}
					if ($(this).find('cliente').length){
						$json+='<div class="textoBack"><span class="texto">'+$(this).find('cliente').text()+'</span></div>';
					}
					if ($(this).find('linkprojeto').length){
						$(this).find('linkprojeto').each(function(){
							$json+='<div class="verProjeto"><a href="'+$(this).text()+'" target="_blank">';
							if ($(this).attr('texto')!='' && typeof $(this).attr('texto')!='undefined'){
								$json+=$(this).attr('texto')+'</a></div><div class="clear"></div>';
							} else {
								$json+='ver projeto online</a></div><div class="clear"></div>';
							}
						});
					}
					
					$(this).find('post').each(function(){
						$json+='<div class="textoBack"><span class="texto">';
						$json+=$(this).find('textoBack').text()+'</span></div>';
						
						$(this).find('image').each(function(){
							if($(this).find('link').length){
								$json+='<div class="holderImagemPortfolio"><a class="lightbox" href="javascript:void(0);"';
								$json+='src="'+$(this).find('link').text()+'"><img src="';
								$json+=$(this).find('thumb').text()+'"/></a></div>';
							} else {
								$json+='<div class="holderImagemPortfolio"><img src="';
								$json+=$(this).find('thumb').text()+'"/></div>';
							}
						});
					});
					$json+='</div>';
				}
			});
			
			$('#conteudoPortfolio').append($json);
			$('.clientPort').fadeIn();
			$.lightBox('.lightbox',{'bgColor':'#faf6ef'});
			optList()
		}
	});
  }
}