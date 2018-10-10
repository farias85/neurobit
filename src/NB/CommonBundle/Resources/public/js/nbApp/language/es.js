/**
 * Created by webind on 8/10/2016.
 */
nbApp.config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations('es', {
    'campo.requerido': 'Campo requerido',
    'localizacion': 'Localización',
    'cargando': 'Cargando',
    'sin.resultados': 'No se encontraron resultados',
    'filtrar': 'Filtrar',
    'seleccione': 'Seleccione',
  });
  $translateProvider.preferredLanguage(_locale_);
  $translateProvider.useSanitizeValueStrategy('escape');
}]);



