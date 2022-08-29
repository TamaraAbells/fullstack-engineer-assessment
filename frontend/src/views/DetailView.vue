<template>
  <v-container>
    <v-row>
      <v-col cols="12" sm="8">
        <h1 class="display-3 fst-italic">{{book.name}}</h1>
        <v-row class="no-gutter">
          <h1 class="text-h5 fw-bold">Authors:</h1>
          <span class="gray--text" v-for="author in book.authors" :key="author">
            {{ author }}
          </span>
        </v-row>
        <hr>
        <div class=" flex flex-column">
           <div class="d-flex flex-row justify-content-start align-items-center">
             <span class="mr-2 fw-semibold fs-5">RELEASED DATE:</span>
             <span class="lead">{{book.released | moment("dddd, MMMM Do YYYY") }}</span>
           </div>
            <div class="d-flex flex-row justify-content-start align-items-center">
             <span class="mr-2 fw-semibold fs-5">TOTAL PAGES:</span>
             <span class="lead">{{book.numberOfPages}}</span>
           </div>
           <div class="d-flex flex-row justify-content-start align-items-center">
             <span class="mr-2 fw-semibold fs-5">ISBN:</span>
             <span class="lead">{{book.isbn}}</span>
           </div>
           <div class="d-flex flex-row justify-content-start align-items-center">
             <span class="lead mr-2 fw-semibold">PUBLISHER:</span>
             <span class="lead">{{book.publisher}}</span>
           </div>
           <div class="d-flex flex-row justify-content-start align-items-center">
             <span class="lead mr-2 fw-semibold">MEDIATYPE:</span>
             <span class="lead">{{book.mediaType}}</span>
           </div>
           <div class="d-flex flex-row justify-content-start align-items-center">
             <span class="lead mr-2 fw-semibold">COUNTRY:</span>
             <span class="lead">{{book.country}}</span>
           </div>
        </div>
        <hr>
        <div class="mt-5">
          <h2 class="blog-post-title mb-1">Characters:</h2>
          <sorted-table :values="characters">
            <thead>
              <tr>
                <th scope="col" style="text-align: left; width: 10rem;">
                  <sort-link name="id">Name</sort-link>
                </th>
                
                <th scope="col" style="text-align: left; width: 10rem;">
                  <sort-link name="name">Gender</sort-link>
                </th>
                <th scope="col" style="text-align: left; width: 10rem;">
                  <sort-link name="hits">Books</sort-link>
                </th>
                <th scope="col" style="text-align: left; width: 10rem;">
                  <sort-link name="hits">Died In</sort-link>
                </th>
              </tr>
            </thead>
            <template #body="{ values }">
              <tbody>
                <tr v-for="value, i in values" :key="`${value.died}-${i}`">
                <td>{{ value.name }}</td>
                <td>{{ value.gender }}</td>
                <td>{{ value.books }}</td>
                <td>{{ value.died }}</td>
              </tr>
              </tbody>
            </template>
          </sorted-table>
        </div>
      </v-col>
    </v-row>
  </v-container>      
</template>

<script>
import * as _ from 'lodash'
import { Component, Vue } from 'vue-property-decorator'

@Component({
  data: () => ({
    book: {},
    characters: [],
    povCharacters: [],
  }),
  methods: {
    async fetchCharacters(charactersArray) {
      await charactersArray?.forEach(async (url) => {
        const response = await this.$http.get(url);
        const character = await response.data
        this.characters.push({
          name: character.name,
          gender: character.gender,
          books: _.size(character.books),
          died: character.died,
          title: _.first(character.titles)
        });
      })
    },
  },
  async created(){
    try {
      this.loading = true
      const params = this.$route.params.id
      const response = await this.$http.get(`/books/get-book/?bookId=${params}`)
      this.book = await response.data.response
      await this.fetchCharacters(this.book.characters)
      this.loading = false
    }catch (error) {
      console.log(error)
    }
  },
  
})
export default class DetailView extends Vue {}
</script>
<style>
  @import'~bootstrap/dist/css/bootstrap.css';
</style>