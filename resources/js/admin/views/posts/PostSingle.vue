<template>
    <div>
        <h1 class="title">
            <small class="has-text-grey-light">Post | </small>
            {{ post.title }}
        </h1>
        <div class="content" v-html="post.text"></div>
        <ul>
            <li><strong>id: </strong>{{ post.id }}</li>
            <li><strong>slug: </strong> {{ post.slug }}</li>
            <li><strong>created at: </strong> {{ post.created_at }}</li>
            <li><strong>updated at: </strong> {{ post.updated_at }}</li>
            <li>
                <strong>autor: </strong>
                <a :href="`/admin/users/${post.user_id}`">
                    {{ post.user.name }}</a
                >
            </li>
        </ul>
        <single-edit-links :id="post.id" resource="post" />
    </div>
</template>

<script>
import SingleEditLinks from "../../components/SingleEditLinks";
export default {
    components: {
        SingleEditLinks
    },
    data() {
        return {
            post: {
                user: {}
            }
        };
    },
    created() {
        axios
            .get("/api/posts/" + this.$route.params.id)
            .then(response => {
                this.post = response.data;
            })
            .catch(error => {
                return this.$router.push("admin/NotFound");
            });
    }
};
</script>

<style lang="scss" scoped></style>
