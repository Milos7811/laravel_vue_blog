<template>
  <div>
    <search-bar
      resources="comment"
      :count="data.length"
      :filterCount="filteredItems.length"
    />
    <table class="table is-bordered is-striped is-full-width">
      <thead>
        <tr>
          <th>id</th>
          <th>text</th>
          <th>post</th>
          <th>user</th>
          <th>published at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="comment in filteredItems" :key="comment.id">
          <td>{{ comment.id }}</td>
          <td>{{ comment.text }}</td>
          <td>
            <a class="links row" :href="'/admin/posts/' + comment.post_id">
              {{ comment.post_id }} <strong>➦</strong>
            </a>
          </td>
          <td>
            <a class="links" :href="'/admin/users/' + comment.user.id">
              {{ comment.user.name }}</a
            >
          </td>
          <td>{{ formatedDate(comment.created_at) }}</td>
          <td>
            <table-edit-links :id="comment.id" resource="comment" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import SearchBar from "../../components/SearchBar.vue";
import TableEditLinks from "../../components/TableEditLinks.vue";
import TableMixins from "../../mixins/TableMixins";
export default {
  data() {
    return {
      searchColumn: "text"
    };
  },
  mixins: [TableMixins],
  components: { SearchBar, TableEditLinks },
  created() {
    axios.get("/api/comments").then(response => {
      this.data = response.data;
    });
  },
  methods: {
    shorten(text, len = 50) {
      return _.truncate(text, { length: len });
    }
  },
  deleteResource() {
    if (window.confirm(`Naozaj chcete vzmazat ${this.resource} `)) {
      axios
        .delete(`/api/${this.resource}s/${this.id}`)
        .then(response => this.$router.push(`/admin/${this.resource}s`))
        .catch(error => {
          return this.$router.go();
        });
    }
  }
};
</script>

<style lang="scss" scoped>
small {
  font-size: 75%;
  color: #afafaf;
}
</style>
