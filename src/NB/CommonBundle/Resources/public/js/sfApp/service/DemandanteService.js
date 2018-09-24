/* 
 * File: HorarioEntrevistaService.js
 * User: jariasf1
 * Date: 19-mar-2018
 * Time: 17:25:48
 */

sfApp.service('DemandanteService',
  ['ApiService',
    function (ApiService) {

      this.changePassword = (body) => {
        const url = Routing.generate('api_demandante_change_password', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };

      this.eliminarFavorito = (body) => {
        const url = Routing.generate('frontend_eliminar_favorito', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };

      this.adicionarFavorito = (body) => {
        const url = Routing.generate('frontend_adicionar_favorito', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };

      this.checkEmail = (email) => {
        const url = Routing.generate('api_demandante_email_exist', {'email': email, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data.exist;
          })
          .catch(err => console.error(err));
      };

    }
  ]
);
