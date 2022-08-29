<template>
  <nav class="navbar navbar-dark shadow-sm">
    <div class="container">
      <a href="/" class="navbar-brand text-dark fs-1 fw-bold">BOOK LIB APP</a>
      <v-form class="d-flex" role="search" >
      </v-form>
    </div>
  </nav>
</template>

<script>
import { Component, Vue } from 'vue-property-decorator'

@Component({
  data: () => ({
    drawer:null,
    model:'',
    search:null,
  }),
})
export default class NavBarComponent extends Vue {}
</script>
