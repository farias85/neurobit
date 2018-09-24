/* 
 * File: HorarioInternaService.js
 * User: jariasf1
 * Date: 19-mar-2018
 * Time: 17:26:47
 */

sfApp.service('HorarioInternaService',
  ['ApiService',
    function (ApiService) {

      this.findAll = () => {
        const url = Routing.generate('api_horario_interna_index', {'_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.horariosCuidador = (idCuidador) => {
        const url = Routing.generate('api_horario_interna_by_cuidador', {idCuidador: idCuidador, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);
