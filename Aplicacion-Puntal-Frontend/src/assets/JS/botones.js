$(function() {

  var primer_click = true;
  var visible=true;
  var pantalla_grande=true;

  $("body").on('click','#boton-aside, #boton-user', function(){
    // alert( $(this).attr('id') );
    let alto=$(document).height();
    let ancho=$(document).width();

    if (primer_click == true) { // la primera vez que clickamos

      primer_click = false;

      if (ancho >= 992) {
        visible=true;
        pantalla_grande=true;
      }
      else{
        visible=false;
        pantalla_grande=false;
      }
    }

    if (ancho >= 992) {
      pantalla_grande=true;
    }
    else{
      pantalla_grande=false;
    }

    if($(this).attr('id') == 'boton-aside'){
      menuAside(visible, pantalla_grande);
    }
    else{
      menuUser(visible, pantalla_grande);
    }

    if (visible == true) {
      visible = false;
    }
    else if(visible == false){
      visible = true;
    }

  });


});


function menuAside(visible, pantalla_grande){
  let espacio_aside = $("#espacio-aside");

  if (visible==true) { // VAMOS A OCULTAR EL MENU
    // alert("lo vamos a ocultar");
    if (pantalla_grande == true) {
      // OCULTAR  EL MENU CUANDO LA PANTALLA ES GRANDE
      espacio_aside.addClass("d-lg-none");
    }
    else{
      // OCULTAR  EL MENU CUANDO LA PANTALLA NO ES GRANDE
      espacio_aside.addClass("d-none");

    }
  }
  else{ // VAMOS A MOSTRAR EL MENU

    // alert("lo vamos a mostrar");
    if (pantalla_grande == true) {
      // MOSTRAR  EL MENU CUANDO LA PANTALLA ES GRANDE
      espacio_aside.removeClass("d-lg-none");
    }
    else{
      // MOSTRAR  EL MENU CUANDO LA PANTALLA NO ES GRANDE
      espacio_aside.removeClass("d-none");
      // espacio_aside.addClass("col-sm-1");

    }
  }
}

function menuUser(visible, pantalla_grande){
  let espacio_user = $("#espacio-user");

  if (visible==true) { // VAMOS A OCULTAR EL MENU
    // alert("lo vamos a ocultar");
    if (pantalla_grande == true) {
      // OCULTAR  EL MENU CUANDO LA PANTALLA ES GRANDE
      espacio_user.addClass("d-lg-none");
    }
    else{
      // OCULTAR  EL MENU CUANDO LA PANTALLA NO ES GRANDE
      espacio_user.addClass("d-none");

    }
  }
  else{ // VAMOS A MOSTRAR EL MENU

    // alert("lo vamos a mostrar");
    if (pantalla_grande == true) {
      // MOSTRAR  EL MENU CUANDO LA PANTALLA ES GRANDE
      espacio_user.removeClass("d-lg-none");
    }
    else{
      // MOSTRAR  EL MENU CUANDO LA PANTALLA NO ES GRANDE
      espacio_user.removeClass("d-none");
    }
  }
}

