<template>
  <div>
    <h1 class="title">
      <small class="has-text-grey-light">user | </small>
      {{ user.name }}
    </h1>

    <ul>
      <li><strong>user id: </strong> {{ user.email }}</li>
      <li><strong>created at: </strong> {{ user.created_at }}</li>
      <li><strong>updated at: </strong> {{ user.updated_at }}</li>
    </ul>
    <single-edit-links :id="user.id" resource="user" />
  </div>
</template>

<script>
import SingleEditLinks from "../../components/SingleEditLinks";

export default {
  components: {
    SingleEditLinks
  },
  data() {
    return {
      user: {
        post: {},
        comment: {}
      }
    };
  },
  created() {
    axios
      .get("/api/users/" + this.$route.params.id)
      .then(response => {
        this.user = response.data;
      })
      .catch(error => {
        return this.$router.push("admin/NotFound");
      });
  }
};
</script>

<style lang="scss" scoped></style>
