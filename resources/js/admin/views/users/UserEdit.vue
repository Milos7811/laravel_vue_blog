<template>
  <div>
    <div class="field">
      <label class="label">Name</label>
      <div class="control has-icons-left has-icons-right">
        <input
          :class="{ 'input is-danger': errors.name }"
          class="input "
          type="text"
          placeholder="Text input"
          v-model="user.name"
        />
        <span class="icon is-small is-left">
          <i class="mdi mdi-user"></i>
        </span>
        <span class="icon is-small is-right">
          <i class="mdi mdi-check"></i>
        </span>
      </div>
      <p
        class="help is-danger"
        v-for="(error, index) in errors.name"
        :key="index"
      >
        {{ error }}
      </p>
    </div>

    <div class="field">
      <label class="label">Email</label>
      <div class="control has-icons-left has-icons-right">
        <input
          :class="{ 'input is-danger': errors.email }"
          class="input "
          type="email"
          placeholder="Email input"
          v-model="user.email"
        />
        <span class="icon is-small is-left">
          <i class="mdi mdi-envelope"></i>
        </span>
        <span class="icon is-small is-right">
          <i class="fas fa-exclamation-triangle"></i>
        </span>
      </div>

      <p
        class="help is-danger"
        v-for="(error, index) in errors.email"
        :key="index"
      >
        {{ error }}
      </p>
    </div>

    <div class="field is-grouped">
      <div class="control">
        <button @click="submitUser" class="button is-success">
          Submit
        </button>
      </div>
      <div class="control">
        <button @click="$router.go(-1)" class="button is-link is-light">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {},
      errors: {}
    };
  },
  methods: {
    submitUser() {
      let data = {
        name: this.user.name,
        email: this.user.email,
        user_id: this.$route.params.id
      };

      axios
        .patch(`/api/users/${this.$route.params.id}`, data)
        .then(response => {
          this.$router.push(`/admin/users/${this.$route.params.id}`);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  },

  created() {
    axios.get("/api/users/" + this.$route.params.id).then(response => {
      this.user = response.data;
    });
  }
};
</script>

<style lang="scss" scoped>
.fa-user {
  color: rgb(78, 78, 78);
  width: 1;
}
</style>
