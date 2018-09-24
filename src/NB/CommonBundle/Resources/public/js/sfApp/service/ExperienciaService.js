/* 
 * File: HorarioEntrevistaService.js
 * User: jariasf1
 * Date: 19-mar-2018
 * Time: 17:25:48
 */

sfApp.service('ExperienciaService',
  ['ApiService',
    function (ApiService) {

      this.findAll = () => {
        const url = Routing.generate('api_experiencia_profesional_index', {'_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.experienciasCuidador = (idCuidador) => {
        const url = Routing.generate('api_experiencia_profesional_by_cuidador', {idCuidador: idCuidador, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);
