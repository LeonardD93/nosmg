<template lang="html">
  <div class="">
    <h1>{{ $t('activities') }}</h1>
    <div class="row">
        <!-- <div class='col-sm-1'></div> -->
        <div class="col-sm-6">
              <newUpdateActivity />
        </div>
    </div>


    <table id='activities_table' class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>{{ $t('name') }}</th>
                <th>{{ $t('Organizer') }}</th>
                <th>{{ $t('Start_date') }}</th>
                <th>{{ $t('Level_required') }}</th>
                <th>{{ $t('Type') }}</th>
                <th>{{ $t('Macrocategory') }}</th>
                <th>{{ $t('User_number') }}</th>
                <th>{{ $t('Other_Requests') }}</th>
                <th>{{ $t('Actions') }}</th>

            </tr>
        </thead>
        <tbody v-if="$store.data">
            <tr v-for="activity in $store.data.activities" v-bind:key="activity.id">
                  <td>{{activity.name}}</td>
                  <td>{{activity.organizer_name}}</td>
                  <td>{{activity.start_date}}</td>
                  <td>{{activity.level_req}}</td>
                  <td>{{activity.type_name}}</td>
                  <td>{{activity.macrocategory}}</td>
                  <td>{{activity.users_number}}</td>
                  <td>{{activity.other_req}}</td>
                  <td>
                      <a href="#" class="btn btn-primary text-danger float-right" @click.prevent="deleteActivity(activity)">
                        <b-icon icon="trash"/>
                      </a>
                       <newUpdateActivity v-bind:activity='activity' />

                  </td>

              </tr>
          </tbody>
      </table>

  </div>
</template>

<script>
import newUpdateActivity from '../components/activity/newUpdateActivity.vue';
export default {
    components: {
        newUpdateActivity
    },
    data () {
        return {
        }
    },
    created() {
    if(localStorage.getItem('token'))
      this.getActivities()
    else
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

    }
  },
}
</script>

<style lang="scss">
</style>
