/**
 * Created by Felipe on 24/05/2018.
 */

sfApp.service('MensajeService', [
    'ApiService',
    function (ApiService) {

      /**
       * Pone en leido el atributo del mensaje
       * @param ids {Array} Id de los mensajes a cambiar el estado
       */
      this.leido = (ids) => {
        const url = Routing.generate('mensaje_leido', {'ids': ids, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.noLeido = (ids) => {
        const url = Routing.generate('mensaje_no_leido', {'ids': ids, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.eliminado = (ids) => {
        const url = Routing.generate('mensaje_eliminado', {'ids': ids, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.noEliminado = (ids) => {
        const url = Routing.generate('mensaje_no_eliminado', {'ids': ids, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.eliminarDefinitivamente = (ids) => {
        const url = Routing.generate('mensaje_eliminar_definitivamente', {'ids': ids, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

    }

  ]
);