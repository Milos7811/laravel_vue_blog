<template>
  <div>
    <h1 class="title">
      <small class="has-text-grey-light">comment | </small>
      {{ comment.title }}
    </h1>
    <div class="content">{{ comment.text }}</div>
    <ul>
      <li><strong>id: </strong>{{ comment.id }}</li>
      <li>
        <strong>post id: </strong>
        <a :href="`/admin/posts/${comment.post_id}`"> {{ comment.post_id }}</a>
      </li>
      <li><strong>created at: </strong> {{ comment.created_at }}</li>
      <li><strong>updated at: </strong> {{ comment.updated_at }}</li>
      <li>
        <strong>autor: </strong>
        <a :href="`/admin/users/${comment.user_id}`">
          {{ comment.user.name }}</a
        >
      </li>
    </ul>
    <single-edit-links :id="comment.id" resource="comment" />
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
      comment: {
        post: {},
        user: {}
      }
    };
  },
  created() {
    axios
      .get("/api/comments/" + this.$route.params.id)
      .then(response => {
        this.comment = response.data;
      })
      .catch(error => {
        return this.$router.push("admin/NotFound");
      });
  }
};
</script>

<style lang="scss" scoped></style>
