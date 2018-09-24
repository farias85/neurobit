/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

sfApp.service('TipoCuidadorService',
  ['ApiService',
    function (ApiService) {

      this.findAll = () => {
        const url = Routing.generate('api_tipo_cuidador_index', {'_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);