<template lang="html">
  <div id="app">
    <Nav />
    <router-view/>
    <!-- <pre>{{ $store.user }}</pre> -->
  </div>
</template>

<script>
import Nav from './components/partials/nav.vue';

export default {
  components: {
   Nav
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
