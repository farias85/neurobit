/**
 * Created by webind on 25/05/2017.
 */
nbApp.filter('uc',
  ['$log',
    function ($log) {
      return function (valor, length) {

        if (typeof (valor) === 'string') {

          if (angular.isNumber(length) && length >= 0) {
            return valor.substr(0, length).toUpperCase() + valor.substr(length);
          } else {
            return valor.toUpperCase();
          }

        } else if (angular.isArray(valor)) {
          let newValue = [];

          for (let i = 0; i < valor.length; i++) {
            if (typeof (valor[i]) === 'string') {
              if (angular.isNumber(length) && length >= 0) {
                newValue.push(valor[i].substr(0, length).toUpperCase() + valor[i].substr(length));
              } else {
                newValue.push(valor[i].toUpperCase());
              }
            } else {
              newValue.push(valor[i]);
            }
          }
          return newValue;
        } else {
          return valor;
        }
      };
    }
  ]
);

