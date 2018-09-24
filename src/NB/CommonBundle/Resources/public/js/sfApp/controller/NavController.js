/**
 * Created by Felipe on 03/04/2018.
 */

sfApp.controller('NavController',
  ['$scope', 'localStorageService', 'ApiService',
    function ($scope, localStorageService, ApiService) {

      $scope.entrevistame = '';

      $scope.init = (route) => {
        $scope.entrevistame = localStorageService.get('entrevistame_cuidador');
        // console.log('cuidador', $scope.entrevistame);

        let favoritos = localStorageService.get('favoritos');
        if (favoritos !== null) {
          const body = {favoritos};
          const url = Routing.generate(route, {'_locale': _locale_});
          ApiService.post(url, body)
            .then(response => {
              console.log('response', response.data);
              localStorageService.remove('favoritos');
              return response.data;
            })
            .catch(err => console.error(err));
        }

      };

      $scope.getName = () => {
        if ($scope.entrevistame !== null && $scope.entrevistame.hasOwnProperty('name')) {
          return `${$scope.entrevistame.name} ${$scope.entrevistame.lastname}`;
        }
        return '';
      };

      $scope.showEntrevistame = () => {
        if ($scope.hasOwnProperty('entrevistame')) {
          if ($scope.entrevistame && $scope.entrevistame.hasOwnProperty('id')) {
            return $scope.entrevistame.hasOwnProperty('id');
          }
        }
        return false;
      };

      $scope.getUrlEntrevista = (route) => {
        if ($scope.getName() === '')
          return;
        return Routing.generate(`${route}.${_locale_}`, {'ref': $scope.entrevistame.ref, '_locale': _locale_});
      };
    }
  ]
);