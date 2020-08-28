<template>
<div>
    <!-- <pre>{{player}}</pre> -->

    <a v-if="!player" class="btn btn-primary" @click="showModal('modal_new')" ref="#btnShow">{{ $t('addNew') }}</a>
    <a v-else class="btn btn-primary" @click="showModal('modal_'+player.id)" ref="#btnShow">{{ $t('edit') }}</a>

    <b-modal :id="player ? 'modal_'+player.id : 'modal_new'" :title="player ?   $t('edit')+' '+ player.name : $t('addNew')"  hide-footer>
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">{{ $t('name') }}</label>
            <div class="col-md-6">
                <input v-model="form.name" id="name" type="text" class="form-control" name="name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="level" class="col-md-4 control-label">{{ $t('Level') }}</label>
            <div class="col-md-6">
                <input v-model="form.level" id="level" min="0" max="99" type="number" class="form-control" name="level" required>
            </div>
        </div>
        <div class="form-group">
            <label for="class" class="col-md-4 control-label">{{ $t('Class') }}</label>
            <div class="col-md-6">
                <input v-model="form.class" id="class" type="text" class="form-control" name="class" required>
            </div>
        </div>
        <div v-if="$store.data">
            <div class="form-group">
                <label for="class" class="col-md-4 control-label">{{ $t('Game') }}</label>
                <div class="col-md-6" >
                    <select v-model="form.game_id">
                        <option v-for="game in $store.data.games" :key="game.id" :value="game.id" >
                            {{ game.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div v-for="param in $store.data.params.filter(p => p.game_id == form.game_id)" v-bind:key="param.id">
                <label for="class" class="col-md-4 control-label">{{param.name}}</label>
                <div class="col-md-6">
                    <input v-model="form.extra_params[param.name]"  type="text" class="form-control"  >
                </div>
            </div>
        </div>

        <b-button  v-if="!player" class="mt-3" block @click="addUpdate('modal_new')">{{ $t('addNew') }}</b-button>
        <b-button v-else class="mt-3" block @click="addUpdate('modal_'+player.id)">{{ $t('edit') }}</b-button>
        <!-- <b-button v-else class="mt-3" block @click="addUpdate()">{{ $t('edit') }}</b-button> -->
    </b-modal>
</div>
</template>

<script>
export default {
    name: 'newUpdatePlayer',
    props: {
        player: {
            type: Object,
            required: false,
        }
    },
    data() {
        return {
            form: this.player ? this.$store.clone(this.player) : {
                extra_params:{}
            },
        }
    },
    // created() {
    //     // if (localStorage.getItem('token'))
    //     //     this.preAddNew()
    //     // else
    //     //     this.$router.push('login')
    // },
    methods: {
        showModal(modal_name) {
            this.$root.$emit('bv::show::modal', modal_name, '#btnShow')
        },
        addUpdate(modal_name) {
            this.$root.$emit('bv::hide::modal', modal_name)
            this.$http.post('players', this.form).then(res => {
                console.log(res);
            this.$parent.getPlayers()
            })
        },
    }
}
</script>
<style lang="scss" >

</style>
