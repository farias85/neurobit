/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 26/11/2017.
 */

nbApp.directive('messages', ['$window', function () {
    return {
      restrict: 'AEC',
      replace: true,
      templateUrl: Routing.generate('dispatch', {'template': 'messages'}),
      link: function (scope, elem, attrs) {
      }
    };
  }]
);
