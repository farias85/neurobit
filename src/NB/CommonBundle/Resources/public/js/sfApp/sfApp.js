/**
 * Created by Felipe on 09/02/2018.
 */

let sfApp = angular.module('SF',
  [
    'ngResource',
    'ngRoute',
    'ngCookies',
    'ngAnimate',
    // 'chart.js',
    'ngSanitize',
    'ui.multiselect',
    'ngFileUpload',
    'pascalprecht.translate',
    'LocalStorageModule',
    'growlNotifications',
    'SF.CONFIG'
  ], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('{|');
    return $interpolateProvider.endSymbol('|}');
  }
).run(
  ['$rootScope', '$cookieStore', '$location', 'CONFIG', '$translate', '$window',
    function ($rootScope, $cookieStore, $location, CONFIG, $translate, $window) {
      const {
        multiselectTmpl, sfHost, sfBaseUrl, sfMaxFileSize,
        sfMaxVideoFileSize, sfBasePerfilCompletado, sfVersion, sfVersionEs, sfVersionGb
      } = $window.sfConfig;

      // $rootScope.API_URL = CONFIG.API_URL;
      $rootScope.ASSET_URL = multiselectTmpl.split('common')[0];
      $rootScope.UPLOADS_URL = `${multiselectTmpl.split('bundles')[0]}uploads/`;
      $rootScope.HOST_URL = sfHost;
      $rootScope.BASE_URL = sfBaseUrl;
      $rootScope.MB = 1048576; //1MB -> 1048576 bytes
      $rootScope.MAX_FILE_SIZE = $rootScope.MB * sfMaxFileSize;
      $rootScope.MAX_VIDEO_FILE_SIZE = $rootScope.MB * sfMaxVideoFileSize;
      $rootScope.BASE_PERFIL_COMPLETADO = parseInt(sfBasePerfilCompletado, 10);
      $rootScope.SF_VERSION = sfVersion;
      $rootScope.SF_VERSION_ES = sfVersionEs;
      $rootScope.SF_VERSION_GB = sfVersionGb;

      $rootScope.TIPO_MEDIA_IMAGEN = 'imagen';
      $rootScope.TIPO_MEDIA_DOCUMENTO_ESTUDIO = 'documento-estudio';
      $rootScope.TIPO_MEDIA_VIDEO_PERFIL = 'video-perfil';
      $rootScope.TIPO_MEDIA_CERTIFICADO_PENALES = 'certificado-penales';
      $rootScope.TIPO_MEDIA_NOMINA = 'nomina';
      $rootScope.TIPO_MEDIA_FACTURA = 'factura';
      $rootScope.TIPO_MEDIA_CONTRATO = 'contrato';
      $rootScope.TIPO_MEDIA_PROTOCOLO = 'protocolo';
      $rootScope.TIPO_MEDIA_DOCUMENTO = 'documento';
      $rootScope.TIPO_MEDIA_CURRICULUM = 'curriculum';
      $rootScope.TIPO_MEDIA_CERTIFICADO_MEDICO = 'certificado-medico';

      $rootScope.TIPO_CUIDADOR_AUTONOMO = 5;

      $rootScope.ENTREVISTA_ESTADO_ENVIADA = 1;
      $rootScope.ENTREVISTA_ESTADO_LEIDA = 3;
      $rootScope.ENTREVISTA_ESTADO_ACEPTADA = 4;
      $rootScope.ENTREVISTA_ESTADO_RECHAZADA = 5;
      $rootScope.ENTREVISTA_ESTADO_PROPONIENDO_FECHA = 6;
      $rootScope.ENTREVISTA_ESTADO_PERDIDA = 7;
      $rootScope.ENTREVISTA_ESTADO_CANCELADA = 8;
      $rootScope.ENTREVISTA_ESTADO_TERMINADA = 9;
      $rootScope.ENTREVISTA_ESTADO_PETICION_SERVICIO = 10;
      $rootScope.ENTREVISTA_ESTADO_SERVICIO_ACEPTADO = 11;
      $rootScope.ENTREVISTA_ESTADO_SERVICIO_DENEGADO = 12;

      $rootScope.ENTREVISTA_PROPONE_CUIDADOR = 1;
      $rootScope.ENTREVISTA_PROPONE_DEMANDANTE = 0;

      $rootScope.ENTITY_CUIDADOR = 'UserBundle:Cuidador';
      $rootScope.ENTITY_EMPRESA = 'EmpresaBundle:Empresa';
      $rootScope.ENTITY_DEMANDANTE = 'UserBundle:Demandante';
      $rootScope.ENTITY_EXPERIENCIA_PROFESIONAL = 'ExtranetBundle:ExperienciaProfesional';
      $rootScope.ENTITY_SERVICIO = 'ExtranetBundle:Servicio';

      $rootScope.libphonenumber = $window.libphonenumber;

      $rootScope.SF_EVENT_SERVICIO_COUNT_PETICIONES = 'sf.event.servicio.count.peticiones';
      $rootScope.SF_EVENT_ENTREVISTA_COUNT_EN_PROCESO = 'sf.event.entrevista.count.en.proceso';
      $rootScope.SF_EVENT_INCIDENCIA_COUNT_PENDIENTES = 'sf.event.incidencia.count.pendiente';

      /**
       * Para los objetos que corresponden con un checkbox y muestran o no un div
       * @param object El objeto que se desea cambiar el estado
       * @param property El nombre de la propiedad que debe estar en true o false
       * @param div El id del div que se va a mostrar o no según el checkbox esté habilitado o no
       */
      $rootScope.onChangeTrueShowDiv = (object, property, div) => {
        let htmlElement = $(`#${div}`);
        if (object[property] === true) {
          htmlElement.hide(1000);
          object[property] = false;
        } else {
          htmlElement.show('slow');
          object[property] = true;
        }
      };

      $rootScope.onChangeTrueHideDiv = (object, property, div) => {
        let htmlElement = $(`#${div}`);
        if (object[property] === false) {
          htmlElement.hide(1000);
          object[property] = true;
        } else {
          htmlElement.show('slow');
          object[property] = false;
        }
      };

      /**
       * Para setear un valor por defecto en los select q se crean con ng-options
       * se debe pasar el objeto y propiedad que pertenecen al ng-model del elemento select actual
       * @param object
       * @param property Se agrega a esta propiedad las claves, nombre, id, fake
       * @param array Arreglo de elementos de las opciones del select
       * @param label Parámetro que muestra el textHTML de cada option
       */
      $rootScope.addFakeValue = (array, object, property, label = 'nombre') => {
        object[property] = $.extend(true, {}, array[0]); //JSON.parse(JSON.stringify($scope.provincias[0]))
        object[property][label] = $rootScope.trans('todos');
        object[property].id = Date.now();
        object[property].fake = true;
        return [object[property], ...array]; //[$scope.box.provincia].concat($scope.provincias)
      };

      // $translate('seleccione')
      //   .then(translation => {
      //     $scope.cuidador.videoName = translation
      //   })

      $rootScope.trans = (key) => {
        return $translate.instant(key);
      };

      $rootScope.createHourPeriod = (index) => {
        const hours = 23;
        let start = [];
        let end = [];
        index = parseInt(index, 10);
        let first = {};
        for (let i = 0; i <= hours; i++) {
          if (i === 0) {
            first = $rootScope.createHour(i);
          }
          start.push($rootScope.createHour(i));
          if (i > index) {
            end.push($rootScope.createHour(i));
          }
        }
        if (index !== 0) {
          end.push(first);
        }
        return {start, end};
      };

      $rootScope.createHour = (index) => {
        let obj = index < 10 ? {value: `0${index}`} : {value: `${index}`};
        obj.label = `${obj.value}:00`;
        return obj;
      };

      /**
       * Devuelve un dia de mayo del 85, mes en el que nací.
       * Lo utilizo para validar las fechas de los dias de las semana
       * @param day Los dias de la semana configurados son 0 -> lunes ... 6 -> domingo
       * @param hour Valor entero del 0 al 23
       * @returns {*}
       */
      $rootScope.getMayDay = (day, hour) => {
        day = parseInt(day, 10);
        day = day + 1; //se le suma uno, xq tengo los dias de la semana q empiezan en lunes 0 y no hay ningun dia que sea 0 de mayo del 1985
        if (day <= 0 || isNaN(day) || day > 31) {
          console.error(day, 'invalid day');
        }
        day = day < 10 ? `0${day}` : day;

        hour = parseInt(hour, 10);
        if (hour < 0 || isNaN(hour) || hour > 23) {
          console.error(hour, 'invalid hour');
        }
        hour = hour < 10 ? `0${hour}` : hour;

        return moment(`1985-05-${day}:${hour}:00:00`, 'YYYY-MM-DD:HH:mm:ss', true);
      };

      $rootScope.date2Moment = (date) => {
        let mmonth = (date.getMonth() + 1);
        mmonth = mmonth < 10 ? `0${mmonth}` : mmonth;
        let mday = date.getDate();
        mday = mday < 10 ? `0${mday}` : mday;
        const mdt = `${date.getFullYear()}-${mmonth}-${mday}`;
        return moment(mdt, 'YYYY-MM-DD', true);
      };

      $rootScope.onChangeChecked = (object, property) => {
        object[property] = !object[property];
        //console.log(property, object[property]);
      };

      $rootScope.filterSelected = (obj) => {
        return obj.selected === true;
      };

      $rootScope.filterNoSelected = (obj) => {
        return obj.selected === false;
      };

      $rootScope.initExperiencias = (object, property, experiencias) => {
        // const opts = $('#experiencia_mes_desde').children('option');
        object[property] = experiencias.map(item => {
          const date_text_inicio = item.fechaInicio.hasOwnProperty('date') ? item.fechaInicio.date : item.fechaInicio;
          const mDateInicio = moment(date_text_inicio, 'YYYY-MM-DD HH:mm:ss').toDate();
          const date_text_fin = item.fechaFin.hasOwnProperty('date') ? item.fechaFin.date : item.fechaFin;
          const mDateFin = moment(date_text_fin, 'YYYY-MM-DD HH:mm:ss').toDate();

          const mes_desde = mDateInicio.getMonth() + 1;
          const anno_desde = mDateInicio.getFullYear();
          const mes_hasta = mDateFin.getMonth() + 1;
          const anno_hasta = mDateFin.getFullYear();

          const {pacientes} = item;
          const nombre = pacientes && pacientes.length > 0 ? pacientes[0].nombre : '';
          const apellidos = pacientes && pacientes.length > 0 ? pacientes[0].apellidos : '';
          const autorizo = pacientes && pacientes.length > 0;
          return {
            id: item.id, nombre, apellidos, telefono: '', email: '',
            descripcion: item.descripcionFunciones, mes_desde, anno_desde, mes_hasta, anno_hasta,
            autorizo, state: true, selected: true,
          };
        });
      };

      $rootScope.initEstudios = (object, property, estudios) => {
        object[property] = estudios.map(item => {
          const date_text = item.fecha.hasOwnProperty('date') ? item.fecha.date : item.fecha;
          let mDate = moment(date_text, 'YYYY-MM-DD HH:mm:ss').toDate();
          const mes = mDate.getMonth();
          const anno = mDate.getFullYear();

          item.mes = mes + 1;
          item.anno = anno;
          item.state = true;
          item.selected = true;
          return item;
        });
      };

      /**
       * Inicia los valores de idiomas
       * @param object
       * @param property
       * @param idiomas
       * @param cuidadorIdiomas
       */
      $rootScope.initIdiomas = (object, property, idiomas, cuidadorIdiomas = []) => {
        object[property] = idiomas.map(item => ({
          id: item.idioma.id,
          nombre: item.nombre,
          idioma: item.idioma,
          nativo: false,
          hablado: '0',
          escrito: '0',
          leido: '0',
          selected: false,
          state: false,
        }));

        for (let i of cuidadorIdiomas) {
          for (let j of object[property]) {
            if (i.idioma === j.idioma.id) {
              j.nativo = i.nativo;
              j.hablado = i.hablado;
              j.escrito = i.escrito;
              j.leido = i.leido;
              j.selected = true;
              j.state = true;
              break;
            }
          }
        }
      };

      $rootScope.initTipoCuidadores = (object, property, tipoCuidadores, cuidadorTipoCuidadores = []) => {
        object[property] = tipoCuidadores.map((item) => ({
          id: item.tipoCuidador.id,
          nombre: item.nombre,
          selected: false,
          state: false
        }));

        for (let i of cuidadorTipoCuidadores) {
          for (let j of object[property]) {
            if (i.tipoCuidador.id === j.id) {
              j.selected = true;
              j.state = true;
              break;
            }
          }
        }
      };

      $rootScope.initHabilidades = (object, property, habilidades, cuidadorHabilidades = []) => {
        object[property] = habilidades.map((item) => ({
          id: item.habilidad.id,
          nombre: item.nombre,
          tipo_habilidad: item.habilidad.tipoHabilidad.id,
          selected: false,
          state: false
        }));

        for (let i of cuidadorHabilidades) {
          for (let j of object[property]) {
            if (i.habilidad.id === j.id) {
              j.selected = true;
              j.state = true;
              break;
            }
          }
        }
      };

      $rootScope.initTipoHabilidades = (object, property, tipoHabilidades, cuidadorHabilidades = []) => {
        object[property] = tipoHabilidades.map((item) => ({
          id: item.tipoHabilidad.id,
          nombre: item.nombre,
          selected: true
        }));

        if (cuidadorHabilidades.length > 0) {
          for (let th of object[property]) {
            th.selected = false;
            for (let item of cuidadorHabilidades) {
              if (item.habilidad.tipoHabilidad.id === th.id) {
                th.selected = true;
                break;
              }
            }
          }
        }
      };

      $rootScope.getUrlImage = (object, property, index = 0) => {
        if (object.hasOwnProperty(property) && object[property].hasOwnProperty('name')) {
          return `${$rootScope.UPLOADS_URL}${object[property].name}`;
        }
        const value = (index % 4) + 1;
        return `${$rootScope.ASSET_URL}/frontend/img/persona${value}.jpeg`;
      };

      $rootScope.getUrlVideo = (object, property) => {
        if (object.hasOwnProperty(property) && object[property].hasOwnProperty('name')) {
          return `${$rootScope.UPLOADS_URL}${object[property].name}`;
        }
        return ``;
      };

      $rootScope.random = (start = 0, end = 10) => {
        return Math.floor(Math.random() * end) + start;
      };

      $rootScope.getStarts = (cuidador) => {
        const {calificacion} = cuidador;
        const maximaCalificacion = cuidador.hasOwnProperty('maximaCalificacion') ? cuidador.maximaCalificacion
          : cuidador.hasOwnProperty('maxima_calificacion') ? cuidador.maxima_calificacion : false;
        let count = maximaCalificacion === true ? 5 : calificacion;
        let html = '';
        for (let i = 0; i < count; i++) {
          html += `<i class="fa fa-star sf-blue" aria-hidden="true"></i>`;
        }
        // html = count === 0 ? `<i class="fa fa-star-half" aria-hidden="true"></i>` : html;
        html = count === 0 ? `<i class="fa sf-blue" aria-hidden="true"></i>` : html;
        return html;
      };

      /**
       *
       * @param obj Puede ser un objeto de empresa, cuidador, o demandante
       * @returns {*}
       */
      $rootScope.getLocalizacion = (obj) => {
        //Localizacion: C.Valencia, Valencia.
        if (obj.hasOwnProperty('id')) {
          if (obj.hasOwnProperty('municipio') && obj.hasOwnProperty('pais')) {
            const {municipio, pais} = obj;
            const {provincia} = municipio;
            if (obj.hasOwnProperty('ciudad')) {
              return `${obj.ciudad}, ${municipio.nombre}, ${provincia.nombre}, ${pais.nombre}`;
            }
            return `${municipio.nombre}, ${provincia.nombre}, ${pais.nombre}`;
          }

          if (obj.hasOwnProperty('municipio')) {
            const {municipio} = obj;
            if (municipio.hasOwnProperty('provincia')) {
              const {provincia} = municipio;
              if (obj.hasOwnProperty('ciudad')) {
                return `${obj.ciudad}, ${municipio.nombre}, ${provincia.nombre}`;
              }
              return `${municipio.nombre}, ${provincia.nombre}`;
            }
          }

          console.warn('warning -> getLocalizacion -> No se ha podido hayar una localización', obj);
          return '';
        }
        return '';
      };

      $rootScope.flagUrl = (pais) => {
        if (pais.hasOwnProperty('isoCode')) {
          return `${$rootScope.ASSET_URL}frontend/img/flag/${pais.isoCode}.png`;
        }
        if (pais.hasOwnProperty('pais')) {
          return `${$rootScope.ASSET_URL}frontend/img/flag/${pais.pais.isoCode}.png`;
        }
      };

      $rootScope.isValidPhoneNumber = (phone) => {
        return $rootScope.libphonenumber.isValidNumber(phone);
      };

      $rootScope.initGeoAddressMap = (idMap, address, $scope) => {
        let geocoder = new google.maps.Geocoder();

        let map = new google.maps.Map(document.getElementById(idMap), {
          zoom: 17,
          scrollwheel: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        geocoder.geocode({'address': address}, function (results, status) {
          if (status === 'OK') {
            const first = results[0];

            $scope.$apply(() => {
              $scope.lat = first.geometry.location.lat();
              $scope.lng = first.geometry.location.lng();
            });

            map.setCenter(first.geometry.location);
            // let marker = new google.maps.Marker({
            //   map: map,
            //   position: first.geometry.location,
            //   animation: google.maps.Animation.DROP,
            // });
          } else {
            let mensajeError = '';
            if (status === 'ZERO_RESULTS') {
              mensajeError = 'No hubo resultados para la dirección ingresada.';
            } else if (status === 'OVER_QUERY_LIMIT' || status === 'REQUEST_DENIED' || status === 'UNKNOWN_ERROR') {
              mensajeError = 'Error general del mapa.';
            } else if (status === 'INVALID_REQUEST') {
              mensajeError = 'Error de la web. Contacte con Seniors First.';
            }
            $scope.alert(mensajeError);
          }
        });
      };

      $rootScope.initSelectLocationMap = (idMap, $scope) => {
        let marker;
        let latlng = new google.maps.LatLng(40.38109531761201, -3.6126405633543754);

        let myOptions = {
          zoom: 6,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          streetViewControl: false,
          mapTypeControl: false,
        };

        let map = new google.maps.Map(document.getElementById(idMap),
          myOptions);

        google.maps.event.addListener(map, 'click', function (event) {
          placeMarker(event.latLng.lat(), event.latLng.lng());
        });

        let placeMarker = (lat, lng) => {
          let pos = new google.maps.LatLng(lat, lng);

          if (marker === undefined) {
            marker = new google.maps.Marker({
              position: pos,
              map: map,
              animation: google.maps.Animation.DROP,
            });
          }
          else {
            marker.setPosition(pos);
          }
          map.setCenter(pos);

          $scope.$apply(() => {
            $scope.lat = lat;
            $scope.lng = lng;
          });

        };
      };

      $rootScope.initReadOnlyMap = (idMap, locations = []) => {
        // let locations = [
        //   ['Bondi Beach', -33.890542, 151.274856, 4],
        //   ['Coogee Beach', -33.923036, 151.259052, 5],
        //   ['Cronulla Beach', -34.028249, 151.157507, 3],
        //   ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
        //   ['Maroubra Beach', -33.950198, 151.259302, 1]
        // ];

        let latlng = new google.maps.LatLng(40.38109531761201, -3.6126405633543754);
        let center = locations.length > 0 ? new google.maps.LatLng(locations[0][1], locations[0][2]) : latlng;
        let map = new google.maps.Map(document.getElementById(idMap), {
          zoom: 10,
          center: center,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        let infowindow = new google.maps.InfoWindow();

        let marker, i;
        for (i = 0; i < locations.length; i++) {
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
          });

          google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            };
          })(marker, i));
        }
      };

      /**
       *
       * @param date {Date}
       * @param expired {Date}
       * @returns {string}
       */
      $rootScope.dateRemaining = (date, expired) => {
        let falta = Math.floor((expired.getTime() - date.getTime()) / 1000);
        let result = '-';

        if (falta > 0) {
          let horas = Math.floor(falta / 3600);
          falta = falta % 3600;
          let minutos = Math.floor(falta / 60);

          horas = (horas < 10 ? '0' + horas : horas);
          minutos = (minutos < 10 ? '0' + minutos : minutos);

          result = horas > 24 ? `${Math.floor(horas / 24)}d ${horas % 24}h` : `${horas}h ${minutos}m`;
        }

        return result;
      };

      $rootScope.getColor = (index = 0) => {
        //Con cero saca el colo por defecto, azul fuerte
        let color = '';
        switch (index) {
          case 1:
            color = '#e4a';
            break;
          case 2:
            color = '#3071a9';
            break;
          case 3:
            color = '#3071a9';
            break;
          case 4:
            color = '#449f89';
            break;
          case 5:
            color = '#000000';
            break;
          case 6:
            color = '#f94';
            break;
          case 7:
            color = '#000000';
            break;
          case 8:
            color = '#000000';
            break;
          case 9:
            color = '#85144b';
            break;
          case 10:
            color = '#85144b';
            break;
          case 11:
            color = '#85144b';
            break;
          case 12:
            color = '#000000';
            break;
          case 19:
            color = '#39cccc';
            break;
          case 20:
            color = '#cccccc';
            break;
          case 21:
            color = '#449f89';
            break;
          case 22:
            color = '#e4a';
            break;
        }
        return color;
      };

      $rootScope.initCalendar = (idCalendar, events) => {

        $(`#${idCalendar}`).fullCalendar({
          locale: 'es',
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
          },
          editable: true,
          events: events,
          eventMouseover: function (calEvent, jsEvent) {
            if (calEvent.hasOwnProperty('start') && calEvent.hasOwnProperty('end')) {
              if (calEvent.start !== null && calEvent.end !== null) {

                const startHour = moment(calEvent.start).format('HH');
                const startMin = moment(calEvent.start).format('mm');
                const endHour = moment(calEvent.end).format('HH');
                const endMin = moment(calEvent.end).format('mm');
                const durationTime = `${startHour}:${startMin} - ${endHour}:${endMin}`;

                const tooltip = `
                    <div class="tooltipevent" style="color:#0b93d5; width:100px; height:20px; position:absolute;z-index:1000;">
                        ${durationTime}
                    </div>`;
                $('body').append(tooltip);

                $(this).mouseover(function (e) {
                  let tooltip = $('.tooltipevent');
                  $(this).css('z-index', 10000);
                  tooltip.fadeIn('500');
                  tooltip.fadeTo('10', 1.9);
                }).mousemove(function (e) {
                  let tooltip = $('.tooltipevent');
                  tooltip.css('top', e.pageY + 10);
                  tooltip.css('left', e.pageX + 20);
                });
              }
            }
          },
          eventMouseout: function (calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.tooltipevent').remove();
          }
        });

      };

      $rootScope.getWeekDays = () => {
        let weekday = new Array(7);
        weekday[0] = 'Monday';
        weekday[1] = 'Tuesday';
        weekday[2] = 'Wednesday';
        weekday[3] = 'Thursday';
        weekday[4] = 'Friday';
        weekday[5] = 'Saturday';
        weekday[6] = 'Sunday';
        return weekday;
      };

      $rootScope.confirmDecline = () => {
        $('#btn-close-modal-confirm').click();
        $rootScope.confirmAcept = () => {
          console.log('$rootScope.confirmAcept -> empty call');
          $('#btn-close-modal-confirm').click();
        };
      };

      $rootScope.confirmAcept = () => {
        console.log('$rootScope.confirmAcept -> empty call');
        $('#btn-close-modal-confirm').click();
      };

      /**
       *
       * @param date {Date} La fecha a la q queramos adicionar los dias
       * @param days {integer} La cantidad de dias a adicionar
       * @returns {Date}
       */
      $rootScope.addDays = (date, days) => {
        return new Date(date.getTime() + days * 24 * 60 * 60 * 1000);
      };

      $rootScope.getTextCount = (text, count = 150) => {
        if (text.length > count) {
          return `${text.substr(0, count)}...`;
        }
        return text;
      };

      $rootScope.isVersionEs = () => {
        return $rootScope.SF_VERSION === $rootScope.SF_VERSION_ES;
      };

      $rootScope.isVersionGb = () => {
        return $rootScope.SF_VERSION === $rootScope.SF_VERSION_GB;
      };

      $rootScope.alert = (message) => {
        $('#modal-info-text').text(message);
        $('#a-modal-info').click();
      };

    }
  ]
);

