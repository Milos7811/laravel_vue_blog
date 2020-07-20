<template>
    <div>
        <div class="field ">
            <label class="label ">Title</label>
            <post-create-form :errors="errors" @post-form-data="submitForm" />
        </div>
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
            errors: {}
        };
    },

    methods: {
        submitForm(data) {
            axios
                .post("/api/posts", data)
                .then(response => {
                    this.$router.push(`/admin/posts/${response.data.post.id}`);
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    }
};
</script>

<style lang="scss" scoped></style>
