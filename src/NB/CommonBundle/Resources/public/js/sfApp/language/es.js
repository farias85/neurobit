/**
 * Created by webind on 8/10/2016.
 */
sfApp.config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations('es', {
    'campo.requerido': 'Campo requerido',
    'localizacion': 'Localización',
    'cargando': 'Cargando',
    'sin.resultados': 'No se encontraron resultados',
    'filtrar': 'Filtrar',
    'seleccione': 'Seleccione',
    'enero': 'Enero',
    'febrero': 'Febrero',
    'marzo': 'Marzo',
    'abril': 'Abril',
    'mayo': 'Mayo',
    'junio': 'Junio',
    'julio': 'Julio',
    'agosto': 'Agosto',
    'septiembre': 'Septiembre',
    'octubre': 'Octubre',
    'noviembre': 'Noviembre',
    'diciembre': 'Diciembre',
    'lunes': 'Lunes',
    'martes': 'Martes',
    'miercoles': 'Miércoles',
    'jueves': 'Jueves',
    'viernes': 'Viernes',
    'sabado': 'Sábado',
    'domingo': 'Domingo',
    'basico': 'Básico',
    'medio': 'Medio',
    'avanzado': 'Avanzado',
    'mujer': 'Mujer',
    'hombre': 'Hombre',
    'otro': 'Otro',
    'delgado': 'Delgad@',
    'normal': 'Normal',
    'fuerte': 'Fuerte',
    'muy.fuerte': 'Muy Fuerte',
    'disponibilidad.parcial': 'Disponibilidad Parcial',
    'disponibilidad.total': 'Disponibilidad Total',
    'horario': 'Horario',
    'inicio': 'Inicio',
    'fin': 'Fin',
    'todas': 'Todas',
    'todos': 'Todos',
    'cuidador.eliminado': ' ha sido eliminado de su lista de cuidadores',
    'xhr.error': 'Ha ocurrido un error, la acción no ha podido completarse',
    'cuidador.favorito': ' ha sido incluido en tu lista de favoritos',
    'cuidador.favorito.del': ' ha sido eliminado de tu lista de favoritos',
    'sf.ee.enviada': 'Enviada',
    'sf.ee.leida': 'Leída',
    'sf.ee.aceptada': 'Aceptada',
    'sf.ee.rechazada': 'Rechazada',
    'sf.ee.proponiendo.fecha': 'Proponiendo Fecha',
    'sf.ee.perdida': 'Perdida',
    'sf.ee.cancelada': 'Cancelada',
    'sf.ee.terminada': 'Terminada',
    'sf.ee.vinculacion': 'Petición Servicio',
    'sf.ee.vinculacion.aceptada': 'Servicio Aceptado',
    'sf.ee.vinculacion.denegada': 'Servicio Denegado',
    'solicitante': 'Solicitante',
    'cuidador': 'Cuidador',
    'empresa': 'Empresa',
    'familia': 'Familia',
    'fecha': 'Fecha',
    'error.archivo.grande': 'El archivo excede la capacidad permitida',
    'ocultar.detalles': 'Ocultar detalles',
    'ver.detalles': 'Ver detalles',
    'comprobar.identidad': 'Comprobando tu identidad...',
    'accediendo.atu.perfil': 'Accediendo a tu perfil',
    'error.de.datos': 'Ha ocurrido un error accediendo a sus datos. Por favor contacte al administrador del sistema',
    'error.ir.a.grabar': 'El formulario tiene datos incorrectos, no se puede ir a Grabar',
    'seleccione.mensaje': 'Seleccione un mensaje para ejecutar la acción',
    'error.init.camara': 'Ha ocurrido un error en la inicialización o no se ha encontrado la cámara',
    'calle': 'Street',
    'paseo': 'Walk',
    'entrevista': 'Entrevista',
    'marcar.como.leido': 'Marcar como leída',
    'marcar.como.no.leido': 'Marcar como no leída',
    'seleccion': 'Selección',
    'enviar.papelera': 'Enviar a la papelera',
  });
  $translateProvider.preferredLanguage(_locale_);
  $translateProvider.useSanitizeValueStrategy('escape');
}]);



