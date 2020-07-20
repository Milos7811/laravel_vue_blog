<template class="container">
  <div class="columns layout">
    <the-navigation class="column is-2 navigation"></the-navigation>
    <section class="column is-10">
      <the-stats />
      <router-view class="container" />
      <flash-message />
    </section>
  </div>
</template>

<script>
import TheNavigation from "./components/TheNavigation.vue";
import TheStats from "./components/TheStats.vue";
import FlashMessage from "../app/components/FlashMessage";

export default {
  components: {
    TheNavigation,
    TheStats,
    FlashMessage
  }
};
</script>

<style lang="scss" scoped>
</style>
