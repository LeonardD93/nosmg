<template lang="html">
  <div id="app">
    <div class="main-menu">
      <a href="#" @click="goToPage('home')">home</a>
      <a href="#" @click="goToPage('users')">Utenti</a>

      <a v-if="!$store.user" href="#" @click="goToPage('login')">Login</a>
      <a v-else href="#" @click="$store.logout()">Logout {{ $store.user.name }}</a>
    </div>

    <router-view/>

    <pre>{{ $store.user }}</pre>
  </div>
</template>

<script>
export default {
  data () {
    return {
      $store: this.$store,
    }
  },
  created() {
    this.$store.init(this)
  },
  methods: {
    goToPage(name) {
      this.$router.push({ name })
    }
  }
}
</script>

<style lang="scss">
.main-menu {
  a {
    margin: 1rem;
  }
}
</style>
