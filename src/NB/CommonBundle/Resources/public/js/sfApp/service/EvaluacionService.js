/**
 * Created by Felipe on 24/05/2018.
 */

sfApp.service('EvaluacionService', [
    'ApiService',
    function (ApiService) {

      this.index = () => {
        const url = Routing.generate('api_evaluacion_index', {'_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

    }

  ]
);