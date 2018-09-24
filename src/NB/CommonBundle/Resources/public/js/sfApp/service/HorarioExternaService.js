/* 
 * File: HorarioExternaService.js
 * User: jariasf1
 * Date: 19-mar-2018
 * Time: 17:26:13
 */

sfApp.service('HorarioExternaService',
  ['ApiService',
    function (ApiService) {

      this.findAll = () => {
        const url = Routing.generate('api_horario_externa_index', {'_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.horariosCuidador = (idCuidador) => {
        const url = Routing.generate('api_horario_externa_by_cuidador', {idCuidador: idCuidador, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);
