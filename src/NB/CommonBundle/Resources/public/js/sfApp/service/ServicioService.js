/* 
 * File: EntrevistaService.js
 * User: ucifarias@gmail.com
 * Date: 28-abril-2018
 * Time: 17:25:48
 */

sfApp.service('ServicioService',
  ['ApiService',
    function (ApiService) {

      this.inhabilitar = (body) => {
        const url = Routing.generate('api_servicio_inhabilitar', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

    }
  ]
);
