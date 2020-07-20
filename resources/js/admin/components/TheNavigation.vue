<template>
  <div class="navistyle">
    <ul>
      <h3>ADMIN</h3>
      <router-link tag="li" to="/admin/">Dashboard</router-link>
      <h3>RESOURCES</h3>
      <router-link tag="li" to="/admin/posts">Post</router-link>
      <router-link tag="li" to="/admin/comments">Comment</router-link>
      <router-link tag="li" to="/admin/users">User</router-link>
      <router-link tag="li" to="/admin/tags">Tags</router-link>
      <h3>GENERAL</h3>
      <li><a href="/">Homepage</a></li>
      <li><a href="#" @click.prevent="logout">Logout</a></li>
    </ul>
  </div>
</template>

<script>
export default {
  methods: {
    logout() {
      axios
        .post("/logout")
        .then((document.location.href = "/"))
        .then(this.$root.$emit("flash", "You are logout! "))
        .catch(error => {
          location.reload();
        });
    }
  }
};
</script>

<style lang="scss" scoped>
ul {
  height: 100%;
  margin: 0px;
  padding: 0px;
  li {
    color: black;
    cursor: pointer;
    &.router-link-exact-active {
      color: rgb(74, 55, 145);
    }
    a {
      color: black;
    }
  }
}
h3 {
  margin-top: 20px;
  color: #ffffff;
}
.navistyle {
  background-color: #9c9c9c;
}
</style>
