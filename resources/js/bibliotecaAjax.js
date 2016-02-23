/**
 * Developed by: Thevelopment
 * Author: Carlos Alberto
 * Copyright 2014©
 */

/**
 * Biblioteca Ajax:
 * Contribuição do ajax de Ivan - EUNANET
 * Reformulado em prototype por Carlos - Versão 1.1
 * Esquema de controle de fila por: 
 *  - http://cmarshall.com/MySoftware/ajax/index.html
 * 
 * Como usar:
 * - instancie um objeto em uma variável com os parâmetros, Ex.: var obj = new Jax(pagina_Url,div_ID);
 * - com o objeto, chame os métodos Get ou Post, Ex.: obj.gjax(params) | obj.pjax(params)
 */
var Jax = function(constru_pag, constru_div) {
	this.constru_pag = constru_pag;
	this.constru_div = constru_div;
};
// núcleo da requisição ajax e helpers
Jax.prototype=(function() {
	this._httpobjectrequest=null; // inicializa o Objeto de Requisição HTTP para instância.
	this._fila=new Array(); // Inicializa a Fila
	this._fila_status=true; // Inicializa o status do semáforo
		
	var _requestObject = function(method,div,page,variables,img) {
		var ajax_request = false;
		if (window.XMLHttpRequest) {
			ajax_request = new XMLHttpRequest();
			if (ajax_request.overrideMimeType) {
				//ajax_request.overrideMimeType('text/xml');
				ajax_request.overrideMimeType('text/html');
			}
		} else if (window.ActiveXObject) {
			try {
				ajax_request = new ActiveXObject("MSXML2.XMLHttp.4.0");
			} catch (e) {
				try {
					ajax_request = new ActiveXObject("MSXML2.XMLHttp.3.0");
				} catch (e) {
					try {
						ajax_request = new ActiveXObject("MSXML2.XMLHttp");
					} catch (e) {
						try {
							ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) { ajax_request=false; }
					}
				}
			}
			
		}
		if (!ajax_request) {
			alert('Não foi possível criar uma instância XMLHTTP.');
			return false;
		}
		ajax_request.onreadystatechange = function() {
			if (ajax_request.readyState == 4) {
				if (ajax_request.status == 200) {
					result = ajax_request.responseText;
					document.getElementById(div).innerHTML = result;
					_extraiScript(result);
					queueResume();
					Dequeue();
				} else {
					// alert('Houve um problema com a requisição HTML.'); // Erro na requisição, indício de Erro 404
				}
			} else {
				if(img!="N") {
					document.getElementById(div).innerHTML='<img src="../icon/sync.gif" alt="" />';
				}
			}
		}
		if(method=='G'){
			ajax_request.open('GET', page+variables, true);
			ajax_request.send(null);
			setTimeout(function() { ajax_request.abort(); /*alert('Tempo esgotado');*/ },10000);
		} else {
			ajax_request.open('POST', page, true);
			ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax_request.setRequestHeader("Content-length", variables.length);
			ajax_request.setRequestHeader("Connection", "close");
			ajax_request.send(variables);
			setTimeout(function() { ajax_request.abort(); /*alert('Tempo esgotado');*/ },10000);
		}
	}
	var _extraiScript = function(texto) {
		//Maravilhosa função feita pelo SkyWalker.TO do imasters/forum
		//http://forum.imasters.com.br/index.php?showtopic=165277
		// inicializa o inicio ><
		var ini = 0;
		// loop enquanto achar um script
		while (ini!=-1){
			// procura uma tag de script
			ini = texto.indexOf('<script', ini);
			// se encontrar
			if (ini >=0){
				// define o inicio para depois do fechamento dessa tag
				ini = texto.indexOf('>', ini) + 1;
				// procura o final do script
				var fim = texto.indexOf('</script>', ini);
				// extrai apenas o script
				codigo = texto.substring(ini,fim);
				// executa o script
				//eval(codigo);
				/**********************
				* Alterado por Micox - micoxjcg@yahoo.com.br
				* Alterei pois com o eval não executava funções.
				***********************/
				novo = document.createElement("script");
				novo.text = codigo;
				document.body.appendChild(novo);
			}
		}
	}
	
	// Pausar Semáforo
	var queuePause = function() {
		this._fila_status=false;
	};
	// Continuar Semáforo
	var queueResume = function() {
		this._fila_status=true;
	};
	// Limpar Fila
	var queueRelease = function() {
		this._fila=new Array();
	};
	// Chamada básica
	var CallXMLHTTPObject = function(input_url, input_method, pag, div) {
		//this._fila = _fila;
		this._ini_queue_url = input_url;
		this._ini_queue_method = input_method;
		this._pag = pag;
		this._div = div;
		Enqueue();
		return true;
	};
	// Enfileirar Requisições
	var Enqueue = function() {
		// monta a fila com as variaveis para requisição capturadas
		this._fila[this._fila.length] = new Array(this._ini_queue_url, this._ini_queue_method);
		/* <!-- Sugestão para o futuro quando for usar uma thread automatizada :: Para controlar prioridades de entrada na fila, Crie uma "Fila Preferencial" onde esta será executada em primeiro plano, e em seguida, a "Fila convencional" --> */
		// Se não ouver uma instância ajax em progresso, então desmontamos a fila. [não implementado ainda]
		if (!this._httpobjectrequest) { 
			Dequeue();
		}
	};
	// Desenfileirar Requisições
	var Dequeue = function() {
		var command = null;
		var retorno = false;
		if (this._fila.length && this._fila_status) {
			// Atribui variável auxiliar para pegar o primeiro da fila
			command = this._fila[0];
			var url = command[0];
			var method = command[1];
			// Reordena fila. A fila precisa andar para continuar né
			for ( var counter = 1; counter < this._fila.length; counter++ ) {
				this._fila[counter - 1] = this._fila[counter];
			}
			// Reduz o tamanho restante da fila
			this._fila.length = counter - 1;
		}
		// se existir uma requisição e um método definido(posição inicial), retorne isto.
		if ( url && method ) {
			queuePause();
			retorno = _CallXMLHTTPObject(url, method);
		}
		return retorno;
	};
	var _CallXMLHTTPObject = function(in_url, in_method) {
		if (in_method == 'POST') {
			// não implementado
			_getAjax(in_url);
		} else {
			_getAjax(in_url);
		}
	};
	var _getAjax = function(in_url) {
		var varPag=this._pag;
		var varDiv=this._div;
		_requestObject('G',varDiv,varPag,in_url,'N');
		return false;
	};
	return {
		_constructor: Jax,
        gjaxmult: function(vars,div,img) {
            var pag=this.constru_pag + '?';
            _requestObject('G',div,pag,'i=1&'+vars,img);
            return false;
        },
		gjax: function(vars,img) {
			var pag=this.constru_pag+'?';
			var div=this.constru_div;
			_requestObject('G',div,pag,'i=1&'+vars,img);
			return false;
		},
		pjax: function(form,img) {
			var page = this.constru_pag;
			var div  = this.constru_div;
			var form = document.forms[form];
			var vars = "";
			var valtxt = "";
			var i;
			for (i=0; i<form.elements.length; i++) {
				if (form.elements[i].tagName=="TEXTAREA") {
					valtxt = form.elements[i].value;
					valtxt = valtxt.replace(/&/g,"[(e)]");
					vars += form.elements[i].name + "=" + encodeURI(valtxt) + "&"; 
				}
				if (form.elements[i].tagName=="INPUT") {
					if ((form.elements[i].type=="text") || (form.elements[i].type=="hidden") || (form.elements[i].type=="password") ) { 
						vars += form.elements[i].name+"="+encodeURI(form.elements[i].value)+"&";
					}
					if (form.elements[i].type=="checkbox") {
						if (form.elements[i].checked) { vars += form.elements[i].name+"="+form.elements[i].value+"&"; }
						else { vars += form.elements[i].name+"=&"; }
					}
					if (form.elements[i].type=="radio") {
						if (form.elements[i].checked) { vars += form.elements[i].name+"="+form.elements[i].value+"&"; }
					}
				} else if (form.elements[i].tagName=="SELECT") {
					var sel = form.elements[i];
					vars += sel.name + "="+sel.options[sel.selectedIndex].value+"&";
				}
			}
			_requestObject('P',div,page,'i=1&'+vars,img);
			return false;
		},
		CallXMLHTTPObjectGET: function(input_url) {
			var pag=this.constru_pag+'?';
			var div=this.constru_div;
			CallXMLHTTPObject ('i=1&'+input_url, "GET", pag, div);
		}
	};
})();


// Substituir Caracteres
function replaceAll(string, token, newtoken) {
	var exp_reg = new RegExp(token, "g");
	var resp = string.replace(exp_reg, newtoken);
	return resp;
}

// Função para consultas em tempo-real (modelo polling tradicional - ajax insiste verificando se há modificações no servidor)
function repeatAjax(pagina,div,variaveis,tempo){
	// cria uma instância da classe
	objRepeatAjax = new Jax(pagina,div);
	// equipar variaveis GET
	return self.setInterval( function(){ objRepeatAjax.CallXMLHTTPObjectGET(variaveis) } ,tempo);
}



/**
 * Biblioteca Ajax Reverso (Comet - Long Polling Technique)
 * Explicação das técnicas Comet: 
 *  - http://www.webreference.com/programming/javascript/rg28/index.html (inglês)
 * Créditos pelo projeto push: 
 *  - http://thiago.dieb.com.br/2011/07/26/usando-push-na-web-comet-push-ajax-e-ajax-reverso-veja-como-funciona 
 * Pré-requisito: 
 *  - Implementar a biblioteca jQuery
 */
var Comet = function(url) {
	Comet.prototype.url = url;
};
Comet.prototype = {
	constructor: Comet,
	timestamp: 0,
	noerror: true,
	initialize: function() { },
	connect: function() {
		this.ajax = $.ajax({
			type: 'GET',
			url: this.url,
			data: { 'timestamp' : this.timestamp },
			dataType: 'json',
			cache: false,
			success: function(result){
				//alert("resultado...");
				Comet.prototype.timestamp = result.timestamp;
				Comet.prototype.handleResponse(result);
				exibirDadosFila(result);
				Comet.prototype.noerror = true;
            },
            complete: function(result){
				//alert("...tentando dnovo!");
				if (!Comet.prototype.noerror) {
					setTimeout(function() { Comet.prototype.connect() }, 3000); 
				} else {
					Comet.prototype.connect();
				}
				Comet.prototype.noerror = false;
            }
		});
	},
	disconnect: function() { },
	
	handleResponse: function(resp) {
		if(typeof resp.result !== 'undefined') {
			id = resp.result[0].senha_sen;
			alert("bola_"+parseInt(id)) ; 
			//console.log($("bola_"+parseInt(id)));
			$("#bola_"+parseInt(id)).addClass('sorteado');
		}
	}
}
		
function exibirDadosFila(resp) {
	console.log(resp);
	//alert(resp.result[0].senha_sen);
}
   