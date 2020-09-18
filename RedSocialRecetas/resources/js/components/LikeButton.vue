<template>
  <div>
    <span class="like-btn" v-on:click="likeReceta" :class="{ 'like-active' : this.like}"></span>

    <p>{{cantidadLikes }} Les gustó esta receta</p>
  </div>
</template>

<script>
export default {
  props: ["recetaId", "like", "likes"],
  data: function () {
    return {
      totalLikes: this.likes,
    };
  },
  mounted() {
    //componente dimount
    console.log(this.like);
  },
  methods: {
    likeReceta() {
      axios
        .post("/recetas/" + this.recetaId)
        .then((respuesta) => {
          if (resputa.data.attached.length > 0) {
            this.$data.totalLikes++;
          } else {
            this.$data.totalLikes--;
          }
        })
        .catch((error) => {
          console.log("esteo es el error", error);
        });
    },
  },

  computed: {
    cantidadLikes: function () {
      return this.likes;
    },
  },
};
</script>

