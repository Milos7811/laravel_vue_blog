<template>
  <transition name="fade">
    <div
      v-show="visible"
      class="alert alert-success notification is-primary"
      role="alert"
    >
      <button class="btn delete" @click="hide">x</button>
      {{ messageText }}
    </div>
  </transition>
</template>

<script>
export default {
  mounted() {},
  props: ["text"],
  data() {
    return {
      visible: false,
      messageText: ""
    };
  },
  created() {
    if (this.text || this.messageText) {
      this.messageText = this.text;
      this.show();
    }

    this.$root.$on("flash", message => {
      this.messageText = message;
      this.show();
    });
  },
  methods: {
    show() {
      this.visible = true;
      setTimeout(() => this.hide(), 3000);
    },
    hide() {
      this.visible = false;
    }
  }
};
</script>

<style lang="scss" scoped>
.alert {
  border: none;
  background-color: rgb(96, 189, 189);
  position: fixed;
  color: white;
  right: 2em;
  bottom: 2em;
  display: inline;
  .btn {
    float: right;
    line-height: 7px;
    color: white;
  }
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
