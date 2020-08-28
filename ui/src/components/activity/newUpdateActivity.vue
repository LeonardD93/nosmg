<template>
<div>
    <!-- <a class="btn btn-primary" v-b-modal.modal-1>{{ $t('addNew') }}</a> -->
    <!-- <a v-if="!activity" class="btn btn-primary" @click="showModal('modal_new')" ref="#btnShow">{{ $t('addNew') }}</a>
    <a v-else class="btn btn-primary" @click="showModal('modal_'+activity.id)" ref="#btnShow">{{ $t('edit') }}</a> -->

    <b-modal :title="activity ?   $t('edit')+' '+ activity.name : $t('addNew')" :visible="true" @hide="$emit('close')" hide-footer size="xl">
        <!-- <b-modal id="modal-1" title="Add new Activity" hide-footer> -->
        <form @submit.prevent="addUpdate()">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name" class="col-md-4 control-label">{{ $t('name') }}</label>
                    <input id="name" v-model="form.name" type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="player" class="col-md-4 control-label">{{ $t('Organizer') }}</label>
                    <b-select v-model="form.organizer_id">
                        <option v-for="player in $store.data.players" :value="player.id" :key="player.id">
                            {{ player.name }}
                        </option>
                    </b-select>
                </div>
                <div class="form-group col-md-6">
                    <label for="start_date" class="col-md-4 control-label">{{ $t('Start_date') }}</label>
                    <input id="start_date" v-model="form.start_date" type="date" class="form-control" name="start_date" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="start_time" class="col-md-4 control-label">{{ $t('Date_time') }}</label>
                    <input id="start_time" v-model="form.start_time" type="time" class="form-control" name="start_time" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="level_req" class="col-md-4 control-label">{{ $t('Level_required') }}</label>
                    <input id="level_req" v-model="form.level_req" min="0" max="99" type="number" class="form-control" name="level_req" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="activityType" class="col-md-4 control-label">{{ $t('Activity_type') }}</label>
                    <b-select v-model="form.type_id">
                        <option v-for="activityType in $store.data.activitiesType" :value="activityType.id" :key="activityType.id">
                            {{ activityType.name }}
                        </option>
                    </b-select>
                </div>
                <div class="form-group col-md-6">
                    <label for="users_number" class="col-md-4 control-label">{{ $t('Users_number') }}</label>
                    <input id="users_number" v-model="form.users_number" min="0" max="99" type="number" class="form-control" name="users_number" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="other_req" class="col-md-4 control-label">{{ $t('Other_requests') }}</label>
                    <textarea id="other_req" v-model="form.other_req" class="form-control" name="other_req"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <b-button type="submit" class="mt-3 " block>
                        {{ activity ? $t('edit') : $t('addNew') }}
                    </b-button>
                </div>
                <div class="col-sm-6">
                    <b-button class="mt-3" variant="danger" block @click="$emit('close')">
                        {{ $t('cancel') }}
                    </b-button>
                </div>
            </div>            
        </form>
    </b-modal>
</div>
</template>

<script>
export default {
    name: 'newUpdateActivity',
    props: {
        activity: {
            type: Object,
            required: false,
        }
    },
    data() {
        return {
            form: this.activity ? this.$store.clone(this.activity) : {
                // extra_params:{}
            },
        }
    },
    methods: {
        addUpdate() {
            this.$http.post('activities', this.form).then(res => { //richiesta al server
                console.log(res)
                this.$parent.getActivities() //ricarico i dati
            })
        },
    }
}
</script>

<style lang="scss" >

</style>
