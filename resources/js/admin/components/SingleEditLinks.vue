<template>
  <div class="field is-grouped">
    <p class="control">
      <router-link
        :to="`/admin/${resource}s/${id}/edit`"
        class="button is-link"
      >
        <span class="icon"><i class="mdi mdi-pencil-outline"></i></span>
        Edit
      </router-link>
    </p>

    <p class="control">
      <a @click="deleteResource" class="button is-danger is-outline">
        <span class="icon"><i class="mdi mdi-trash-can-outline"></i></span>
        Delete {{ resource }}
      </a>
    </p>
  </div>
</template>

<script>
export default {
  props: ["id", "resource"],
  methods: {
    deleteResource() {
      if (window.confirm(`Naozaj chcete vyzmazat ${this.resource} `)) {
        axios
          .delete(`/api/${this.resource}s/${this.id}`)
          .then(response => this.$router.push(`/admin/${this.resource}s`))
          .then(this.$root.$emit("flash", `${this.resource} deleted`))
          .catch(error => {
            return this.$router.push("admin/NotFound");
          });
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.field {
  margin-top: 25px;
}

.icon {
  .mdi {
    margin-right: 20px;
  }
}
</style>
