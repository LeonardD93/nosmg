<template lang="html">
  <div class="page-login">
    <b-button @click="login" variant="primary" :disabled="is_loading">login</b-button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      is_loading: false,
    }
  },
  methods: {
    login() {
      this.is_loading = true
      setTimeout(() => {
        let token = '437F8R89E'
        this.$store.setToken(token)
        this.is_loading = false
        console.log('fatto')
      }, 1000)
    },
  },
}
</script>

<style lang="css" scoped>
</style>
