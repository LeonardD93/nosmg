<template>
  <div>
    <a class="btn btn-primary" v-b-modal.modal-1>#Add new##</a>
    <b-modal id="modal-1" title="Add new Player" hide-footer>

        <div class="form-group">
            <label for="name" class="col-md-4 control-label">#Name##</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="start_date" class="col-md-4 control-label">#Start date##</label>
            <div class="col-md-6">
                <input id="start_date" type="date" class="form-control" name="start_date" required>
            </div>
        </div>
        <div class="form-group">
            <label for="start_time" class="col-md-4 control-label">#Start date time##</label>
            <div class="col-md-6">
                <input id="start_time" type="time" class="form-control" name="start_time" required>
            </div>
        </div>
        <div class="form-group">
            <label for="level_req"   class="col-md-4 control-label">#Level required##</label>
            <div class="col-md-6">
                <input id="level_req" min="0" max="99" type="number" class="form-control" name="level_req" required>
            </div>
        </div>

        <b-button class="mt-3" block @click="addNew()">#Add new##</b-button>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: 'newPlayer`',
  data(){
    return {
        name: '',
        start_date:'',
        start_time:'',
        level_req:'',
      }
  },
  methods: {
    addNew(){
        this.$root.$emit('bv::hide::modal', 'modal-1')
        console.log('modal closed')
      },
  }
}


</script>
<style lang="scss" >

</style>
