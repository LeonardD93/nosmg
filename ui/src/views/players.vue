<template lang="html">
    <div class="player_index">
        <h1>{{ $t('players') }}</h1>
        <div class="row">
            <!-- <div class='col-sm-1'></div> -->
            <div class="col-sm-6">
                <newUpdate/>
            </div>
        </div>
        <table id='player_table' class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>{{ $t('name') }}</th>
                    <!--<th>{{ $t('Game') }}</th>-->
                    <th>{{ $t('Level') }}</th>
                    <th>{{ $t('Class') }}</th>
                    <th>{{$t('extra_params')}}</th>

                    <th>{{ $t('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="player in $store.data.players" v-bind:key="player.id">
                    <td>{{player.name}}</td>
                    <!--<td>{{player.game()->first()->name}}</td>-->
                    <td>{{player.level}}</td>
                    <td>{{player.class}}</td>
                    <td>
                        <div v-for="(item, index) in player.extra_params" v-bind:key="item.id">
                            {{index}}:{{item}}
                        </div>
                    </td>
                    <td>
                         <newUpdate v-bind:player='player' />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import newUpdate from '../components/player/newUpdate.vue';
export default {
    components: {
        newUpdate
    },
    data() {
        return {
            //players: null,
            //paramas: null,
           //  test:[
           //     {name: 'Davido', genre: 'afrobeats', country: 'Nigeria'},
           //     {name: 'Burna Boy', genre: 'afrobeats', country: 'Nigeria'},
           // ]
          }
    },

    created() {
        if (!localStorage.getItem('token'))
            this.$router.push('login')
        // else
        //     this.getPlayers()
    },

    methods: {
        getPlayers() {
            this.$http.get('players').then(res => {
                //console.log(res.data)
                //this.players = res.data.data
                this.$store.data.players=res.data.data
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
