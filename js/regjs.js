$(function(){
function validar_clave() {
var caract_invalido = " ";
var caract_longitud = 8;
var cla1 = document.registrous.regpasword.value;
var cla2 = document.registrous.regpaswordconf.value;
if (cla1 == '' || cla2 == '') {
document.alertpass1.text('Debes introducir tu clave en los dos campos.');
document.getElementById("alertpass1").style.display="inline";
return false;
}
if (document.registrous.regpasword.value.length < caract_longitud) {
#('alertpass1')='Tu clave debe constar de ' + caract_longitud + ' caracteres.';
document.alert1.show();
return false;
}
if (document.registrous.regpasword.value.indexOf(caract_invalido) > -1) {
document.alertpass1.value("Las claves no pueden contener espacios");
return false;
}
else {
if (cla1 != cla2) {
document.alertpass2.value("Las claves introducidas no son iguales");
return false;
}
else {
document.alertpass1.value('Contraeña correcta');
return true;
      }
   }
}
});