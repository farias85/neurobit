/**
 * Created by Felipe on 27/03/2018.
 */

sfApp.filter('ee',
  ['$rootScope',
    function ($rootScope) {
      return function (ee) {
        try {
          ee = parseInt(ee, 10);
        } catch (e) {
          console.log(e);
        }
        switch (ee) {
          case 1:
            ee = $rootScope.trans('sf.ee.enviada');
            break;
          case 3:
            ee = $rootScope.trans('sf.ee.leida');
            break;
          case 4:
            ee = $rootScope.trans('sf.ee.aceptada');
            break;
          case 5:
            ee = $rootScope.trans('sf.ee.rechazada');
            break;
          case 6:
            ee = $rootScope.trans('sf.ee.proponiendo.fecha');
            break;
          case 7:
            ee = $rootScope.trans('sf.ee.perdida');
            break;
          case 8:
            ee = $rootScope.trans('sf.ee.cancelada');
            break;
          case 9:
            ee = $rootScope.trans('sf.ee.terminada');
            break;
          case 10:
            ee = $rootScope.trans('sf.ee.vinculacion');
            break;
          case 11:
            ee = $rootScope.trans('sf.ee.vinculacion.aceptada');
            break;
          case 12:
            ee = $rootScope.trans('sf.ee.vinculacion.denegada');
            break;
          default:
            ee = '-';
        }
        return ee;
      };
    }
  ]
);