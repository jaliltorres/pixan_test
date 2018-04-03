<template lang="html">
  <div>
    <div class="row row-session">
      <div class="col-md-2 offset-md-8">
        <button type="button" name="button" class="btn">MIS PRODUCTOS</button>
      </div>
      <div class="col-md-2">
        <button type="button" name="button" class="btn" @click="logout">CERRAR SESIÓN</button>
      </div>
    </div>
    <div class="" v-show="listProd">
      <div class="row title-add">
        <div class="col-md-6">
          <h3>Mis Productos</h3>
        </div>
        <div class="col-md-6" align="right">
          <button type="button" name="button" class="btn" @click="showAddProd">AGREGAR</button>
        </div>
      </div>
      <div class="row prods">
        <div style="margin-top: 10px;" class="col-sm-6" v-for="(product, index) in products">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{product.prod_name}}</h5>
              <p class="card-text">$ {{product.prod_price}}</p>
              <div class="form-group">
                <label for="">Cantidad</label>
                <h6>{{product.prod_quantity}}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="" v-show="addProd">
      <div class="row">
        <div class="col-md-12" align="left" style="margin-top: 20px;">
          <button type="button" name="button" class="btn reverse" @click="returnProd">REGRESAR A MIS PRODUCTOS</button>
        </div>
      </div>
      <div class="row setone">
        <div class="col-md-12">
          <h1>Registra un producto para vender</h1>
          <h4>Escribe la información de tu producto, una fotografía
            y la fecha y hora <br> en que dejas de recibir pedidos para el producto</h4>
        </div>
      </div>
      <div class="row setone">
        <div class="col-md-12">
          <h1>Información general de tu producto</h1>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <h6>El nombre de tu producto</h6>
            <input type="text" name="" value="" class="form-control" v-model="name_prod">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <h6>Categoría</h6>
            <input type="text" name="" value="" class="form-control" v-model="category_prod">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <h6>Descripción del producto</h6>
            <input type="text" name="" value="" class="form-control" v-model="description_prod">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <h6>¿Cuántos productos quieres vender?</h6>
            <input type="text" name="" value="" class="form-control" v-model="quantity_prod">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <h6>¿Hasta cuando estará disponible?</h6>
            <input type="date" name="" value="" class="form-control" v-model="date_prod">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <h6>¿Qué precio tiene su producto?</h6>
            <input type="text" name="" value="" class="form-control" v-model="price_prod">
          </div>
        </div>
        <div class="col-md-6 offset-md-6" align="center">
          <div class="form-group">
            <button type="button" name="button" class="btn" @click="saveProd">PUBLICAR</button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal error -->
    <div class="row modal-style">
      <modal name="show-modal-error" :adaptive="true" :width="450" :height="200">
        <div style="margin: 40px;">
          <div class="col-md-12" style="margin-top: 10px;" align="center">
            <h2 style="color: #E74430;">Datos faltantes</h2>
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
export default {
  mounted(){
    axios.get('product/list').then(response => {
      this.products = response.data
    });
  },
  data(){
    return{
      listProd: true,
      addProd: false,
      name_prod: '',
      category_prod: '',
      description_prod: '',
      quantity_prod: '',
      date_prod: '',
      price_prod: '',
      products: []
    }
  },
  methods: {
    showAddProd(){
      this.listProd = false
      this.addProd = true
    },
    returnProd(){
      this.listProd = true
      this.addProd = false
    },
    saveProd(){
      let post = {
        name_prod: this.name_prod,
        category_prod: this.category_prod,
        description_prod: this.description_prod,
        quantity_prod: this.quantity_prod,
        date_prod: this.date_prod,
        price_prod: this.price_prod,
      }
      axios.post('product/save', post).then(response => {
        if (response.data.status == 'error') {
          this.$modal.show('show-modal-error');
        }else {
          location.href = 'index'
        }
      });
    },
    hideModal(){
      this.$modal.hide('show-modal-error');
    },
    logout(){
      axios.get('logout').then(response => {
        console.log(response);
      });
      location.href = '/'
    }
  }
}
</script>

<style lang="css">
.prods
{
  margin: 100px;
}
.row-session
{
  background-color: #EC2227 !important;
  padding: 20px
}

.row-session button
{
  font-size: 14pt;
  color: white;
  font-family: 'Montserrat', sans-serif;
  background-color: #EC2227;
  cursor: pointer;
}

.title-add
{
  margin-top: 40px;
  padding: 10px;
}

.title-add h3
{
  font-size: 28pt;
  color: #616161;
  font-weight: 400;
  text-align: left;
}

.title-add button
{
  border-radius: 25px;
  background-color: #EC2227;
  color: white;
  font-family: 'Montserrat', sans-serif;
  cursor: pointer;
  text-align: right;
}

.setone
{
  margin: 70px;
  background-color: white;
  padding: 20px;
}

.setone h1
{
  font-size: 35pt;
  font-family: 'Montserrat', sans-serif;
  font-weight: 400;
  color: #EC2227;
}

.setone h4
{
  font-size: 16pt;
  font-family: 'Montserrat', sans-serif;
  font-weight: 400;
  color: #616161;
}

.setone h6
{
  text-align: left;
  font-size: 16pt;
  font-family: 'Montserrat', sans-serif;
}

.setone button
{
  font-size: 14pt;
  color: white;
  font-family: 'Montserrat', sans-serif;
  background-color: #EC2227;
  cursor: pointer;
  border-radius: 25px;
}

.reverse
{
  font-size: 14pt;
  color: white;
  font-family: 'Montserrat', sans-serif;
  background-color: #EC2227;
  cursor: pointer;
  border-radius: 25px;
}
</style>
