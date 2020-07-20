<template>
  <form class="maincontainer">
    <textarea
      :class="{ 'is-danger': errors.text }"
      class="textarea"
      name="text"
      v-model="text"
      @keydown.esc="backText"
      v-on:input="newMessage"
    />

    <div class="field is-grouped">
      <div class="control">
        <button @click.prevent="editComment" class="button is-link">
          Save
        </button>
      </div>
      <div class="control">
        <button @click.prevent="$router.go(-1)" class="button is-link is-light">
          Cancel
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      text: "",
      newCommentText: "",
      oldText: "",
      comment: "",
      errors: {}
    };
  },

  created() {
    axios.get(`/api/comments/${this.$route.params.id}`).then(response => {
      this.comment = response.data;
      this.oldText = this.comment.text;
      this.text = this.oldText;
    });
  },

  methods: {
    backText() {
      this.text = this.oldText;
    },
    newMessage() {
      this.newCommentText = this.text;
    },

    editComment() {
      axios
        .patch(`/api/comments/${this.comment.id}`, {
          text: this.newCommentText
        })
        .then(this.$router.push(`/admin/comments/${this.$route.params.id}`))
        .then(this.$root.$emit("flash", "Your comment edit is successful ! "))
        .catch(error => {
          //   this.$router.push("/admin/NotFound");
        });
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
