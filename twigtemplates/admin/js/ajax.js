(function() {
    
    /*var aliasok = true;
    var emailok = false;
    var usuario = null;*/
    
    var catok = true;
    var nickok = true;
    var mailok = true;
    var orden = 'id';
    var filtro = '';
    var cpp = 5;
    var upp = 5;
    var zpp = 5;
    var ppp = 5;
    
    var main = function() {
        initialAjax();
    };
    
    
    var genericAjax = function (url, data, type, callBack) {
        $.ajax({
            url: url,
            data: data,
            type: type,
            dataType : 'json',
            crossDomain: true,
        })
        .done(function( json ) {
            console.log('ajax done');
            console.log(json);
            callBack(json);
        })
        .fail(function( xhr, status, errorThrown ) {
            console.log('ajax fail');
        })
        .always(function( xhr, status ) {
            console.log('ajax always');
        });
    };
    
    // peticiones AJAX
    var initialAjax = function() {
        genericAjax('https://dwse-scorpions.c9users.io/proyectoMVC/ajax/listaLinka', null, 'get', function(json) {
            procesarLink(json.link);
        });
        
        
        genericAjax('https://dwse-scorpions.c9users.io/proyectoMVC/ajax/listaCategorias', null, 'get', function(json) {
            procesarCategoria(json.categoria);
        });
        
    };
    
    var getTrlink = function (value) {
        return `<tr>
                    <td>${value.id}</td>
                    <td>${value.idCategoria}</td>
                    <td>${value.href}</td>
                    <td>${value.comentario}</td>
                    <td>${value.idUsuario}</td>
                </tr>`;
    };
    
    
    var procesarLink = function (link) {
        var listaLink = '';
        $.each(link, function(key, value) {
            listaLink += getTrlink(value);
        });
        $('#listaLink').empty();
        $('#listaLink').append(listaLink);
    };
    
    
    /******************************************************* procesar categorias *************************************************/
    
    var getTrcategorias = function (value) {
        return `<tr>
                    <td>${value.id}</td>
                    <td>${value.idUsuario}</td>
                    <td>${value.categoria}</td>
                </tr>`;
    };
    
    
    var procesarCategoria = function (categoria) {
        var categorias = '';
        $.each(categoria, function(key, value) {
            categorias += getTrcategorias(value);
        });
        $('#categorias').empty();
        $('#categorias').append(categorias);
    };
    
 /********************************************************** Insertar Links ******************************************************/
 
 //Funcion para el botón nueva categoria
    $('#insertarLink').on("click", function(e) {
       e.preventDefault();
            var parametros = {
                idCategoria : $('#categoria').val().trim(),
                href : $('#link').val().trim(),
                comentario : $('#comentario').val().trim()
            };
            if(parametros.categoria !== '' || parametros.categoria !== null ||
                parametros.href !== '' || parametros.href !== null || parametros.comentario !== '' || parametros.comentario !== null) {
                genericAjax('https://dwse-scorpions.c9users.io/proyectoMVC/ajax/addLink', parametros, 'get', function(json) {
                    if(json.alta > 0) {
                        genericAjax('https://dwse-scorpions.c9users.io/proyectoMVC/ajax/listaLinka', null, 'get', function(json) {
                            procesarLink(json.link);
                        });
                    } else {
                        alert('Error al procesar Link en ajax');
                    }
                });
            }
    });
    
    $('#link').on('blur', function(event) {
        catok = false;
        if(event.target.value.trim() !== '') {
            genericAjax('https://dwse-scorpions.c9users.io/proyectoMVC/ajax/comprobarlink', {'href' : event.target.value.trim()}, 'get', function(json) {
                if(json.linkdisponible) {
                    nickok = true;
                }
            });
        } else {
            nickok = true;
        }
    });
    
    /************************************************************ insertar Categorias **************************************************************/
    //Funcion para el botón nuevo link
    $('#botonCategoria').on('click', function(e) {
       e.preventDefault();
       if(catok) {
            var parametros = {
                categoria : $('#categoria').val().trim()
            };
            if(parametros.usuario !== '' || parametros.usuario !== null || parametros.categoria !== '' || parametros.categoria !== null) {
                genericAjax('https://dwse-scorpions.c9users.io/proyectoMVC/ajax/addcat', parametros, 'get', function(json) {
                    if(json.alta > 0) {
                        genericAjax('https://dwse-scorpions.c9users.io/proyectoMVC/ajax/listaCategorias', null, 'get', function(json) {
                            procesarCategoria(json.categoria);
                        });
                    } else {
                        alert('Error al procesar Categorias en ajax');
                    }
                });
            }
       } else {
           alert('Nombre incorrecto');
       }
       
    });
    
    $('#categoria').on('blur', function(event) {
        catok = false;
        if(event.target.value.trim() !== '') {
            genericAjax('https://dwse-scorpions.c9users.io/proyectoMVC/ajax/comprobarcat', {'nombre' : event.target.value.trim()}, 'get', function(json) {
                if(json.catdisponible) {
                    catok = true;
                }
            });
        } else {
            catok = true;
        }
    });
    
    main();
})()