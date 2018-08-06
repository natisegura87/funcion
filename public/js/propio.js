
function mostrarVer(){
	
	document.getElementById('ver').innerHTML = "Anda! ";
}

function mlista($e){
	
	document.getElementById('lista').innerHTML = "Anda " + $e;
}

function mostrar(){
	var sel = document.getElementById('sel');
	te = sel.options[sel.selectedIndex].text;
	document.getElementById('demo').innerHTML = "Hola 2do desplegable es " + te;
}
function seleccionado(){
	var sel = document.getElementById('selec');

	document.getElementById('demo').innerHTML = "seleccionado 3er desplegable " + sel.options[sel.selectedIndex].text;
}
function cartel(){
	var sel = document.getElementById('sel1');
	te = sel.options[sel.selectedIndex].text;
	alert("Hola " + te);
}
function limpiar(){
	document.getElementById('demo').innerHTML = "";
}
function mostrarLeg(){
	var sel = document.getElementById('leg');
	te = sel.options[sel.selectedIndex].text;
	document.getElementById('empleado').innerHTML = "El legajo es " + te;
}



