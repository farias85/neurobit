/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

sfApp.service('ProvinciaService',
  ['ApiService',
    function (ApiService) {

      this.findByPais = (idPais) => {
        const url = Routing.generate('api_provincia_by_pais', {'idPais': idPais, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);