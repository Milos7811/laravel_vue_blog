<template>
  <div>
    <div>
      <div class="control">
        <input
          class="input"
          :class="{ 'is-danger': errors.title }"
          type="text"
          placeholder="Title"
          v-model="title"
        />
      </div>
      <div v-if="errors.title">
        <p
          class="help is-danger"
          v-for="(error, index) in errors.title"
          :key="index"
        >
          {{ error }}
        </p>
      </div>
    </div>

    <div class="field">
      <label class="label">Slug</label>
      <div class="control">
        <input
          class="input"
          :class="{ 'is-danger': errors.title }"
          type="text"
          v-model="slug"
        />
      </div>
      <div v-if="errors.slug">
        <p
          class="help is-danger"
          v-for="(error, index) in errors.slug"
          :key="index"
        >
          {{ error }}
        </p>
      </div>
    </div>
    <div class="field">
      <label class="label">Message</label>
      <div class="control content">
        <input
          id="x"
          :value="text"
          type="hidden"
          name="text"
          class="textarea"
        />

        <trix-editor
          placeholder="Message"
          input="x"
          :class="{ 'input is-danger': errors.title }"
        ></trix-editor>
      </div>
      <div v-if="errors.text">
        <p
          class="help is-danger"
          v-for="(error, index) in errors.text"
          :key="index"
        >
          {{ error }}
        </p>
      </div>
    </div>

    <div class="field is-grouped">
      <div class="control">
        <button @click="submitForm" class="button is-success">
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
import trix from "trix";

export default {
  props: ["errors", "post"],
  data() {
    return {
      title: "",
      text: "",
      slug: ""
    };
  },
  mounted() {
    document.addEventListener("trix-change", () => {
      this.text = document.getElementById("x").value;
    });
  },
  methods: {
    submitForm() {
      let data = {
        title: this.title,
        slug: this.slug,
        text: this.text,
        user_id: 1
      };
      this.$emit("post-form-data", data);
    }
  },
  watch: {
    title(value) {
      this.slug = _.trim(
        _.deburr(value.toLowerCase()) // diacritics
          .replace(/[^\w\s]/gi, "") // special characters
          .replace(/ {2,}/g, " ") // repeating spaces
          .replace(/ /g, "-"), // space to -
        "-" // trailing -
      );
    },
    post(post) {
      this.title = post.title;
      this.slug = post.slug;
      this.text = post.text;

      let trix = document.querySelector("trix-editor");
      trix.editor.insertHTML(post.text);
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~trix/dist/trix.css";
trix-editor {
  min-height: 20em;
}
</style>
