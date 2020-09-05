 <template>
  <input
    type="submit"
    class="btn btn-danger d-block w-100 mb-2"
    value="Eliminar x"
    @click="eliminarReceta"
  />
</template>

 
<script>
export default {
  props: ["recetaId"],
  methods: {
    eliminarReceta() {
      /* funcion de sweet2alert , en este caso salta una alerta */
      this.$swal({
        title: "Estas Seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        confirmButtonText: "Si",
      }).then((result) => {
        if (result.value) {
          const params = {
            id: this.recetaId,
          };
          //Enviar la Petición al Servidor

          axios
            .post(`/recetas/${this.recetaId}`, {
              params,
              _method: "delete",
            })
            .then((respuesta) => {
              this.$swal({
                title: "Receta Eliminada",
                text: "Se elimino la receta",
                icon: "success",
              });

              //ELIMINA LA RECETA DEL DOM PARA QUE SE ACTUALIZE AUTOMATICAMENTE
              this.$el.parentNode.parentNode.parentNode.removeChild(
                this.$el.parentNode.parentNode
              );
            })

            .catch((error) => {
              console.log(error);
            });

          this.$swal({
            title: "Receta Eliminada",
            text: "Se elimino la receta",
            icon: "success",
          });
        }
      });
    },
  },
};
</script>




