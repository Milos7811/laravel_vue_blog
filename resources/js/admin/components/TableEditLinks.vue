<template>
  <span class="icon">
    <router-link :to="`/admin/${this.resource}s/${this.id}`">
      <i class="mdi mdi-eye-outline"></i
    ></router-link>

    <i @click="deleteResource" class="mdi mdi-trash-can-outline"></i>

    <router-link :to="`/admin/${this.resource}s/${this.id}/edit`">
      <i class="mdi mdi-pencil-outline"></i
    ></router-link>
  </span>
</template>

<script>
export default {
  props: ["id", "resource"],
  methods: {
    deleteResource() {
      if (window.confirm(`Naozaj chcete vyzmazat ${this.resource} `)) {
        axios
          .delete(`/api/${this.resource}s/${this.id}`)
          .then(response => this.$router.go())
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
$red: red;
$green: #48c774;
$blue: blue;

.icon {
  .mdi-eye-outline {
    color: $green;
    &:hover {
      color: darken($green, 15%);
    }
  }
  .mdi-trash-can-outline {
    color: $red;
    &:hover {
      color: darken($red, 15%);
    }
    cursor: pointer;
  }
  .mdi-pencil-outline {
    color: $blue;
    &:hover {
      color: darken($blue, 15%);
    }
  }
}
</style>
