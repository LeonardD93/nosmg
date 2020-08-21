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

      } else {
        console.log("A email and password must be not empty");
      }
      // setTimeout(() => {
      //   let token = '437F8R89E'
      //   this.$store.setToken(token)
      //   this.is_loading = false
      //   console.log('fatto')
      // }, 1000)
    },
  },
}
</script>

<style lang="css" scoped>
</style>
