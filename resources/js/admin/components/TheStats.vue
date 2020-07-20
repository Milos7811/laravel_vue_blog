<template>
  <nav class="level " v-if="users.length > 0">
    <div class="level-item has-text-centered ">
      <div>
        <p class="heading">Users</p>
        <p class="title">{{ users.length }}</p>
      </div>
    </div>

    <div class="level-item has-text-centered ">
      <div>
        <p class="heading">Posts</p>
        <p class="title">{{ posts.length }}</p>
      </div>
    </div>
    <div class="level-item has-text-centered ">
      <div>
        <p class="heading">Comments</p>
        <p class="title">{{ comments.length }}</p>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      comments: {},
      users: {},
      posts: {}
    };
  },

  created() {
    axios.get("/api/comments").then(response => {
      this.comments = response.data;
    });

    axios.get("/api/posts").then(response => {
      this.posts = response.data;
    });

    axios.get("/api/users").then(response => {
      this.users = response.data;
    });
  }
};
</script>

<style lang="scss" scoped>
.level-item {
  border: 1px solid black;
  margin: 5px;
}
</style>
