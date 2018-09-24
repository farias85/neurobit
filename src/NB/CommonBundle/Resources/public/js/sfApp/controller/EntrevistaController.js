/*
 * Controlador Genérico de Entrevistas con los métodos a utilizar por los controladores
 * especificos, ExtranetEntrevistaController, EmpresaEntrevistaController, FamiliaEntrevistaController
 * File: EntrevistaController.js
 * User: ucifarias@gmail.com
 * Date: 14-mar-2018
 * Time: 10:35:27
 */

sfApp.controller('EntrevistaController',
  ['$scope', '$window', 'EntrevistaService',
    function ($scope, $window, EntrevistaService) {

      $scope.fails = [];
      $scope.oks = [];
      $scope.entrevistas = [];

      $scope.now = {};

      $scope.entity = '';
      $scope.show_entrevista = '';
      $scope.encuesta = '';

      $scope.selected = {};
      $scope.propuesta = {
        fecha: '',
        hora: '10',
        min: '00',
      };

      $scope.TID = $scope.ENTREVISTA_ESTADO_TERMINADA;
      $scope.V = $scope.ENTREVISTA_ESTADO_PETICION_SERVICIO;
      $scope.VA = $scope.ENTREVISTA_ESTADO_SERVICIO_ACEPTADO;
      $scope.VD = $scope.ENTREVISTA_ESTADO_SERVICIO_DENEGADO;

      $scope.PC = $scope.ENTREVISTA_PROPONE_CUIDADOR;
      $scope.PD = $scope.ENTREVISTA_PROPONE_DEMANDANTE;

      $scope.init = () => {
        let myDate = new Date();
        $('#fecha').datepicker({
          // startDate: 'dateToday',
          startDate: $scope.addDays(myDate, 2), //Sumandole 2 dias al dia actual
          format: 'yyyy-mm-dd',
          autoclose: true
        }).on('changeDate', function (e) {
          $scope.$apply(() => {
            $scope.propuesta.fecha = $('#fecha').val();
          });
        });
      };

      $scope.showTerminadaOptions = (item) => {
        const estado = $scope.getEE(item);
        return estado === $scope.TID || estado === $scope.V || estado === $scope.VA || estado === $scope.VD;
      };

      $scope.crearServicio = (item) => {
        EntrevistaService.crearServicio({item, entity: $scope.entity})
          .then((data) => {
            if (data.success === true) {
              item.entrevista.entrevistaEstado.id = data.entrevista.entrevista_estado.id;
              const {date, hour, min} = data.updateAt;
              item.entrevista.updateAt.date = `${date} ${hour}:${min}`;
            }
            return data;
          })
          .catch((err) => console.log(err));
      };

      $scope.terminar = (item) => {
        EntrevistaService.terminar({item, entity: $scope.entity})
          .then((data) => {
            if (data.success === true) {
              item.entrevista.entrevistaEstado.id = data.entrevista.entrevista_estado.id;
              const {date, hour, min} = data.updateAt;
              item.entrevista.updateAt.date = `${date} ${hour}:${min}`;
            }
            return data;
          })
          .catch((err) => console.log(err));
      };

      $scope.isValidPropuesta = () => {
        let m = moment(`${$scope.propuesta.fecha}`, 'YYYY-MM-DD', true);
        return m.isValid() && !($scope.propuesta.fecha === '' || typeof($scope.propuesta.fecha) === 'undefined');
      };

      $scope.openProponer = (item) => {
        $scope.selected = item;
        $('#a-modal-proponer-fecha').click();
      };

      $scope.proponer = () => {
        $('#btn-close-modal-proponer-fecha').click();
        EntrevistaService.proponer({item: $scope.selected, entity: $scope.entity, propuesta: $scope.propuesta})
          .then((data) => {
            if (data.success === true) {
              $scope.selected.entrevista.entrevistaEstado.id = data.entrevista.entrevista_estado.id;
              $scope.selected.entrevista.proponer = data.entrevista.proponer;

              $scope.selected.entrevista.propuestas = data.entrevista.propuestas;//todo ver esto... devuelve string para hacer parse con JSON.parse()

              const {date, hour, min} = data.updateAt;
              $scope.selected.entrevista.updateAt.date = `${date} ${hour}:${min}`;
              $scope.selected.entrevista.fecha.date = `${data.fecha.date} ${data.fecha.hour}:${data.fecha.min}`;
            }
            $scope.propuesta = {
              fecha: '',
              hora: '10',
              min: '00',
            };
            return data;
          })
          .catch((err) => console.log(err));
      };

      $scope.getDisplayName = (item) => {
        if (item.hasOwnProperty('empresa') && item.empresa.hasOwnProperty('nombreComercial')) {
          return `Emp: ${item.empresa.nombreComercial}`;
        }
        if (item.hasOwnProperty('demandante') && item.demandante.hasOwnProperty('name')) {
          return `Fam: ${item.demandante.name} ${item.demandante.lastname}`;
        }
        if (item.hasOwnProperty('cuidador') && item.cuidador.hasOwnProperty('name')) {
          return `${item.cuidador.name} ${item.cuidador.lastname}`;
        }
        return '-';
      };

      $scope.getType = () => {
        if ($scope.entity === '') {
          return;
        }
        if ($scope.entity === $scope.ENTITY_CUIDADOR) {
          return $scope.trans('solicitante');
        }
        return $scope.trans('cuidador');
      };

      $scope.aceptar = (item) => {
        EntrevistaService.aceptar({item, entity: $scope.entity})
          .then((data) => {
            if (data.success === true) {
              $scope.entrevistas = $scope.entrevistas.filter(inner => item.entrevista.id !== inner.entrevista.id);
              //El JMSerializer devuelve los arrays de los objetos con las claves en snake_case, no camelCase como los métodos hidrate
              item.entrevista.entrevistaEstado.id = data.entrevista.entrevista_estado.id;
              const {date, hour, min} = data.updateAt;
              item.entrevista.updateAt.date = `${date} ${hour}:${min}`;
              $scope.oks.push(item);
            }
            if (data.hasOwnProperty('exception')) {
              console.log('exception', data.exception);
            }
            return data;
          })
          .catch((err) => console.log(err));
      };

      $scope.rechazar = (item) => {
        EntrevistaService.rechazar({item, entity: $scope.entity})
          .then((data) => {
            if (data.success === true) {
              $scope.entrevistas = $scope.entrevistas.filter(inner => item.entrevista.id !== inner.entrevista.id);
              //El JMSerializer devuelve los arrays de los objetos con las claves en snake_case, no camelCase como los métodos hidrate
              item.entrevista.entrevistaEstado.id = data.entrevista.entrevista_estado.id;
              const {date, hour, min} = data.updateAt;
              item.entrevista.updateAt.date = `${date} ${hour}:${min}`;
              $scope.fails.push(item);
            }
            return data;
          })
          .catch((err) => console.log(err));
      };

      $scope.cancelar = (item) => {
        EntrevistaService.cancelar({item, entity: $scope.entity})
          .then((data) => {
            if (data.success === true) {
              $scope.oks = $scope.oks.filter(inner => item.entrevista.id !== inner.entrevista.id);
              //El JMSerializer devuelve los arrays de los objetos con las claves en snake_case, no camelCase como los métodos hidrate
              item.entrevista.entrevistaEstado.id = data.entrevista.entrevista_estado.id;
              const {date, hour, min} = data.updateAt;
              item.entrevista.updateAt.date = `${date} ${hour}:${min}`;
              $scope.fails.push(item);
            }
            if (data.hasOwnProperty('exception')) {
              console.log('exception', data.exception);
            }
            return data;
          })
          .catch((err) => console.log(err));
      };

      $scope.getUrlEncuesta = (item) => {
        if (!item.hasOwnProperty('entrevista'))
          return;
        if ($scope.encuesta === '')
          return;
        return Routing.generate($scope.encuesta, {'uid': item.entrevista.uid, '_locale': _locale_});
      };

      $scope.getUrlShowEntrevista = (item) => {
        if (!item.hasOwnProperty('entrevista'))
          return;
        if ($scope.show_entrevista === '')
          return;
        return Routing.generate($scope.show_entrevista, {'uid': item.entrevista.uid, '_locale': _locale_});
      };

      $scope.getDate = (item) => {
        if (!item.hasOwnProperty('entrevista'))
          return;
        return moment(item.entrevista.fecha.date).toDate();
        // return new Date(item.entrevista.fecha.date);
      };

      $scope.getUpdateDate = (item) => {
        if (!item.hasOwnProperty('entrevista'))
          return;
        return moment(item.entrevista.updateAt.date).toDate();
        // return new Date(item.entrevista.updateAt.date);
      };

      $scope.getRemaining = (item) => {
        // console.log('item', item);
        if (!item.hasOwnProperty('entrevista'))
          return;
        let expired = moment(item.entrevista.fecha.date).toDate();
        // let expired = new Date(item.entrevista.fecha.date);
        // console.log('expired', expired);
        return $scope.dateRemaining($scope.now, expired);
      };

      $scope.getExpired = (item) => {
        if (!item.hasOwnProperty('expired'))
          return;
        let expired = new Date(item.expired.date);
        expired.setUTCHours(item.expired.hour);
        expired.setUTCMinutes(item.expired.min);
        return $scope.dateRemaining($scope.now, expired);
      };

      $scope.getEE = (item) => {
        if (!item.hasOwnProperty('entrevista'))
          return;
        return item.entrevista.entrevistaEstado.id;
      };

      $scope.getClass = (item) => {
        if (!item.hasOwnProperty('entrevista'))
          return;
        let result = 'text-danger';
        switch (item.entrevista.entrevistaEstado.id) {
          case $scope.ENTREVISTA_ESTADO_LEIDA:
            result = 'text-primary';
            break;
          case $scope.ENTREVISTA_ESTADO_ACEPTADA:
            result = 'text-success';
            break;
          case $scope.ENTREVISTA_ESTADO_PROPONIENDO_FECHA:
            result = 'text-warning';
            break;
          case $scope.ENTREVISTA_ESTADO_TERMINADA:
            result = 'text-purple';
            break;
          case $scope.ENTREVISTA_ESTADO_PETICION_SERVICIO:
            result = 'text-purple';
            break;
          case $scope.ENTREVISTA_ESTADO_SERVICIO_ACEPTADO:
            result = 'text-purple';
            break;
          case $scope.ENTREVISTA_ESTADO_SERVICIO_DENEGADO:
            result = 'text-purple';
            break;
        }
        return result;
      };
    }
  ]
);
