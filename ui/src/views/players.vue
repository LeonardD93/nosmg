<template lang="html">
    <b-container class="player_index">
        <div class="card">
            <div class="card-body">
                <div class="row my-3 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="my-0">{{ $t('players') }}</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <b-button variant="outline-primary" @click="new_player = true">
                            <b-icon icon="plus"/>
                            {{ $t('addNew') }}
                        </b-button>
                    </div>
                </div>
            </div>
            <table id='player_table' class="table table-striped table-hover table-sm ">
                <thead class="thead-light">
                    <tr>
                        <th>{{ $t('name') }}</th>
                        <th>{{ $t('Game') }}</th>
                        <th>{{ $t('Level') }}</th>
                        <th>{{ $t('Class') }}</th>
                        <!-- <th>{{$t('extra_params')}}</th> -->

                        <th class="text-right">{{ $t('Actions') }}</th>
                    </tr>
                </thead>
                <tbody >

                    <tr v-for="player in $store.data.players" :key="player.id">
                        <td>{{player.name}}</td>
                        <td>{{player.game.name}}</td>
                        <td>{{player.level}}</td>
                        <td>{{player.class}}</td>
                        <!-- <td>
                            <div v-for="(item, index) in player.extra_params" :key="item.id" class="extra-param" v-tooltip="`${index}`">
                                {{index}}:
                                {{item}}
                            </div>
                        </td> -->
                        <td class="text-right">
                            <b-button variant="outline-danger" @click.prevent="deletePlayer(player)">
                              <b-icon icon="trash"/>
                            </b-button>
                            <b-button @click="selected_player = player" variant="outline-primary" class="ml-1">
                                 <b-icon icon="pencil"/>
                            </b-button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <newUpdatePlayer v-if="new_player" @close="new_player = false" />
            <newUpdatePlayer v-if="selected_player" :player="selected_player" @close="selected_player = null"/>
        </div>
    </b-container>
</template>

<script>
import newUpdatePlayer from '../components/player/newUpdatePlayer.vue';
export default {
    components: {
        newUpdatePlayer
    },
    data() {
        return {
            new_player: false,
            selected_player: null,
          }
    },

    created() {
        if (!localStorage.getItem('token'))
            this.$router.push('login')
    },

    methods: {
        getPlayers() {
            this.$http.get('players').then(res => {
                this.$store.data.players=res.data.data
            })
        },
        deletePlayer(player){
            if(confirm("Sei sicuro di voler cancellare "+player.name+" e i suoi dati associati?")){
                this.$http.post('players/destroy',player).then(() => {
                    this.getPlayers()

                })
            }
        }



        // deleteUser(game) {
        //   this.$http.delete('elimina/'+game.id).then(() => {
        //     this.refreshGames()
        //   })
        // },
    },

}
</script>

<style lang="scss">
.player_index {
    // table {
    //     th {
    //         height: 4rem;
    //     }
    //     tr {
    //         td, th {
    //             &:first-child {
    //                 padding-left: 2rem;
    //             }
    //                 &:last-child {
    //                     padding-right: 2rem;
    //                 }
    //         }
    //     }
    // }
    .extra-param {
        background: var(--primary);
        padding: .1rem .5rem;
        display: inline-block;
        margin: .1rem;
        border-radius: 3rem;
        color: #fff;
    }
}
</style>
