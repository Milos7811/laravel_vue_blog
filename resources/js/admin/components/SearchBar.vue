<template>
  <!-- Main container -->
  <nav class="level">
    <!-- Left side -->
    <div class="level-left">
      <div class="level-item">
        <p v-if="this.count > 0" class="subtitle is-5">
          {{ filterCount }} of <strong>{{ count }}</strong> {{ resources }}s
        </p>
      </div>
      <div class="level-item">
        <div class="field has-addons">
          <p class="control">
            <input
              class="input"
              type="text"
              :placeholder="'Find a ' + resources"
              v-model="searchQuery"
            />
          </p>
          <p class="control">
            <button
              class="button"
              v-show="this.searchQuery.length > 0"
              @click="this.clearQuery"
            >
              Reset
            </button>
          </p>
        </div>
      </div>
    </div>

    <!-- Right side -->
    <div class="level-right">
      <p class="level-item">
        <router-link to="/admin/posts/createpost" class="button is-success"
          >New {{ resources }}</router-link
        >
      </p>
    </div>
  </nav>
</template>

<script>
export default {
  props: ["resources", "count", "filterCount"],
  data() {
    return {
      searchQuery: ""
    };
  },
  watch: {
    searchQuery(value) {
      this.$root.$emit("searchQueryValue", value);
    }
  },
  methods: {
    clearQuery() {
      return (this.searchQuery = "");
    }
  }
};
</script>

<style lang="scss" scoped></style>
