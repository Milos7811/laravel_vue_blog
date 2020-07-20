import Router from "vue-router";
import "../bootstrap";

import Dashboard from "./views/Dashboard.vue";
import NotFound from "./views/NotFound";

// Posts
import Post from "./views/posts/Post.vue";
import PostSingle from "./views/posts/PostSingle.vue";
import PostEdit from "./views/posts/PostEdit.vue";
import PostCreate from "./views/posts/PostCreate.vue";

// Comments
import Comment from "./views/comments/Comment.vue";
import CommentSingle from "./views/comments/CommentSingle.vue";
import CommentEdit from "./views/comments/CommentEdit.vue";

// Users
import User from "./views/users/User.vue";
import UserSingle from "./views/users/UserSingle.vue";
import UserEdit from "./views/users/UserEdit.vue";

import Tags from "./views/Tags/Tags.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {
            path: "/admin/",
            component: Dashboard
        },
        {
            path: "/"
        },

        // Posts
        {
            path: "/admin/posts",
            component: Post
        },
        {
            path: "/admin/posts/createpost",
            component: PostCreate
        },
        {
            path: "/admin/posts/:id",
            component: PostSingle
        },
        {
            path: "/admin/posts/:id/edit",
            component: PostEdit
        },

        // Comments
        {
            path: "/admin/comments/",
            component: Comment
        },
        {
            path: "/admin/comments/:id",
            component: CommentSingle
        },
        {
            path: "/admin/comments/:id/edit",
            component: CommentEdit
        },

        // Users
        {
            path: "/admin/users/",
            component: User
        },
        {
            path: "/admin/users/:id",
            component: UserSingle
        },
        {
            path: "/admin/users/:id/edit",
            component: UserEdit
        },

        //Tags
        {
            path: "/admin/tags",
            component: Tags
        },

        // 404
        {
            path: "/admin/404",
            component: NotFound
        },
        {
            path: "*",
            redirect: "admin/404"
        }
    ]
});
