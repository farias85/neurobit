/* 
 * File: EntrevistaService.js
 * User: ucifarias@gmail.com
 * Date: 28-abril-2018
 * Time: 17:25:48
 */

sfApp.service('EntrevistaService',
  ['ApiService',
    function (ApiService) {

      this.crearServicio = (body) => {
        const url = Routing.generate('api_entrevista_crear_servicio', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.terminar = (body) => {
        const url = Routing.generate('api_entrevista_terminar', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.proponer = (body) => {
        const url = Routing.generate('api_entrevista_proponer', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.aceptar = (body) => {
        const url = Routing.generate('api_entrevista_aceptar', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.rechazar = (body) => {
        const url = Routing.generate('api_entrevista_rechazar', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.cancelar = (body) => {
        const url = Routing.generate('api_entrevista_cancelar', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

    }
  ]
);
