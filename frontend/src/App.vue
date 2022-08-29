<template>
  <v-app>
    <NavBar />
    <v-main>
      <router-view/>
    </v-main>
    <Footer />
  </v-app>
</template>

<script>
import { Component, Vue } from 'vue-property-decorator'
import NavBar from './components/NavBar.vue';
import Footer from './components/Footer.vue';

@Component({
  components: {
    NavBar,
    Footer
  },
  async mounted(){
    const res = await this.$http.get('http://localhost:8000/api/books')
    console.log('RESPONSE', res)
  }
})
export default class App extends Vue {}
</script>
