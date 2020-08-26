<template>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="navbar-brand">
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbar" class="navbar-menu">

      <!-- <div class="main-menu" v-if="!$store.user">
          <a href="#" @click="goToPage('login')">Login</a>
      </div>
      <div class="main-menu" v-else>
          <a href="#" @click="goToPage('home')">home</a>
          <a href="#" @click="goToPage('users')">Utenti</a>
          <a href="#" @click="$store.logout()">Logout {{ $store.user.name }}</a>
        </div>  -->

        <div class="container">
            <a class="navbar-brand" href="#" @click="goToPage('home')">
                NosMg
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation'">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" v-if="!$store.token">
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="goToPage('login')">{{ $t('login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="goToPage('register')">{{ $t('register') }}</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto" v-else>
                    <li class="nav-item">
                        <a class="nav-link" @click="goToPage('invitations')" href="#">{{ $t('invitations') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" @click="goToPage('activities')" href="#">{{ $t('activities') }}</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" @click="goToPage('players')" href="#" >{{ $t('players') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="$store.logout()">{{ $t('logout') }} </a>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            {{$store.user.name}}  <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="#" @click="$store.logout()">Logout </a>
                        </div>
                    </li> -->

                </ul>
            </div>
        </div>
    </div>
</nav>

</template>

<script>
export default {
    name: 'Nav',
    methods: {
      goToPage(name) {
        this.$router.push({ name }).catch(err => err)
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
