<template>
  <div class="page-home">
    <b-container class="mt-5">
      <template v-if="!games">
        Loading...
      </template>
      <template v-else>
        Ci sono {{ games.length }} giochi
        <b-card v-for="game in games" :key="game.id" class="my-3">
          <b>{{ game.name }}</b>

          <a href="#" class="text-danger float-right" @click.prevent="deleteUser(game)">
            <b-icon icon="trash"/>
          </a>
        </b-card>
      </template>
    </b-container>
  </div>

</template>

<script>
export default {
  data () {
    return {
      prova: 'Test',
      games: null,
    }
  },

  created() {
    if(localStorage.getItem('token'))
      this.refreshGames()
    else
      this.$router.push('login')
  },

  methods: {
    refreshGames() {
      this.$http.get('esempio').then(res => {
        this.games = res.data
      })
    },

    deleteUser(game) {
      this.$http.delete('elimina/'+game.id).then(() => {
        this.refreshGames()
      })
    },
  },
}
</script>

<style lang="scss">
</style>
