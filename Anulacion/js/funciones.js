//validacion de correo
function validacionCorreo(){
  var form = document.getElementById("form");
  var email = document.getElementById("email").value;
  var text = document.getElementById("text");

  var pattern = /^[^ ]+@[^ ]+\.[a-z]{1,2}$/;

  if (email.match(pattern)){
    form.classList.add("valid");
    form.classList.remove("invalid");
    text.innerHTML = "";
  }else{
    form.classList.remove("valid");
    form.classList.add("invalid");
    text.innerHTML = "Email invalido.";
    text.style.color = "#ff0000";
    $("#button1").attr('disabled', true);
  }

  if (email == ""){
    form.classList.remove("valid");
    form.classList.remove("invalid");
    text.innerHTML = "";
    $("#button1").attr('disabled', true);
  }

  
}

function validacionnumeros(){
  var form = document.getElementById("form");
  var idpagotur = document.getElementById("idpagotur")
  var text2 = document.getElementById("text2");

  if (idpagotur.value.length < 8) {
    form.classList.remove("valid");
    form.classList.add("invalid");
    text2.innerHTML = "El codigo de compra es invalido";
    text2.style.color = "#ff0000";
    $("#button1").attr('disabled', true);

  } else {
    form.classList.add("valid");
    form.classList.remove("invalid");
    text2.innerHTML = "";
    $("#button1").attr('disabled', false);
  }

  if (idpagotur == ""){
    form.classList.remove("valid");
    form.classList.remove("invalid");
    text.innerHTML = "";
    $("#button1").attr('disabled', true);
  }

}

//mensajes de formulario
/*
var mensaje1 = document.getElementById("mensaje1");
var mensaje3 = document.getElementById("mensaje3");
var mensaje4 = document.getElementById("mensaje4");
var mensaje5 = document.getElementById("mensaje5");

function validaform(){
var nombre = document.getElementById("nombre");

}
*/
function validaestado(){
  var estado = document.getElementById("estad");
  var pattern = "VEN";
  if (estado.match(pattern)){
    $("#anul").attr('disabled', true);
  }
}

function refreshPage(){
  window.location.reload();
} 




// Capturando el DIV alerta y mensaje
var alerta = document.getElementById("alerta");
var mensaje = document.getElementById("mensaje2");

// Permitir sólo números en el imput
function isNumber(evt) {
  var charCode = evt.which ? evt.which : event.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode === 75) return false;

  return true;
}

function checkRut(rut) {

  

  // Obtiene el valor ingresado quitando puntos y guión.
  var valor = clean(rut.value);

  // Divide el valor ingresado en dígito verificador y resto del RUT.
  cuerpo = valor.slice(0, -1);
  dv = valor.slice(-1).toUpperCase();

  // Separa con un Guión el cuerpo del dígito verificador.
  rut.value = format(rut.value);

  // Si no cumple con el mínimo ej. (n.nnn.nnn)
  if (cuerpo.length < 7) {

    mensaje.innerHTML = 'Ingresó un RUT muy corto';
    mensaje.style.color = "#ff0000";
    $("#button2").attr('disabled', true);
    return false;
  }


  //tabla con los ruts erroneos 
  //const rut = ["11.111.111-1", "11.111.111-1", "22.222.222-2", "33.333.333-3", "44.444.444-4", "55.555.555-5", "66.666.666-6", "77.777.777-7", "88.888.888-8", "99.999.999-9"];


 


  if (cuerpo.length > 9) {

    mensaje.innerHTML = 'Ingresó un RUT muy largo';
    mensaje.style.color = "#ff0000";
    $("#button2").attr('disabled', true);
    return false;
  }

  // Calcular Dígito Verificador "Método del Módulo 11"
  suma = 0;
  multiplo = 2;

  // Para cada dígito del Cuerpo
  for (i = 1; i <= cuerpo.length; i++) {
    // Obtener su Producto con el Múltiplo Correspondiente
    index = multiplo * valor.charAt(cuerpo.length - i);

    // Sumar al Contador General
    suma = suma + index;

    // Consolidar Múltiplo dentro del rango [2,7]
    if (multiplo < 7) {
      multiplo = multiplo + 1;
    } else {
      multiplo = 2;
    }
  }

  // Calcular Dígito Verificador en base al Módulo 11
  dvEsperado = 11 - (suma % 11);

  // Casos Especiales (0 y K)
  dv = dv == "K" ? 10 : dv;
  dv = dv == 0 ? 11 : dv;


  // Validar que el Cuerpo coincide con su Dígito Verificador
  if (dvEsperado != dv) {

    mensaje.innerHTML = 'El RUT no es VALIDO.';
    mensaje.style.color = "#ff0000";
    $("#button2").attr('disabled', true);
    return false;
  } else {

    mensaje.innerHTML = '';
    $("#button2").attr('disabled', false);
    return true;
  }

}

function format (rut) {
  rut = clean(rut)

  var result = rut.slice(-4, -1) + '-' + rut.substr(rut.length - 1)
  for (var i = 4; i < rut.length; i += 3) {
    result = rut.slice(-3 - i, -i) + '.' + result
  }

  return result
}

function clean (rut) {
  return typeof rut === 'string'
    ? rut.replace(/^0+|[^0-9kK]+/g, '').toUpperCase()
    : ''
}




