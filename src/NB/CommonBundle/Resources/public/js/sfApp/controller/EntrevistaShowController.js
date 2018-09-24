/**
 * Created by Felipe on 03/04/2018.
 */

sfApp.controller('EntrevistaShowController',
  ['$scope', '$window',
    function ($scope, $window) {

      $scope.init = () => {
        const {lat, lng, headerText} = $window.sfParams;
        let locations = [[headerText, lat, lng]];
        try {
          $scope.initReadOnlyMap('map', locations);
        } catch (e) {
          console.error('initReadOnlyMap failed');
        }
      };
    }
  ]
);