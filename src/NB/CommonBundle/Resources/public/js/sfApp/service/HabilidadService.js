/* 
 * File: HabilidadService.js
 * User: jariasf1
 * Date: 18-mar-2018
 * Time: 23:35:27
 */

sfApp.service('HabilidadService',
  ['ApiService',
    function (ApiService) {
      this.findAll = () => {
        const url = Routing.generate('api_habilidad_index', {'_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

    }
  ]
);