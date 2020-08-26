<template lang="html">
  <div class="page-login">
    <b-button @click="login" variant="primary" :disabled="is_loading">login</b-button>
    <input type="text" name="email" v-model="input.email" placeholder="Email" />
    <input type="password" name="password" v-model="input.password" placeholder="Password" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      is_loading: false,
      token:'',
      input: {
        email: "",
        password: ""
        }
    }
  },
  methods: {
    login() {
      this.is_loading = true
      if(this.input.email != "" && this.input.password != "") {
        this.token=this.$store.get_token(this.input.email, this.input.password)
          //this.$router.push({name:'home'})
        this.$store.refreshData()
        this.$router.push('home').catch(err => err)

      } else {
        console.log("A email and password must be not empty");
      }
    },
  },
}
</script>

<style lang="css" scoped>
</style>
