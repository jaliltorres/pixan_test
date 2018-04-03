<template lang="html">
  <div class="">
    <div class="row registry-pixan">
      <div class="col-md-12">
        <img src="/image/brand/pixan.png">
      </div>
      <div class="col-md-12">
        <h2>¡Lo que tú quieras!</h2>
        <h4>La plataforma líder en compra y venta <br> de productos en línea en México</h4>
        <button type="button" name="button" class="btn" @click="showModalRegistry">REGÍSTRATE</button>
      </div>
    </div>

    <!-- modal registro -->
    <div class="row modal-style">
      <modal name="show-modal-registry" :adaptive="true" :width="510" :height="380">
        <div>
          <div class="col-md-12" style="margin-top: 10px;" align="center">
            <h2 style="color: #E74430;">REGISTRO</h2>
          </div>
          <div class="col-md-12" style="margin-top: 30px;">
            <label for="">Email</label>
            <input type="text" name="" value="" class="form-control" v-model="email_user">
          </div>
          <div class="col-md-12">
            <label for="">Contraseña</label>
            <input type="password" name="" value="" class="form-control" v-model="password_user">
          </div>
          <div class="col-md-12" style="margin-top: 30px;" align="center">
            <button type="button" name="button" class="btn btn-danger" @click="saveUser()">REGISTRAR</button>
          </div>
          <div class="col-md-12" v-show="showMessages" align="center">
            <span v-for="error in error_messages">{{error}}</span>
          </div>
        </div>
      </modal>
    </div>

    <!-- modal error -->
    <div class="row modal-style">
      <modal name="show-modal-success" :adaptive="true" :width="450" :height="200">
        <div style="margin: 40px;">
          <div class="col-md-12" style="margin-top: 10px;" align="center">
            <h2 style="color: #E74430;">Usuario Resgistrado</h2>
          </div>
          <div class="col-md-12" style="margin-top: 30px;" align="center">
            <button type="button" name="button" class="btn btn-danger" @click="hideModal()">ACEPTAR</button>
          </div>
        </div>
      </modal>
    </div>

  </div>
</template>

<script>
import VModal from 'vue-js-modal'
import VueResource from 'vue-resource';

Vue.use(VModal)
Vue.use(VueResource);

export default {
  data(){
    return {
      email_user: '',
      password_user: '',
      error_messages: [],
      showMessages: false
    }
  },
  methods: {
    showModalRegistry() {
      this.$modal.show('show-modal-registry');
    },
    saveUser(){
      var post = { email: this.email_user, password: this.password_user }
      axios.post('registry', post).then(response => {

            if(response.data.status == 'error')
            {
              this.error_messages = response.data.messages
              this.showMessages = true
            }else {
              this.$modal.hide('show-modal-registry');
              this.$modal.show('show-modal-success');
            }

          });
    },
    hideModal(){
      this.$modal.hide('show-modal-success');
    }
  }
}
</script>

<style lang="css">
.registry-pixan h2
{
  font-size: 35pt;
  color: white;
  font-family: 'Montserrat', sans-serif;
  font-weight: 600;
}

.registry-pixan h4
{
  font-size: 16pt;
  color: white;
  font-family: 'Montserrat', sans-serif;
  font-weight: 500;
}

.registry-pixan button
{
  background-color: white;
  color: #EC2227;
  border-radius: 25px;
  font-family: 'Montserrat', sans-serif;
  cursor: pointer;
}

.registry-pixan
  {
    margin-top: 300px;
  }

  .modal-style label
  {
    text-align: left;
    font-family: 'Montserrat', sans-serif;
    margin-top: 15px;
  }

  .modal-style button
  {
    border-radius: 25px;
    font-family: 'Montserrat', sans-serif;
    cursor: pointer;
  }
</style>
