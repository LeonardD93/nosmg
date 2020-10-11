<template lang="html">
  <div id="app">
    <Mymenu />
    <template v-if="$route.meta && $route.meta.auth && !$store.token">
      Vai al <a @click="$route.push({name:'login'})">login</a>
    </template>
    <template v-else-if="$route.meta && $route.meta.auth && !$store.data">
      Loading...
    </template>
    <template v-else>
      <router-view/>
    </template>
    <!-- <pre>{{ $store.user }}</pre> -->
  </div>
</template>

<script>
import Mymenu from './components/partials/Mymenu.vue';

export default {
  components: {
   Mymenu
 },
  data () {
    return {
      $store: this.$store,
    }
  },
  created() {
    this.$store.init(this)
  },
  // methods: {
  //   goToPage(name) {
  //     this.$router.push({ name })
  //   }
  // }
}
</script>

<style lang="scss">
// @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap');
//
// $image-path: '~@/../mdb/mdbvue/img';
// @import '~@/../mdb/mdbvue/scss/mdb-free.scss';
a:not([href]){
  color:white;
}
.main-menu {
  a {
    margin: 1rem;
  }
}
</style>
