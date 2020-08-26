<template>
<div>
    <a class="btn btn-primary" v-b-modal.modal-1>{{ $t('addNew') }}</a>
    <b-modal id="modal-1" title="Add new Activity" hide-footer>
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">{{ $t('name') }}</label>
            <div class="col-md-6">
                <input id="name" v-model="activity.name" type="text" class="form-control" name="name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="player" class="col-md-4 control-label">{{ $t('Player') }}</label>
            <select v-model="activity.organizer_id">
                <option v-for="player in players" v-bind:value="player.id" v-bind:key="player.id">
                    {{ player.name }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date" class="col-md-4 control-label">{{ $t('Start_date') }}</label>
            <div class="col-md-6">
                <input id="start_date" v-model="activity.start_date" type="date" class="form-control" name="start_date" required>
            </div>
        </div>
        <div class="form-group">
            <label for="start_time"  class="col-md-4 control-label">{{ $t('Date_time') }}</label>
            <div class="col-md-6">
                <input id="start_time" v-model="activity.start_time" type="time" class="form-control" name="start_time" required>
            </div>
        </div>
        <div class="form-group">
            <label for="level_req" class="col-md-4 control-label">{{ $t('Level_required') }}</label>
            <div class="col-md-6">
                <input id="level_req" v-model="activity.level_req" min="0" max="99" type="number" class="form-control" name="level_req" required>
            </div>
        </div>
        <div class="form-group">
            <label for="activityType" class="col-md-4 control-label">{{ $t('Activity_type') }}</label>
            <select v-model="activity.type_id">
                <option v-for="activityType in activitiesType" v-bind:value="activityType.id" v-bind:key="activityType.id">
                    {{ activityType.name }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="users_number" class="col-md-4 control-label">{{ $t('Users_number') }}</label>
            <div class="col-md-6">
                <input id="users_number" v-model="activity.users_number" min="0" max="99" type="number" class="form-control" name="users_number" required>
            </div>
        </div>
        <div class="form-group">
            <label for="other_req" class="col-md-4 control-label">{{ $t('Other_requests') }}</label>
            <div class="col-md-6">
                <textarea id="other_req" v-model="activity.other_req"  class="form-control" name="other_req" ></textarea>
            </div>
        </div>
<!-- da scegliere il player, in base al player le activity type devono cambiare in quanto sono associate a un gioco
quindi nel for activity type ci deve essere if player.game_id==activityType.game_id-->

        <b-button class="mt-3" block @click="addNew()">{{ $t('addNew') }}</b-button>
    </b-modal>
</div>
</template>

<script>
export default {
    name: 'newActivity',
    data() {
        return {
            players: '',
            activitiesType: '',
            activity:{
                name:'',
                organizer_id:'',
                start_date:'',
                start_time:'',
                level_req:'',
                type_id:'',
                users_number:'',
                other_req:''
            },
        }
    },
    created() {
        if (localStorage.getItem('token'))
            this.preAddNew()
        else
            this.$router.push('login')
    },
    methods: {
        preAddNew() {
            this.players = JSON.parse(localStorage.getItem('players'))
            this.activitiesType = JSON.parse(localStorage.getItem('activitiesType'))
        },
        addNew() {
            this.$root.$emit('bv::hide::modal', 'modal-1') //chiudo finestra modale
            //console.log(this.activity)
            this.$http.post('activities', this.activity).then(res => { //richiesta al server
                console.log(res)
                this.$parent.getActivities(true) //ricarico i dati
            })
        },
    }
}
</script>

<style lang="scss" >

</style>
