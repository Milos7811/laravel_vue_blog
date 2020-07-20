<template>
  <div>
    <search-bar
      resources="post"
      :count="data.length"
      :filterCount="filteredItems.length"
    />

    <table class="table is-bordered is-striped is-full-width">
      <thead>
        <tr>
          <th>id</th>
          <th>title</th>
          <th>user</th>
          <th>published at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in filteredItems" :key="post.id">
          <td>{{ post.id }}</td>
          <td>
            {{ post.title }}
            <small>{{ shorten(post.text) }}</small>
          </td>
          <td>
            <a class="links" :href="'/admin/users/' + post.user.id">
              {{ post.user.name }}
            </a>
          </td>
          <td>{{ formatedDate(post.created_at) }}</td>
          <td>
            <table-edit-links :id="post.id" resource="post" />
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
  mixins: [TableMixins],

  components: {
    SearchBar,
    TableEditLinks
  },

  data() {
    return {
      searchColumn: "title"
    };
  },

  created() {
    axios.get("/api/posts").then(response => {
      this.data = response.data;
    });
  }
};
</script>

<style lang="scss" scoped></style>
