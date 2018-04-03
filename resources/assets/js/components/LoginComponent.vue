<template lang="html">
  <div class="login-pixan">

    <!-- div buttons user -->
    <div class="row">
      <div class="col-md-12 m-form">
        <h1>Inicia Sesión</h1>
      </div>
      <div class="col-md-12 m-form">
        <h4 for="">Email</h4>
        <input type="text" name="" value="" class="form-control" v-model="email_login" placeholder="ej. maria@lacasademaria.mx">
      </div>
      <div class="col-md-12 m-form">
        <h4 for="">Contraseña</h4>
        <input type="password" name="" value="" class="form-control" v-model="password_login" placeholder="Escribe tu contraseña">
      </div>
      <div class="col-md-12 m-form-btn">
        <button type="button" name="button" class="btn" @click="login()">INICIAR SESIÓN</button>
      </div>
    </div>

    <!-- modal error -->
    <div class="row">
      <modal name="show-error" :adaptive="true" :width="450" :height="250">
        <div style="margin: 40px;">
          <div class="col-md-12" style="margin-top: 10px;" align="center">
            <h2 style="color: #E74430;">Algo ocurrió</h2>
          </div>
          <div class="col-md-12" style="margin-top: 30px;" align="center">
            <h5>{{error_message}}</h5>
          </div>
          <div class="col-md-12" style="margin-top: 30px;" align="center">
            <button type="button" name="button" class="btn btn-danger" @click="hideError()">Cerrar</button>
          </div>
        </div>
      </modal>
    </div>

  </div>
</template>

<script>
import VModal from 'vue-js-modal'

Vue.use(VModal)

export default {
  data(){
    return {
      error_message: '',
      email_login: '',
      password_login: ''
    }
  },
  methods:{
    login(){
      var login = { email: this.email_login, password: this.password_login }
      axios.post('login', login)
          .then(response => {
            if (response.data.status == 'success')
            {
                location.href = 'admin/index'
            }else
            {
              this.error_message = 'Las credenciales son incorrectas'
              this.$modal.show('show-error')
            }
          });
    },
    hideError(){
      this.$modal.hide('show-error');
    }
  }
}
</script>

<style lang="css">
  .login-pixan
  {
    margin-top: 200px;
    background-color: white;
    width: 500px;
    height: 0 auto;
    padding: 20px;
    border-radius: 5px;
  }

  .login-pixan h1
  {
    font-size: 35pt;
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
    color: #EC2227;
    text-align: left;
  }

  .login-pixan h4
  {
    font-size: 20pt;
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
    text-align: left;
    color: #616161;
  }

  .login-pixan button
  {
    background-color: #EC2227;
    color: white;
    border-radius: 25px;
    font-family: 'Montserrat', sans-serif;
    cursor: pointer;
  }

  .m-form
  {
    margin-top: 15px;
  }

  .m-form-btn
  {
    margin-top: 50px;
  }
  .login-pixan input
  {
    color: #818386;
    font-size: 18pt;
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
  }
</style>
