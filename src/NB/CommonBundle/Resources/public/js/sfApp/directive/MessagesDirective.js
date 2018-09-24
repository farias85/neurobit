/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 26/11/2017.
 */

sfApp.directive('messages', ['$window', function ($window) {
    const {messagesTmpl} = $window.sfConfig;
    return {
      restrict: 'AEC',
      replace: true,
      templateUrl: messagesTmpl,
      link: function (scope, elem, attrs) {
        // scope.$watch('message', function (value) {
        //   console.log('Message Changed!');
        // });
        // scope.clearMessage = function () {
        //   scope.message = '';
        // };
        // elem.bind('mouseover', function () {
        //   elem.css('cursor', 'pointer');
        // });
      }
    };
  }]
);
