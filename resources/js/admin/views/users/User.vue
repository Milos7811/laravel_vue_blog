<template>
  <div>
    <search-bar
      resources="user"
      :count="data.length"
      :filterCount="filteredItems.length"
    />
    <table class="table is-bordered is-striped is-full-width">
      <thead>
        <tr>
          <th>id</th>
          <th>name</th>
          <th>email</th>
          <th>rigstered at</th>
          <th>email verifed</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in filteredItems" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ formatedDate(user.created_at) }}</td>
          <td>{{ formatedDate(user.email_verified_at) }}</td>

          <td>
            <table-edit-links :id="user.id" resource="user" />
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
  components: {
    SearchBar,
    TableEditLinks
  },
  mixins: [TableMixins],
  data() {
    return {
      searchColumn: "name"
    };
  },
  created() {
    axios.get("/api/users").then(response => {
      this.data = response.data;
    });
  }
};
</script>

<style lang="scss" scoped></style>
