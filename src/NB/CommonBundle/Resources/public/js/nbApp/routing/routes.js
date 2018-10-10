/**
 * Created by felipao.
 */
nbApp.config(['$routeProvider', function ($routeProvider) {

    $routeProvider
      .when('/view1', {
          controller: 'View1Controller',
          templateUrl: Routing.generate('dispatch', {'template': 'view1'}),
        }
      )
      .when('/view2', {
          controller: 'View2Controller',
          templateUrl: Routing.generate('dispatch', {'template': 'view2'}),
        }
      );
    // .otherwise({
    //   redirectTo: '/view1'
    // });
  }]
);
