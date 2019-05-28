<template>
  <v-app>
    <v-card>
      <v-card-title>
        <router-link :to="{name: 'createSoda'}" class="btn btn-primary">Adicionar refrigerante</router-link>
        <v-spacer></v-spacer>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      </v-card-title>
      <v-data-table :headers="headers" :items="sodas" :search="search">
        <template v-slot:items="props">
          <td>{{ props.item.brand }}</td>
          <td class="text-xs-right">{{ props.item.liters }}</td>
          <td class="text-xs-right">{{ props.item.type }}</td>
          <td class="text-xs-right">{{ props.item.quantity }}</td>
          <td class="text-xs-right">{{ props.item.pricePerUnit }}</td>
          <td class="text-xs-right">
              <router-link
              :to="{name: 'editSoda', params: {id: props.item._id}}"
              class="btn btn-xs btn-secondary"
              >Editar</router-link>
              <a href="#" class="btn btn-xs btn-danger" v-on:click="deleteEntry(props.item._id, props.index)">Deletar</a>
          </td>
        </template>
        <template v-slot:no-results>
          <v-alert
            :value="true"
            color="error"
            icon="warning"
          >Your search for "{{ search }}" found no results.</v-alert>
        </template>
      </v-data-table>
    </v-card>
  </v-app>
</template>
<script>
export default {
    data () {
      return {
        search: "",
        totalSodas: 0,
        sodas: [],
        loading: true,
        pagination: {
            rowsPerPage: 10
        },

        headers: [
          {
            text: 'Marca',
            align: 'left',
            value: 'brand'
          },
          { text: "Litragem", value: "liters" },
          { text: "Tipo", value: "type" },
          { text: "Quantidade", value: "quantity" },
          { text: "Preço por unidade", value: "pricePerUnit" },
          { text: "Ações", value: "action" }
        ]
      }
    },
    watch: {
      pagination: {
        handler () {
          this.getDataFromApi()
            .then(data => {
              this.sodas = data.items
              this.totalSodas = data.total
            })
        },
        deep: true
      }
    },
    mounted () {
      this.getDataFromApi()
        .then(data => {
          this.sodas = data.items
          this.totalSodas = data.total
        })
    },
    methods: {
      deleteEntry(id, index){
          if( confirm("Tem certeza que deseja deletar esse item?") ){
              var app = this;
              axios
                .delete("/api/v1/sodas/"+id)
                .then(function(resp){
                    app.sodas.splice(index, 1);
                })
                .catch(function(resp){
                    alert('Não foi possivel deletar este refrigerante');
                })
          }
      },
      getDataFromApi () {
        this.loading = true
        return new Promise((resolve, reject) => {
          const { sortBy, descending, page, rowsPerPage } = this.pagination

          let items = this.getSodas()
          const total = items.length

          if (this.pagination.sortBy) {
            items = items.sort((a, b) => {
              const sortA = a[sortBy]
              const sortB = b[sortBy]

              if (descending) {
                if (sortA < sortB) return 1
                if (sortA > sortB) return -1
                return 0
              } else {
                if (sortA < sortB) return -1
                if (sortA > sortB) return 1
                return 0
              }
            })
          }

          if (rowsPerPage > 0) {
            items = items.slice((page - 1) * rowsPerPage, page * rowsPerPage)
          }

          setTimeout(() => {
            this.loading = false
            resolve({
              items,
              total
            })
          }, 1000)
        })
      },
      getSodas () {
        var app = this;
        axios
            .get("/api/v1/sodas")
            .then(res => {
                this.sodas = res.data;
                this.totalSodas = res.data.length;
             }).catch(function(resp) {
                console.log(resp);
                alert('Não foi possivel obter lista de refrigerantes');
            })

        //return this.sodas;

      }
    }
  }
</script>
