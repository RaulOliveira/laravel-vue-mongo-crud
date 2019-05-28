
<template>
  <div>
    <form v-on:submit="saveForm()">
      <div class="form-group">
          <label class="control-label">Marca</label>
          <input type="text"
                 v-model="soda.brand"
                 class="form-control"
                 placeholder="Ex. BigGym, Wilson, Grappete etc"
                 required>
        </div>
        <div class="form-group">
          <label class="control-label">Litragem</label>
          <select v-model="soda.liters"
                  class="form-control"
                  required>
                    <option disabled value="">--</option>
                    <option v-for="option in liters.options" v-bind:value="option.value">
                        {{ option.text }}
                    </option>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label">Tipo</label>
          <select v-model="soda.type"
                  class="form-control"
                  required>
                    <option disabled value="">--</option>
                    <option v-for="option in type.options" v-bind:value="option.value">
                        {{ option.text }}
                    </option>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label">Quantidade</label>
          <input type="number"
                 v-model="soda.quantity"
                 class="form-control"
                 required>
        </div>
        <div class="form-group">
          <label class="control-label">Preço por unidade</label>
          <input type="text"
                 v-model="soda.pricePerUnit"
                 class="form-control"
                 required>
        </div>
        <div class="form-group">
          <button class="btn btn-success">Salvar</button>
          <router-link to="/" class="btn btn-secondary">Voltar</router-link>
        </div>
    </form>
  </div>
</template>
<script>
export default {
  mounted() {
    let app = this;
    let id = app.$route.params.id;
    app.sodaId = id;
    axios
      .get("/api/v1/sodas/" + id)
      .then(function(resp) {
        app.soda = resp.data;
      })
      .catch(function() {
        alert("Não foi possivel obter os dados desse refrigerante");
      });
  },
  data: function() {
    return {
      sodaId: null,
      soda: {
        brand: "",
        liters: "",
        type: "",
        quantity: "",
        pricePerUnit: ""
      },
      liters: {
        options: [
            { text: '250ml', value: '250ml' },
            { text: '600ml', value: '600ml' },
            { text: '1l', value: '1l' },
            { text: '1.5l', value: '1.5l' },
            { text: '2l', value: '2l' },
            { text: '3l', value: '3l' }
        ]
      },
      type:{
        options: [
            { text: 'Pet', value: 'Pet' },
            { text: 'Garrafa', value: 'Garrafa' },
            { text: 'Lata', value: 'Lata' }
        ]
      }
    };
  },
  methods: {
    saveForm() {
      event.preventDefault();
      var app = this;
      var newSoda = app.soda;
      axios
        .patch("/api/v1/sodas/" + app.sodaId, newSoda)
        .then(function(resp) {
          app.$router.replace("/");
        })
        .catch(function(resp) {
          console.log(resp);
          alert("Não foi possivel atualizar os dados desse refrigerante");
        });
    }
  }
};
</script>
