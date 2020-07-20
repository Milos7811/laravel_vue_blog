<template>
  <div>
    <search-bar
      resources="tags"
      :count="data.length"
      :filterCount="filteredItems.length"
    />
    <div class="wrapper">
      <div class="field has-addons">
        <div class="control">
          <input
            @keydown.enter="submitForm()"
            class="input"
            type="text"
            placeholder="Tag"
            v-model="newTag"
            :class="[errorsAdd.tag ? 'is-danger' : 'input']"
          />
        </div>
        <div class="control">
          <a @click.prevent="submitForm" class="button is-info ">
            Add new tag
          </a>
        </div>
      </div>
      <ul v-if="errorsAdd.tag">
        <li
          v-for="(error, index) in errorsAdd.tag"
          :key="index"
          class="help is-danger is-size-6"
        >
          {{ error }}
        </li>
      </ul>

      <div class="field has-addons" v-show="edit">
        <div class="control">
          <input
            @keydown.esc="(edit = false), dataReset()"
            @keydown.enter="editTag()"
            ref="editTagInput"
            v-model="editTagText"
            class="input"
            type="text"
            :class="[errorsEdit.tag ? 'is-danger' : 'input']"
          />
        </div>
        <div class="control">
          <a @click.prevent="editTag()" class="button is-info ">
            Save
          </a>
          <a
            @click.prevent="(edit = false), dataReset()"
            class="delete is-medium"
          ></a>
        </div>
      </div>
      <ul v-if="errorsEdit.tag && edit">
        <li
          v-for="(error, index) in errorsEdit.tag"
          :key="index"
          class="help is-danger is-size-6"
        >
          {{ error }}
        </li>
      </ul>

      <table class="table is-bordered is-striped is-full-width">
        <thead>
          <tr>
            <th>id</th>
            <th>tag</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tag in this.filteredItems" :key="tag.id">
            <td>{{ tag.id }}</td>
            <td>
              {{ tag.tag }}
            </td>
            <td class="icon-wraper">
              <i
                @click="deleteResource(tag.id)"
                class="mdi mdi-trash-can-outline "
              ></i>

              <i
                @click="
                  (edit = true),
                    (editTagText = tag.tag),
                    (editTagId = tag.id),
                    focusInput()
                "
                class="mdi mdi-pencil-outline "
              ></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import TableMixins from "../../mixins/TableMixins";
import SearchBar from "../../components/SearchBar";
import TableEditLinks from "../../components/TableEditLinks";
export default {
  mixins: [TableMixins],
  components: { SearchBar, TableEditLinks },
  data() {
    return {
      searchColumn: "tag",
      newTag: "",
      errorsAdd: {},
      errorsEdit: {},
      edit: false,
      editTagText: "",
      editTagId: ""
    };
  },
  created() {
    this.getTags();
  },

  methods: {
    focusInput() {
      setTimeout(() => {
        this.$refs.editTagInput.focus();
      }, 100);
    },
    getTags() {
      axios.get("/api/tags").then(response => {
        this.data = response.data;
      });
    },
    deleteResource(id) {
      if (window.confirm(`Naozaj chcete vyzmazat tag `)) {
        axios
          .delete(`/api/tags/${id}`)
          .then(response => this.getTags())
          .then(this.$root.$emit("flash", `tag deleted`))
          .catch(error => {
            return this.$router.push("admin/NotFound");
          });
      }
    },
    submitForm() {
      let data = {
        tag: this.newTag
      };
      axios
        .post("/api/tags", data)
        .then(response => {
          this.newTag = "";
          this.getTags();
        })
        .catch(error => {
          this.errorsAdd = error.response.data.errors;
        });
    },
    editTag() {
      let data = {
        tag: this.editTagText,
        id: this.editTagId
      };
      axios
        .patch(`/api/tags/${this.editTagId}`, data)
        .then(response => {
          this.getTags();
          this.dataReset();
        })
        .then(this.$root.$emit("flash", "Your tag edit is successful ! "))
        .catch(error => {
          this.errorsEdit = error.response.data.errors;
        });
    },
    dataReset() {
      (this.editTagText = ""), (this.editTagId = ""), (this.edit = false);
    }
  }
};
</script>

<style lang="scss" scoped>
$red: red;
$blue: blue;

.icon-wraper {
  display: flex;
  justify-content: space-around;
  .mdi-pencil-outline {
    color: $blue;
    &:hover {
      color: darken($blue, 15%);
    }
    cursor: pointer;
  }
  .mdi-trash-can-outline {
    color: $red;
    &:hover {
      color: darken($red, 15%);
    }
    cursor: pointer;
  }
}

.wrapper {
  justify-content: center;
  display: flex;
  flex-direction: column;
}
</style>
