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
            input: {
                email: "",
                password: ""
            }
        }
    },
    methods: {
        login() {
            this.is_loading = true
            if (this.input.email != "" && this.input.password != "") {
                var params = {
                    email: this.input.email,
                    password: this.input.password,
                }
                this.$http.post('token', params).then(res => {
                    console.log(res.data.value)
                    this.$store.setToken(res.data.value)
                    this.$router.push({
                        name: 'home'
                    })
                })

            } else {
                console.log("A email and password must be not empty");
            }
        },
    },
}
</script>

<style lang="css" scoped>
</style>
