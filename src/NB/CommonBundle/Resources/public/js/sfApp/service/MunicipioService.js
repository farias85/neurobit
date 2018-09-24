/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

sfApp.service('MunicipioService',
  ['ApiService',
    function (ApiService) {

      this.findByProvincia = (idProv) => {
        const url = Routing.generate('api_municipio_by_provincia', {'idProv': idProv, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);