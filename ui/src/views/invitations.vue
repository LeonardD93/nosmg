<template lang="html">
  <div class="">
    <h1>Invitations</h1>

  </div>
</template>

<script>
export default {
  data () {
    return {
      invitations: null,
      paramas: null,
    }
  },

  created() {
    if(localStorage.getItem('token'))
      this.$store.refreshData()
    else
      this.$router.push('login')
  },
  methods: {
  },
}
</script>

<style lang="scss">
</style>
