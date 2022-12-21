//validacion de correo
function validacionCorreo(){
    var form = document.getElementById("form");
    var email = document.getElementById("email").value;
    var text = document.getElementById("text");
  
    var pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
  
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
//validacion largo de la contraseña
function validacionpwd(){
    var form = document.getElementById("form");
    var password = document.getElementById("password")
    var text2 = document.getElementById("text2");
  
    if (password.value.length < 4) {
      form.classList.remove("valid");
      form.classList.add("invalid");
      text2.innerHTML = "complete el minimo de digitos";
      text2.style.color = "#ff0000";
      $("#button1").attr('disabled', true);
  
    } else {
      form.classList.add("valid");
      form.classList.remove("invalid");
      text2.innerHTML = "";
      $("#button1").attr('disabled', false);
    }
  
    if (password == ""){
      form.classList.remove("valid");
      form.classList.remove("invalid");
      text.innerHTML = "";
      $("#button1").attr('disabled', true);
    }
  
  }
//validacion de calentario
$(document).ready(function(){

  $('.input-daterange').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      calendarWeeks : true,
      clearBtn: true,
      disableTouchKeyboard: true
  });
  
  });

//tabla con busqueda y export

$(document).ready(function() {
  $('#table_id').DataTable({

      dom: 'Bfrtip',
      responsive: true,
      pageLength: 25,
      // lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

      buttons: [
          'copy',  'excel', 'pdf', 'print'
      ]

  });
});



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
    $("#button1").attr('disabled', true);
    return false;
  }


  if (cuerpo.length > 9) {

    mensaje.innerHTML = 'Ingresó un RUT muy largo';
    mensaje.style.color = "#ff0000";
    $("#button1").attr('disabled', true);
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
    $("#button1").attr('disabled', true);
    return false;
  } else {

    mensaje.innerHTML = '';
    $("#button1").attr('disabled', false);
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

//datapicker
$(function() {

  var from_$input = $('#input_from').pickadate(),
    from_picker = from_$input.pickadate('picker')

  var to_$input = $('#input_to').pickadate(),
    to_picker = to_$input.pickadate('picker')


  // Check if there’s a “from” or “to” date to start with.
  if ( from_picker.get('value') ) {
    to_picker.set('min', from_picker.get('select'))
  }
  if ( to_picker.get('value') ) {
    from_picker.set('max', to_picker.get('select'))
  }

  // When something is selected, update the “from” and “to” limits.
  from_picker.on('set', function(event) {
    if ( event.select ) {
      to_picker.set('min', from_picker.get('select'))    
    }
    else if ( 'clear' in event ) {
      to_picker.set('min', false)
    }
  })
  to_picker.on('set', function(event) {
    if ( event.select ) {
      from_picker.set('max', to_picker.get('select'))
    }
    else if ( 'clear' in event ) {
      from_picker.set('max', false)
    }
  })

});

//Direccion 
var RegionesYcomunas = {
	regiones: [
		{
			NombreRegion: "Arica y Parinacota",
			comunas: ["Arica", "Camarones", "Putre", "General Lagos"]
		},
		{
			NombreRegion: "Tarapacá",
			comunas: [
				"Iquique",
				"Alto Hospicio",
				"Pozo Almonte",
				"Camiña",
				"Colchane",
				"Huara",
				"Pica"
			]
		},
		{
			NombreRegion: "Antofagasta",
			comunas: [
				"Antofagasta",
				"Mejillones",
				"Sierra Gorda",
				"Taltal",
				"Calama",
				"Ollagüe",
				"San Pedro de Atacama",
				"Tocopilla",
				"María Elena"
			]
		},
		{
			NombreRegion: "Atacama",
			comunas: [
				"Copiapó",
				"Caldera",
				"Tierra Amarilla",
				"Chañaral",
				"Diego de Almagro",
				"Vallenar",
				"Alto del Carmen",
				"Freirina",
				"Huasco"
			]
		},
		{
			NombreRegion: "Coquimbo",
			comunas: [
				"La Serena",
				"Coquimbo",
				"Andacollo",
				"La Higuera",
				"Paiguano",
				"Vicuña",
				"Illapel",
				"Canela",
				"Los Vilos",
				"Salamanca",
				"Ovalle",
				"Combarbalá",
				"Monte Patria",
				"Punitaqui",
				"Río Hurtado"
			]
		},
		{
			NombreRegion: "Valparaíso",
			comunas: [
				"Valparaíso",
				"Casablanca",
				"Concón",
				"Juan Fernández",
				"Puchuncaví",
				"Quintero",
				"Viña del Mar",
				"Isla de Pascua",
				"Los Andes",
				"Calle Larga",
				"Rinconada",
				"San Esteban",
				"La Ligua",
				"Cabildo",
				"Papudo",
				"Petorca",
				"Zapallar",
				"Quillota",
				"Calera",
				"Hijuelas",
				"La Cruz",
				"Nogales",
				"San Antonio",
				"Algarrobo",
				"Cartagena",
				"El Quisco",
				"El Tabo",
				"Santo Domingo",
				"San Felipe",
				"Catemu",
				"Llaillay",
				"Panquehue",
				"Putaendo",
				"Santa María",
				"Quilpué",
				"Limache",
				"Olmué",
				"Villa Alemana"
			]
		},
		{
			NombreRegion: "Región del Libertador Gral. Bernardo O’Higgins",
			comunas: [
				"Rancagua",
				"Codegua",
				"Coinco",
				"Coltauco",
				"Doñihue",
				"Graneros",
				"Las Cabras",
				"Machalí",
				"Malloa",
				"Mostazal",
				"Olivar",
				"Peumo",
				"Pichidegua",
				"Quinta de Tilcoco",
				"Rengo",
				"Requínoa",
				"San Vicente",
				"Pichilemu",
				"La Estrella",
				"Litueche",
				"Marchihue",
				"Navidad",
				"Paredones",
				"San Fernando",
				"Chépica",
				"Chimbarongo",
				"Lolol",
				"Nancagua",
				"Palmilla",
				"Peralillo",
				"Placilla",
				"Pumanque",
				"Santa Cruz"
			]
		},
		{
			NombreRegion: "Región del Maule",
			comunas: [
				"Talca",
				"ConsVtución",
				"Curepto",
				"Empedrado",
				"Maule",
				"Pelarco",
				"Pencahue",
				"Río Claro",
				"San Clemente",
				"San Rafael",
				"Cauquenes",
				"Chanco",
				"Pelluhue",
				"Curicó",
				"Hualañé",
				"Licantén",
				"Molina",
				"Rauco",
				"Romeral",
				"Sagrada Familia",
				"Teno",
				"Vichuquén",
				"Linares",
				"Colbún",
				"Longaví",
				"Parral",
				"ReVro",
				"San Javier",
				"Villa Alegre",
				"Yerbas Buenas"
			]
		},
		{
			NombreRegion: "Región del Biobío",
			comunas: [
				"Concepción",
				"Coronel",
				"Chiguayante",
				"Florida",
				"Hualqui",
				"Lota",
				"Penco",
				"San Pedro de la Paz",
				"Santa Juana",
				"Talcahuano",
				"Tomé",
				"Hualpén",
				"Lebu",
				"Arauco",
				"Cañete",
				"Contulmo",
				"Curanilahue",
				"Los Álamos",
				"Tirúa",
				"Los Ángeles",
				"Antuco",
				"Cabrero",
				"Laja",
				"Mulchén",
				"Nacimiento",
				"Negrete",
				"Quilaco",
				"Quilleco",
				"San Rosendo",
				"Santa Bárbara",
				"Tucapel",
				"Yumbel",
				"Alto Biobío",
				"Chillán",
				"Bulnes",
				"Cobquecura",
				"Coelemu",
				"Coihueco",
				"Chillán Viejo",
				"El Carmen",
				"Ninhue",
				"Ñiquén",
				"Pemuco",
				"Pinto",
				"Portezuelo",
				"Quillón",
				"Quirihue",
				"Ránquil",
				"San Carlos",
				"San Fabián",
				"San Ignacio",
				"San Nicolás",
				"Treguaco",
				"Yungay"
			]
		},
		{
			NombreRegion: "Región de la Araucanía",
			comunas: [
				"Temuco",
				"Carahue",
				"Cunco",
				"Curarrehue",
				"Freire",
				"Galvarino",
				"Gorbea",
				"Lautaro",
				"Loncoche",
				"Melipeuco",
				"Nueva Imperial",
				"Padre las Casas",
				"Perquenco",
				"Pitrufquén",
				"Pucón",
				"Saavedra",
				"Teodoro Schmidt",
				"Toltén",
				"Vilcún",
				"Villarrica",
				"Cholchol",
				"Angol",
				"Collipulli",
				"Curacautín",
				"Ercilla",
				"Lonquimay",
				"Los Sauces",
				"Lumaco",
				"Purén",
				"Renaico",
				"Traiguén",
				"Victoria"
			]
		},
		{
			NombreRegion: "Región de Los Ríos",
			comunas: [
				"Valdivia",
				"Corral",
				"Lanco",
				"Los Lagos",
				"Máfil",
				"Mariquina",
				"Paillaco",
				"Panguipulli",
				"La Unión",
				"Futrono",
				"Lago Ranco",
				"Río Bueno"
			]
		},
		{
			NombreRegion: "Región de Los Lagos",
			comunas: [
				"Puerto Montt",
				"Calbuco",
				"Cochamó",
				"Fresia",
				"FruVllar",
				"Los Muermos",
				"Llanquihue",
				"Maullín",
				"Puerto Varas",
				"Castro",
				"Ancud",
				"Chonchi",
				"Curaco de Vélez",
				"Dalcahue",
				"Puqueldón",
				"Queilén",
				"Quellón",
				"Quemchi",
				"Quinchao",
				"Osorno",
				"Puerto Octay",
				"Purranque",
				"Puyehue",
				"Río Negro",
				"San Juan de la Costa",
				"San Pablo",
				"Chaitén",
				"Futaleufú",
				"Hualaihué",
				"Palena"
			]
		},
		{
			NombreRegion: "Región Aisén del Gral. Carlos Ibáñez del Campo",
			comunas: [
				"Coihaique",
				"Lago Verde",
				"Aisén",
				"Cisnes",
				"Guaitecas",
				"Cochrane",
				"O’Higgins",
				"Tortel",
				"Chile Chico",
				"Río Ibáñez"
			]
		},
		{
			NombreRegion: "Región de Magallanes y de la AntárVca Chilena",
			comunas: [
				"Punta Arenas",
				"Laguna Blanca",
				"Río Verde",
				"San Gregorio",
				"Cabo de Hornos (Ex Navarino)",
				"AntárVca",
				"Porvenir",
				"Primavera",
				"Timaukel",
				"Natales",
				"Torres del Paine"
			]
		},
		{
			NombreRegion: "Región Metropolitana de Santiago",
			comunas: [
				"Cerrillos",
				"Cerro Navia",
				"Conchalí",
				"El Bosque",
				"Estación Central",
				"Huechuraba",
				"Independencia",
				"La Cisterna",
				"La Florida",
				"La Granja",
				"La Pintana",
				"La Reina",
				"Las Condes",
				"Lo Barnechea",
				"Lo Espejo",
				"Lo Prado",
				"Macul",
				"Maipú",
				"Ñuñoa",
				"Pedro Aguirre Cerda",
				"Peñalolén",
				"Providencia",
				"Pudahuel",
				"Quilicura",
				"Quinta Normal",
				"Recoleta",
				"Renca",
				"San Joaquín",
				"San Miguel",
				"San Ramón",
				"Vitacura",
				"Puente Alto",
				"Pirque",
				"San José de Maipo",
				"Colina",
				"Lampa",
				"TilVl",
				"San Bernardo",
				"Buin",
				"Calera de Tango",
				"Paine",
				"Melipilla",
				"Alhué",
				"Curacaví",
				"María Pinto",
				"San Pedro",
				"Talagante",
				"El Monte",
				"Isla de Maipo",
				"Padre Hurtado",
				"Peñaflor"
			]
		}
	]
};

jQuery(document).ready(function () {
	var iRegion = 0;
	var htmlRegion =
		'<option value="sin-region">Seleccione región</option><option value="sin-region">--</option>';
	var htmlComunas =
		'<option value="sin-region">Seleccione comuna</option><option value="sin-region">--</option>';

	jQuery.each(RegionesYcomunas.regiones, function () {
		htmlRegion =
			htmlRegion +
			'<option value="' +
			RegionesYcomunas.regiones[iRegion].NombreRegion +
			'">' +
			RegionesYcomunas.regiones[iRegion].NombreRegion +
			"</option>";
		iRegion++;
	});

	jQuery("#regiones").html(htmlRegion);
	jQuery("#comunas").html(htmlComunas);

	jQuery("#regiones").change(function () {
		var iRegiones = 0;
		var valorRegion = jQuery(this).val();
		var htmlComuna =
			'<option value="sin-comuna">Seleccione comuna</option><option value="sin-comuna">--</option>';
		jQuery.each(RegionesYcomunas.regiones, function () {
			if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
				var iComunas = 0;
				jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
					htmlComuna =
						htmlComuna +
						'<option value="' +
						RegionesYcomunas.regiones[iRegiones].comunas[iComunas] +
						'">' +
						RegionesYcomunas.regiones[iRegiones].comunas[iComunas] +
						"</option>";
					iComunas++;
				});
			}
			iRegiones++;
		});
		jQuery("#comunas").html(htmlComuna);
	});
	jQuery("#comunas").change(function () {
		if (jQuery(this).val() == "sin-region") {
			alert("selecciones Región");
		} else if (jQuery(this).val() == "sin-comuna") {
			alert("selecciones Comuna");
		}
	});
	jQuery("#regiones").change(function () {
		if (jQuery(this).val() == "sin-region") {
			alert("selecciones Región");
		}
	});

	jQuery("#regiones2").html(htmlRegion);
	jQuery("#comunas2").html(htmlComunas);

	jQuery("#regiones2").change(function () {
		var iRegiones = 0;
		var valorRegion = jQuery(this).val();
		var htmlComuna =
			'<option value="sin-comuna">Seleccione comuna</option><option value="sin-comuna">--</option>';
		jQuery.each(RegionesYcomunas.regiones, function () {
			if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
				var iComunas = 0;
				jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
					htmlComuna =
						htmlComuna +
						'<option value="' +
						RegionesYcomunas.regiones[iRegiones].comunas[iComunas] +
						'">' +
						RegionesYcomunas.regiones[iRegiones].comunas[iComunas] +
						"</option>";
					iComunas++;
				});
			}
			iRegiones++;
		});
		jQuery("#comunas2").html(htmlComuna);
	});
	jQuery("#comunas2").change(function () {
		if (jQuery(this).val() == "sin-region") {
			alert("selecciones Región");
		} else if (jQuery(this).val() == "sin-comuna") {
			alert("selecciones Comuna");
		}
	});
	jQuery("#regiones2").change(function () {
		if (jQuery(this).val() == "sin-region") {
			alert("selecciones Región");
		}
	});
});

