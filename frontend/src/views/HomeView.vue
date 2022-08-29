<template>
  <v-container>
    <v-row>
        <v-col  cols="14" sm="3" v-for="(book, index) in books" :key="book.isbn"  >
          <template>
            <v-hover v-slot="{hover}" open-delay="200" class="col">
              <v-card :elevation="hover ? 16:2" :class="{'on-hover' : hover}" class="card-body" height="100%">
                <v-card-title class="title-2 blue lighten-4">{{book.name}}</v-card-title>
                <v-card-text class="card-text align-items-center">
                    <span v-for="author in book.authors" :key="author">
                      Author: {{author}}
                    </span>
                    <div class="d-flex flex-column justify-content-between align-items-center"> 
                        <small class="text-muted my-4 subtitle-2 ">
                        <div class="grey--text ml-4">
                          ISBN: {{book.isbn}}
                        </div>
                        <div class="grey--text ml-4">
                          COUNTRY: {{book.country}}
                        </div>
                        <div class="grey--text ml-4">
                          PUBLISHER: {{book.publisher}}
                        </div>
                        </small>
                        <v-btn
                          width="100%"
                          color="primary"
                          depressed
                          @click="$router.push({
                            name: 'DetailView',
                            params: {id: index + 1}
                          })"
                        >
                          Info
                        </v-btn>
                    </div>
                </v-card-text>
              </v-card>
          </v-hover>
        </template>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { Component, Vue } from 'vue-property-decorator'
@Component({
  components :{},
  data: () => ({
    movie: '',
    movies: [],
    genres: [],
    books: [],
  }),
  async created(){
    try {
      const response = await this.$http.get("/books");
      this.books = await response.data.response;
    }catch (error) {
      console.log(error);
    }
  },
})
export default class HomeView extends Vue {}
</script>

<style>
  @import'~bootstrap/dist/css/bootstrap.css';
</style>