var nombreCliente = "";
var btnPresionado;
var usuario = "";
var sessionMicami="";
//sessvars.username="";

//carga la vista principal de la pagina
$(document).ready(function(){
//$(document).on("ready",function(){
    cargarEncabezado("vista/sectionHead.php");
    cargarContenido("vista/inicio.php");
});

//=======================================================
//funcion que carga el encabezado en el div de encabezado
function cargarEncabezado(urlPagina){
    $.get(urlPagina, function(data){
       $('div#contenedorSuperior').html(data);
       verificarSesion();
    });
};


//=================================================================
//funcion que carga el rubro como contenido en el div de contenido
function cargarContenido(urlPagina){
    $.get(urlPagina, function(data){
       $('div#contenedorCentral').html(data);
       //contar cuantos inputs se estan cargando en la presente vista
       //alert("tenemos "+ $(':input').length +" inputs");
    });
};


//====================================================================
//funcion que obedece a los eventos de los botones del menu principal
function btnPress(nombre){
    btnPresionado=nombre;
    switch (nombre){
        case "Jugueteria":
            cargarProductos(nombre);
        break;
        case "Maleteria":
            cargarProductos(nombre);
        break;
        case "Libreria":
            cargarProductos(nombre);
        break;
        case "Abarroteria":
            cargarProductos(nombre);
        break;
        case "inicio":
            cargarContenido("vista/inicio.php");
        break;
        case "loginUsuario":
            cargarContenido("vista/frmlogin.php");
        break;
        case "registrarUsuario":
            cargarContenido("vista/frmRegistrar.php");
        break;
    }
};


//============================================================================================
//Funciion que cumple 02 roles importantes:
// 1.- Contactar con la clase que conectara a la base de datos y darle los parametros necesarios
//     para que esta pueda retornarnos las peticiones enviadas.
// 2.- Contruir la estructura y la vistas especificamente del contenido entregado por la base de datos

function cargarProductos(rubro){
    $('#contenedorCentral').empty();
    $('#contenedorCentral').append(""+"<center><div class='container-fluid' id='mostradorProductos'>"
                                     +"</div></center>"
                                  );
    $('#mostradorProductos').append("<center><img id='loading' src='img/loading.gif'></center>");
    
    $.ajax({
        type:'POST',
        url:'modelo/stock_productos.php',
        dataType:'json',
        data:"saludo="+btnPresionado,
        success:function(result){
            $('#mostradorProductos').empty();
            var vCont = 1;
            $.each(result.items,function(id,valor){
                var Caracteristicas;
                var Ancho;
                var Alto;
                var Largo;
                if (valor.caracteristicasProducto!==null){
                    Caracteristicas = "<div class='divCaracteristicasProducto'>"+valor.caracteristicasProducto+"</div>";
                }else{
                    Caracteristicas = "<div class='divCaracteristicasProducto'></div>";
                }
                if (valor.anchoProducto!==null){
                    Ancho="<div class='divAnchoProducto'>"+valor.anchoProducto+" Cm.</div>";
                }else{
                    Ancho="<div class='divAnchoProducto'></div>";
                }
                if (valor.altoProducto!==null){
                    Alto="<div class='divAltoProducto'>"+valor.altoProducto+" Cm.</div>";
                }else{
                    Alto="<div class='divAltoProducto'></div>";
                }
                if (valor.largoProducto!==null){
                    Largo="<div class='divLargoProducto'>"+valor.largoProducto+" Cm.</div>";
                }else{
                    Largo="<div class='divLargoProducto'></div>";
                }
                
                var divProductos = "<div id='producto"+vCont+"' class='span3'>"
                                        +"<div class='divImgProducto'><img class='fotoProducto img-rounded' src='./fotos/"+valor.fotoProducto+".jpg'></div>"
                                        +"<div class='divDetalles'>"
                                            +"<div class='divNombreProducto'>"+valor.idProducto+"</div>"
                                            +"<div class='divNombreProducto'>"+valor.nombreProducto+"</div>"
                                            +"<div class='divPrecioProducto'>S/."+valor.precioProducto+"</div>"
                                            +Ancho
                                            +Alto
                                            +Largo
                                            +Caracteristicas
                                        +"</div>"
                                        +"<div class='divBotonesProducto'>"
                                            +"<div class='btn btn-success' onclick='seleccionarProducto("+valor.idProducto+");' id='btnProducto"+valor.idProducto+"'>Seleccionar</div>"
                                            +"<div class='btn btn-warning'>Ver Detalles</div>"
                                        +"</div>"
                                +"</div>";
                $('#mostradorProductos').append(divProductos);
                vCont++;
            });                    
        }
     });
};



var i=0;
var p = new Array();
function seleccionarProducto(id){
    p[i]=id;
    $('div#btnProducto'+id).empty();
    $('div#btnProducto'+id).attr({
        class:"btn btn-danger",
        id:"btnProducto"+id,
        onclick:"quitarProducto("+id+");"
    });
    $('div#btnProducto'+id).append("Comprado");
    $("span#contadorProductos").empty();
    $("span#contadorProductos").append(p.length);
    i++;
    //$('div#btnProducto'+id).attr("class","btn btn-danger");
    //$('div#btnProducto'+id).removeClass("btn-success");
    //$('div#btnProducto'+id).addClass("btn-danger");
    alert("acabas de seleccionar el producto "+id);
};


function quitarProducto(id){
    //Ubicamos la posicion de ID en el array y lo almacenamos en una variable
    var index = p.indexOf(id);
    //Ahora eliminamos la posicion en el array seleccionado
    //comprobando que sea un lugar valido
    if (index > -1) {
        p.splice(index, 1);
    };

    //Seguidamente le damos los nuevos atributos al boton en cuestion
    $('div#btnProducto'+id).empty();
    $('div#btnProducto'+id).attr({
        class:"btn btn-success",
        id:"btnProducto"+id,
        onclick:"seleccionarProducto("+id+");"
    });
    $('div#btnProducto'+id).append("Seleccionar");

    $("span#contadorProductos").empty();
    $("span#contadorProductos").append(p.length);
    i--;
    alert("estas eliminando el producto: "+id+" que esta ubicado en el lugar: "+index);
};


//=======================================================
//funcion que verifica si hay sesion abierta o no, 
//si existe una sesion: mostrara un saludo y el nombre del usuario
//si no: mostrara un boton para iniciar sesion y otro para registrar
function verificarSesion(){
    var texto1="'loginUsuario'";
    var texto2="'registrarUsuario'";
    if (!sessionMicami) {
        $('div#logeoIdentidad').empty();
        $('div#logeoIdentidad').append(''
            +'<button type="button" class="btn btn-primary" href="#" onclick="btnPress('+texto1+')">Mi cuenta</button>'
            +'<button type="button" class="btn btn-primary" href="#" onclick="btnPress('+texto2+')">Registrate</button>'
            );
    }else{
        $('div#logeoIdentidad').empty();
        $('div#logeoIdentidad').append(''
            +'<button type="button" class="btn btn-link">Bienvenido a tu cuenta</button>'
            +'<button type="button" class="btn btn-link">Cerrar sesion</button>'
            );
    };
};


//=======================================================

function loguearUsuario(){
    var usu2 = $("#txtUser").val();
    var pass2 = $("#txtPass").val();
    $.post("modelo/consultaLogin.php", {"value":usu2,"value2":pass2}, function(data){
        if(data.success){
            //utilizaremos un iterador para extraer los datos contenidos en el objeto 'items' => $JSONArray
            $.each(data.items,function(id,valor){
                nombreCliente=valor.nombres;
                $("div#logeoIdentidad").empty();
                $('div#logeoIdentidad').append(''
                    +'<button type="button" class="btn btn-link">Bienvenid@,'+nombreCliente+'</button>'
                    +'<button type="button" class="btn btn-link">Cerrar sesion</button>');
                //alert("Te damos la bienvenida: "+nombreCliente);
            });
            cargarContenido("vista/inicio.php");
        }else{
            alert("Usuario o contraseña no validos");
            $("#txtPass").val("");
            $("#txtUser").val("");
            $("#txtUser").focus();
        }
    }, "json"); 
};

