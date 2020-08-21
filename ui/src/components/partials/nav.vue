<template>
<nav class="navbar container" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbar" class="navbar-menu">

    <div class="main-menu">
      <a href="#" @click="goToPage('home')">home</a>
      <a href="#" @click="goToPage('users')">Utenti</a>
      <a v-if="!$store.user" href="#" @click="goToPage('login')">Login</a>
      <a v-else href="#" @click="$store.logout()">Logout {{ $store.user.name }}</a>
    </div>

  </div>
</nav>
</template>

<script>
export default {
    name: 'Nav',
    methods: {
      goToPage(name) {
        this.$router.push({ name })
      }
    }
}
</script>

<style lang="scss" scoped>
  nav {
    margin-top: 25px;
    margin-bottom: 30px;
    a {
      font-weight: bold;
      color: #2c3e50;
      &.router-link-exact-active {
        color: #d88d00;
      }
    }
  }
</style>
