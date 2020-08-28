<template lang="html">
    <b-container class="activity_index">
        <div class="card">
            <div class="card-body">
                <div class="row my-3 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="my-0">{{ $t('activities') }}</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <b-button variant="outline-primary" @click="new_activity = true">
                            <b-icon icon="plus"/>
                            {{ $t('addNew') }}
                        </b-button>
                    </div>
                </div>
            </div>
            <table id='activities_table' class="table table-striped table-hover table-sm table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>{{ $t('name') }}</th>
                        <th class="d-none d-sm-table-cell">{{ $t('Organizer') }}</th>
                        <th>{{ $t('Start_date') }}</th>
                        <th>{{ $t('Date_time') }}</th>
                        <th class="d-none d-sm-table-cell">{{ $t('Level_required') }}</th>
                        <th>{{ $t('Type') }}</th>
                        <th class="d-none d-sm-table-cell">{{ $t('Macrocategory') }}</th>
                        <th class="d-none d-sm-table-cell">{{ $t('User_number') }}</th>
                        <th class="d-none d-sm-table-cell">{{ $t('Other_Requests') }}</th>
                        <th class="text-right">{{ $t('Actions') }}</th>

                    </tr>
                </thead>
                <tbody >
                    <!-- <pre>{{$store.data.user.id}}</pre>
                    <pre>{{$store.data.games}}</pre> -->
                    <tr v-for="activity in $store.data.activities" :key="activity.id">
                        <td>{{activity.name}}</td>
                        <td class="d-none d-sm-table-cell">{{activity.organizer_name}}</td>
                        <td>{{activity.start_date}}</td>
                        <td>{{activity.start_time}}</td>
                        <td class="d-none d-sm-table-cell">{{activity.level_req}}</td>
                        <td>{{activity.type_name}}</td>
                        <td class="d-none d-sm-table-cell">{{activity.macrocategory}}</td>
                        <td class="d-none d-sm-table-cell">{{activity.users_number}}</td>
                        <td class="d-none d-sm-table-cell">{{activity.other_req}}</td>

                        <td class="text-right">
                            <activityPartecipants :activity='activity'/>
                            <div v-if="activity.user_organizer_id==$store.data.user.id">
                                <b-button variant="outline-danger" @click.prevent="deleteActivity(activity)">
                                    <b-icon icon="trash"/>
                                </b-button>
                                <b-button @click="selected_activity = activity" variant="outline-primary" class="ml-1">
                                    <b-icon icon="pencil"/>
                                </b-button>
                            </div>
                            <div v-else>
                                <b-button variant="outline-primary" class="ml-1" @click="ask_to_partecipate(activity)" >
                                    {{ $t('askToPartecipate') }}
                                </b-button>
                            </div>
                        </td>
                    </tr>
                </tbody>
        </table>
              <newUpdateActivity v-if="new_activity" @close="new_activity = false" />
              <newUpdateActivity v-if="selected_activity" :activity="selected_activity" @close="selected_activity = null"/>
        </div>
    </b-container>
</template>

<script>
import newUpdateActivity from '../components/activity/newUpdateActivity.vue';
import activityPartecipants from '../components/activity/activityPartecipants.vue';

export default {
    components: {
        newUpdateActivity, activityPartecipants
    },
    data () {
        return {
            new_activity: false,
            selected_activity: null,
        }
    },
    created() {
        if (!localStorage.getItem('token'))
            this.$router.push('login')
  },

  methods: {
    getActivities() {
        this.$http.get('activities').then(res => {
            this.$store.data.activities=res.data.data
        })
    },
    deleteActivity(activity){
        if(confirm("Sei sicuro di voler cancellare "+activity.name+" ?")){
            this.$http.post('activities/destroy',activity).then(()=> {
                this.getActivities()
            })
        }
    },
    ask_to_partecipate(activity){
        console.log(activity)
    }
  },
}
</script>

<style lang="scss">
</style>
