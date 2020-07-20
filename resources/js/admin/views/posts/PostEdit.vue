<template>
  <div>
    <post-create-form
      :errors="errors"
      :post="post"
      @post-form-data="submitForm"
    ></post-create-form>
  </div>
</template>

<script>
import PostCreateForm from "./PostCreateForm.vue";
export default {
  components: {
    PostCreateForm
  },
  data() {
    return {
      errors: {},
      post: {
        user: {}
      }
    };
  },

  props: ["comment-data"],

  created() {
    axios
      .get("/api/posts/" + this.$route.params.id)
      .then(response => {
        this.post = response.data;
      })
      .catch(error => {
        this.errors = error.response.data.errors;
      });
  },

  methods: {
    submitForm(data) {
      axios
        .patch(`/api/posts/${this.$route.params.id}`, data)
        .then(response => {
          this.$router.push(`/admin/posts/${this.$route.params.id}`);
        })
        .then(this.$root.$emit("flash", "Your comment edit is successful ! "));
    },
    selectText() {
      setTimeout(() => {
        let p = this.$refs.textArea,
          s = window.getSelection(),
          r = document.createRange();
        r.setStart(p, 1);
        r.setEnd(p, 1);
        s.removeAllRanges();
        s.addRange(r);
        p.focus();
      }, 0);
    }
  }
};
</script>

<style lang="scss" scoped>
.control {
  margin-top: 30px;
}
.maincontainer {
  width: 100%;
  height: 100%;
}

.textarea {
  min-height: 75%;
  max-width: 100%;
}
</style>
