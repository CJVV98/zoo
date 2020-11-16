<template>
  <div class="row justify-content-center">
    <div class="col-8">
      <br />
      <center><h1>Control y registro de animales</h1></center>
      <br />
      <b-table striped hover :items="animales" :fields="campos">
        <template #cell(num_identificacion)="dato">
          <b-link @click="informacion(dato.item, $event.target)">{{
            dato.value
          }}</b-link>
        </template>
        <template #cell(actions)="row">
          <b-button variant="success" @click="editar(row.item, $event.target)"
            >Editar</b-button
          >
          <b-button variant="danger"  @click="eliminar(row.item, row.index)">Eliminar</b-button>
        </template>
      </b-table>
      <b-button variant="info" @click="agregar($event.target)"
        >Agregar Animal</b-button
      >
   
        <b-modal
          ref="modal-animal"
          :id="datosModal.id"
          :title="datosModal.title"
          hide-footer
          @hide="limpiarDatosModal"
        >
          <b-form @submit.prevent="modificar(animal)" v-if="habilitarEdicion">
            <h3>Editar animal</h3>
            <br>
            <b-form-group
              id="input-group-1"
              label="Numero de identificacion:"
              label-for="input-id"
            >
              <b-form-input
                id="input-id"
                v-model="animal.num_identificacion"
                name="num_identificacion"
                type="text" required :disabled="true"
                placeholder="Ingrese un número de identificación"
              ></b-form-input>

                 </b-form-group>
            
            <b-form-group
              id="input-group-2"
              label="Sexo :"
              label-for="input-sexo"
            >
              <b-form-select
                id="input-sexo"
                v-model="animal.sexo"
                :options="sexo"
                required
              ></b-form-select>
            </b-form-group>

            <b-form-group
              id="input-group-3"
              label="Continente :"
              label-for="input-continente"
            >
              <b-form-select
                id="input-continente"
                v-model="animal.continente"
                :options="continentes"
                required
              ></b-form-select>
            </b-form-group>

            <b-form-group
              id="input-group-4"
              label="País de Origen:"
              label-for="input-pais"
            >
              <b-form-input
                id="input-pais"
                v-model="animal.pais_origen"
                type="text"
                required
                placeholder="Ingrese un país de origen"
              ></b-form-input>
            </b-form-group>


            <b-form-group
              id="input-group-7"
              label="Año de nacimiento:"
              label-for="input-anio"
            >
              <b-form-input
                id="input-anio"
                v-model="animal.anio_nacimiento"
                type="text"
                required
                placeholder="Ingrese un año de nacimiento"
              ></b-form-input>
            </b-form-group>
            <button class="btn btn-warning" type="submit">Editar</button>
            <button class="btn btn-danger"  @click="cancelarEdicion">Cancelar</button>
          </b-form>
          <b-form @submit.prevent="insertar"  v-else>
            <b-form-group
              id="input-group-1"
              label="Numero de identificacion:"
              label-for="input-id"
            >
              <b-form-input
                id="input-id"
                v-model="animal.num_identificacion"
                name="num_identificacion"
                type="text" required
                placeholder="Ingrese un número de identificación"
              ></b-form-input>

                 </b-form-group>
            
            <b-form-group
              id="input-group-2"
              label="Sexo :"
              label-for="input-sexo"
            >
              <b-form-select
                id="input-sexo"
                v-model="animal.sexo"
                :options="sexo"
                required
              ></b-form-select>
            </b-form-group>

            <b-form-group
              id="input-group-3"
              label="Continente :"
              label-for="input-continente"
            >
              <b-form-select
                id="input-continente"
                v-model="animal.continente"
                :options="continentes"
                required
              ></b-form-select>
            </b-form-group>

            <b-form-group
              id="input-group-4"
              label="País de Origen:"
              label-for="input-pais"
            >
              <b-form-input
                id="input-pais"
                v-model="animal.pais_origen"
                type="text"
                required
                placeholder="Ingrese un país de origen"
              ></b-form-input>
            </b-form-group>


            <b-form-group
              id="input-group-7"
              label="Año de nacimiento:"
              label-for="input-anio"
            >
              <b-form-input
                id="input-anio"
                v-model="animal.anio_nacimiento"
                type="text"
                required
                placeholder="Ingrese un año de nacimiento"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-5"
              label="Especie :"
              label-for="input-especie"
            >
              <b-form-select
                id="input-especie"
                v-model="animal.especie_id"
                :options="especies"
                value-field="id_especie"
                text-field="nombre_vulgar"
                required
              ></b-form-select>
            </b-form-group>

            <b-form-group
              id="input-group-6"
              label="Zoologico :"
              label-for="input-zoo"
            >
              <b-form-select
                id="input-zoo"
                v-model="animal.zoologico_id"
                :options="zoologicos"
                value-field="id_zoologico"
                text-field="nombre"
                required
              ></b-form-select>
            </b-form-group>
            <br>
            <button class="btn btn-primary" type="submit">Agregar</button>
          </b-form>
        </b-modal>
  

      <b-modal
        :id="infoModal.id"
        :title="infoModal.title"
        ok-only
        @hide="limpiarInfoModal"
      >
        <div>
          <b-card no-body>
            <b-tabs card>
              <b-tab title="Datos Animal" active>
                <b-card-text
                  >N identificacion:
                  {{ infoModal.datosAnimal.num_identificacion }}</b-card-text
                >
                <b-card-text
                  >Sexo: {{ infoModal.datosAnimal.sexo }}</b-card-text
                >
                <b-card-text
                  >Año de nacimiento:
                  {{ infoModal.datosAnimal.anio_nacimiento }}
                </b-card-text>
                <b-card-text
                  >País origen: {{ infoModal.datosAnimal.pais_origen }}
                </b-card-text>
                <b-card-text
                  >Continente: {{ infoModal.datosAnimal.continente }}
                </b-card-text>
              </b-tab>
              <b-tab title="Datos Especie">
                <b-card-text
                  >Nombre vulgar:
                  {{ infoModal.datosAnimal.nombre_vulgar }}</b-card-text
                >
                <b-card-text
                  >Nombre cientifico:
                  {{ infoModal.datosAnimal.nombre_cientifico }}</b-card-text
                >
                <b-card-text
                  >Familia: {{ infoModal.datosAnimal.familia }}
                </b-card-text>
                <b-card-text
                  >Peligro de extincion:
                  <span v-if="infoModal.datosAnimal.peligro_extinsion == 1"
                    >Sí</span
                  >
                  <span v-else>No</span>
                </b-card-text>
              </b-tab>
              <b-tab title="Datos Zoologico">
                <b-card-text
                  >Nombre: {{ infoModal.datosAnimal.nombre }}
                </b-card-text>
                <b-card-text
                  >Ciudad: {{ infoModal.datosAnimal.ciudad }}
                </b-card-text>
                <b-card-text
                  >Pais: {{ infoModal.datosAnimal.pais }}
                </b-card-text>
              </b-tab>
            </b-tabs>
          </b-card>
        </div>
      </b-modal>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      animales: [],
      zoologicos: [],
      especies: [],
      sexo: [{ text: "Seleccionar..", value: null }, "Hembra", "Macho"],
      continentes: [
        { text: "Seleccionar..", value: null },
        "America",
        "Europa",
        "Asia",
        "Oceania",
        "Africa",
      ],
      animal: {
        num_identificacion: "",
        especie_id: 0,
        zoologico_id: 0,
        sexo: "",
        anio_nacimiento: 0,
        pais_origen: "",
        continente: "",
      },
      habilitar: false,
      habilitarEdicion: true,
      campos: [
        {
          key: "num_identificacion",
          label: "N identificacion",
          sortable: true,
        },
        {
          key: "nombre_vulgar",
          label: "Nombre especie",
          sortable: true,
        },
        {
          key: "sexo",
          label: "Sexo",
          sortable: true,
        },
        {
          key: "pais_origen",
          label: "Pais",
          sortable: true,
        },
        {
          key: "actions",
          label: "Opciones",
          sortable: false,
        },
      ],
      infoModal: {
        id: "info-modal",
        title: "",
        datosAnimal: "",
      },
      datosModal: {
        id: "dato-modal",
        title: "Datos Animal",
      },
    };
  },
 
  
  created() {
    axios.get("/animales").then((res) => {
      this.animales = res.data;
    });
  },
  methods: {

   async insertar() {
        const animalInsertado=this.animal;
        this.animal={n_identificacion: "", especie_id: 0, zoologico_id: 0, sexo: "", anio_nacimiento: 0,
        pais_origen: "",continente: "",}, 
        axios.post('/animales', animalInsertado)
            .then((res) =>{
                const animalRegistrado = res.data;
                 alert('Registro exitoso');   
        });
        this.actualizarDatos();
        this.$refs['modal-animal'].hide();
    },
    actualizarDatos(){
         axios.get("/animales").then((res) => {
            this.animales = res.data;  
        });
    },
    informacion(item, button) {
      this.infoModal.title = `Especie : ${item.nombre_vulgar}`;
      axios.get(`/animales/${item.num_identificacion}`).then((res) => {
        this.infoModal.datosAnimal = res.data[0];
      });

      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    async agregar(button) {
      axios.get("/especies").then((res) => {
        this.habilitar = true;
        this.habilitarEdicion = false;
        this.especies = res.data;
      });
      axios.get("/zoologicos").then((resZoo) => {
        this.zoologicos = resZoo.data;
        this.$root.$emit("bv::show::modal", this.datosModal.id, button);
      });
    },
    async eliminar(item, index) {
          const confirmacion = confirm(`Desea eliminar animal # ${item.num_identificacion}`);
          if(confirmacion){
            axios.delete(`/animales/${item.num_identificacion}`);
             alert('Eliminación exitosa');  
            this.actualizarDatos();
          }
    },
    async modificar(animal){
        const params = {num_identificacion: animal.num_identificacion, sexo: animal.sexo, anio_nacimiento:animal.anio_nacimiento,
                        pais_origen:animal.pais_origen, continente:animal.continente};
        console.log(params);
        axios.put(`/animales/${this.animal.num_identificacion}`, params).then((res) => {
            alert('Actualización exitosa');   
        });
       
        this.actualizarDatos();
        this.$refs['modal-animal'].hide();

    },
    editar(item, button) {
      
      this.habilitar = true;
      this.habilitarEdicion = true;
      this.animal=item;
      this.$refs['modal-animal'].show();
      console.log('lola');
      console.log(this.habilitar);
      console.log(this.habilitarEdicion);
    },
    cancelarEdicion(){
      this.habilitarEdicion = false;
       this.animal={n_identificacion: "", especie_id: 0, zoologico_id: 0, sexo: "", anio_nacimiento: 0,
                     pais_origen: "",continente: "",}; 
    },
    limpiarInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
    },
    limpiarDatosModal() {
      this.datosModal.title = "";
      this.datosModal.content = "";
      this.habilitar = false;
    },
  },
};
</script>
