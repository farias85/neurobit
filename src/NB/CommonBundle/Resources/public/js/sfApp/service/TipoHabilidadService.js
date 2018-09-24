/* 
 * File: TipoHabilidadService.js
 * User: jariasf1
 * Date: 18-mar-2018
 * Time: 23:55:14
 */

sfApp.service('TipoHabilidadService',
  ['ApiService',
    function (ApiService) {

      this.findAll = () => {
        const url = Routing.generate('api_tipo_habilidad_index', {'_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);