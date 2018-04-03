<template lang="html">
  <div class="">
    <div class="row">
      <div style="margin-top: 10px;" class="col-sm-6" v-for="(product, index) in products">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{product.name}}</h5>
            <p class="card-text">$ {{product.price}}</p>
            <div class="form-group">
              <label for="">Cantidad</label>
              <input type="text" size="3" v-model="inputProduct[index]" v-bind:id="input + product.id">
            </div>
            <button type="button" class="btn btn-primary" @click="setProduct(product.id, product.name, product.price)" v-bind:id="boton + product.id">Seleccionar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- row de productos seleccionados -->
    <div class="row" style="margin-top:40px;">
      <div class="col-md-6">
        <h4>Realizar Cotización</h4>
      </div>
      <div class="col-md-6">
        <button type="button" name="button" @click="saveCotizacion()" class="btn btn-success btn-block">Realizar</button>
      </div>
    </div>

    <!-- row cotizacion -->
    <div class="row" v-show="div_cot" style="margin-top: 40px;">
      <div class="table table-borderless" id="table" style="padding-top: 30px;">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">NickName</th>
            <th scope="col">Fecha</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cot in cotizacion">
            <td>{{cot.id}}</td>
            <td>{{cot.user}}</td>
            <td>{{cot.total}}</td>
            <td>{{cot.created_at}}</td>
          </tr>
        </tbody>
      </table>
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
export default {
  mounted(){
    axios.get('products/list').then(response => {
      this.products = response.data
    });
    axios.get('cotizacion/list').then(response => {
      this.cotizacion = response.data
      this.div_cot = true
    });
  },
  data(){
    return{
      products: [],
      cotizacion: [],
      inputProduct: [],
      error_message: '',
      input: 'input-',
      boton: 'boton-',
      prods_select: [],
      div_cot: false
    }
  },
  methods:{
    setProduct(index, nombre, costo){
      if (document.getElementById('input-'+index).value != "") {
        var data = {id: index, name: nombre, price: costo, cantidad: this.inputProduct[index-1]}
        this.prods_select.push(data)
        document.getElementById('boton-'+index).innerHTML = "Seleccionado";
        document.getElementById('boton-'+index).disabled=true;
        document.getElementById('input-'+index).disabled=true;
      }else {
        this.error_message = 'Favor de ingresar la cantidad'
        this.$modal.show('show-error');
      }
    },
    saveCotizacion(){
      axios.post('save/cotizacion', this.prods_select)
          .then(response => {
            if (response.data.status == 'success') {
                window.location.reload();
            }else {
              this.error_message = response.data.message
              this.$modal.show('show-error');
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
</style>
