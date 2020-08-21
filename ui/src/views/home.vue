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

  <!-- <div class="container-fluid">
      <div class="title"><h1>NosMG</h1></div>

      <div class="row justify-content-center">
          <div class="col-md-8">
               <h3>{{ __('messages.welcome_home') }}</h3>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <a href="players" class="btn btn-primary button-home">{{ __("Your's Playable Characters") }}</a>
          </div>
      <div class="col-sm-6">
          <a href="activities.index" class="btn btn-primary button-home">{{ __('Activities') }}</a>
      </div>
      </div>
  </div> -->


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
