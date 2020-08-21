<template lang="html">
  <div class="player_index">
    <h1>Players</h1>
    <div class="row">
        <div class="col-sm-6">
            <a href='#}' class="btn btn-primary ">#Add new##</a>
        </div>
    </div>


      <table id='player_table' class="table table-striped table-bordered">
          <thead>
              <tr>

                  <th>#Name##</th>
                  <!--<th>#Game##</th>-->
                  <th>#Level##</th>
                  <th>#Class##</th>
                  <!-- @foreach($params as $param)
                   <th>{{$param->name}}</th>
                  @endforeach -->
                  <th>#Actions##</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="player in players" v-bind:key="player.id">
                  <td>{{player.name}}</td>
                  <!--<td>{{player.game()->first()->name}}</td>-->
                  <td>{{player.level}}</td>
                  <td>{{player.class}}</td>

                   <!-- @foreach(player.params()->get() as $param)
                   <td>{{$param->pivot->value}}</td>
                   @endforeach -->

                  <td>
                      <!-- @if($user->id==player.user_id)
                          <a class="btn btn-info btn-sm" href='{{route('players.edit', $player)}}'>edit</a>
                          <form action="{{route('players.destroy', $player)}}" method="post" data-message="Delete this Thing?" class="delete_form">
                               @method('DELETE')
                               @csrf
                              <input class="btn btn-info btn-sm" type="submit" value="Delete" />

                          </form>
                      @endif -->

                  </td>
              </tr>
          </tbody>
      </table>


  </div>
</template>

<script>
export default {
  data () {
    return {
      players: null,
      paramas: null,
    }
  },

  created() {
    if(localStorage.getItem('token'))
      this.getPlayers()
    else
      this.$router.push('login')
  },

  methods: {
    getPlayers() {
      this.$http.get('players').then(res => {
        console.log(res.data)
        this.players = res.data
      })
    },

    // deleteUser(game) {
    //   this.$http.delete('elimina/'+game.id).then(() => {
    //     this.refreshGames()
    //   })
    // },
  },

}
</script>

<style lang="scss">
</style>
