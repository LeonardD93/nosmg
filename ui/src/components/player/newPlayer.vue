<template>
<div>
    <a class="btn btn-primary" v-b-modal.modal-1>#Add new##</a>
    <b-modal id="modal-1" title="Add new Player" hide-footer>

        <div class="form-group">
            <label for="name" class="col-md-4 control-label">#Name##</label>
            <div class="col-md-6">
                <input v-model="form.name" id="name" type="text" class="form-control" name="name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="level" class="col-md-4 control-label">#Level##</label>
            <div class="col-md-6">
                <input v-model="form.level" id="level" min="0" max="99" type="number" class="form-control" name="level" required>
            </div>
        </div>

        <div class="form-group">
            <label for="class" class="col-md-4 control-label">#Class##</label>
            <div class="col-md-6">
                <input v-model="form.class" id="class" type="text" class="form-control" name="class" required>
            </div>
        </div>
        <div class="">
            <select v-model="form.game_id">
                <option v-for="game in $store.data.games" :key="game.id" :value="game.id">
                    {{ game.name }}
                </option>
            </select>
        </div>
        <div v-for="param in $store.data.params.filter(p => p.game_id == form.game_id)" v-bind:key="param.id">
            <label for="class" class="col-md-4 control-label">#{{param.name}}##</label>
            <div class="col-md-6">
                <input v-model="form.extra_params[param.name]"  type="text" class="form-control"  >
            </div>

        </div>
        <pre>{{form}}</pre>



        <b-button class="mt-3" block @click="addNew()">#Add new##</b-button>
    </b-modal>
</div>
</template>

<script>
export default {
    name: 'newPlayer',
    prop: {
        player: {
            type: Object,
            required: false,
        }
    },
    data() {
        return {
            games:null,
            params:null,
            form: this.player ? this.$store.clone(this.player) : {
                extra_params:{}
            },
        }
    },
    created() {
        // if (localStorage.getItem('token'))
        //     this.preAddNew()
        // else
        //     this.$router.push('login')
    },
    methods: {
        preAddNew() {
            this.games = this.$store.data.games
            this.params = this.$store.data.params
            this.params.forEach(param=>{
                console.log(param)
                //this.form.extra_params.push({param.name :''})
            })
            console.log(this.form.extra_params)
        },
        addNew() {
            this.$root.$emit('bv::hide::modal', 'modal-1')
            this.$http.post('players', this.form).then(res => {
            console.log(res)
            console.log('modal closed')
            })
        },
    }
}
</script>
<style lang="scss" >

</style>
