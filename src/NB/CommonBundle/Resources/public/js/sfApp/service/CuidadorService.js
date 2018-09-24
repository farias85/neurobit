/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

sfApp.service('CuidadorService',
  ['ApiService',
    function (ApiService) {

      this.buscador = (body) => {
        const url = Routing.generate('api_cuidador_buscador', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };

      this.checkNickName = (nick) => {
        const url = Routing.generate('api_cuidador_nickname_exist', {'nick': nick, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data.exist;
          })
          .catch(err => console.error(err));
      };

      this.checkEmail = (email) => {
        const url = Routing.generate('api_cuidador_email_exist', {'email': email, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data.exist;
          })
          .catch(err => console.error(err));
      };

      this.recuperarCuidador = (id) => {
        const url = Routing.generate('api_cuidador_perfil', {id: id, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };

      this.allPropietarioData = (id) => {
        const url = Routing.generate('api_ajax_get_full_propietario', {idCuidador: id, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };

      this.showPerfil = (id) => {
        const url = Routing.generate('api_cuidador_show_perfil', {id: id, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };

      this.changePassword = (body) => {
        const url = Routing.generate('api_cuidador_change_password', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };

      this.findEntrevistas = (body) => {
        const url = Routing.generate('api_cuidador_find_entrevistas', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };
    }
  ]
);