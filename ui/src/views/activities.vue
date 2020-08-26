<template lang="html">
  <div class="">
    <h1>Activities</h1>
    <div class="row">
        <!-- <div class='col-sm-1'></div> -->
        <div class="col-sm-6">
              <newActivity />
        </div>
    </div>


    <table id='activities_table' class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#Name##</th>
                <th>#Organizer##</th>
                <th>#Start date##</th>
                <th>#Level required##</th>
                <th>#Type##</th>
                <th>#Macrocategory##</th>
                <th>#User number##</th>
                <th>#Other Requests##</th>
                <th>#Actions##</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="activity in activities" v-bind:key="activity.id">
                  <td>{{activity.name}}</td>
                  <td>{{activity.organizer_name}}</td>
                  <td>{{activity.start_date}}</td>
                  <td>{{activity.level_req}}</td>
                  <td>{{activity.type_name}}</td>
                  <td>{{activity.macrocategory}}</td>
                  <td>{{activity.users_number}}</td>
                  <td>{{activity.other_req}}</td>

              </tr>
          </tbody>
      </table>

  </div>
</template>

<script>
import newActivity from '../components/activity/newActivity.vue';
export default {
    components: {
        newActivity
    },
    data () {
        return {
            activities: null,
            paramas: null,
        }
    },
    created() {
    if(localStorage.getItem('token'))
      this.getActivities()
    else
      this.$router.push('login')
  },

  methods: {
    getActivities(refresh=false) {
        if(!refresh)
            this.activities=JSON.parse( localStorage.getItem('activities'))
        else{
            this.$http.get('activities').then(res => {
                this.activities = res.data.data
                localStorage.setItem('activities', JSON.stringify(res.data.data))
            })
        }
    },
  },
}
</script>

<style lang="scss">
</style>
