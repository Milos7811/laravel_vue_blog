<script>
export default {
    data() {
        return {
            contentEditabled: false,
            newCommentText: "",
            oldText: ""
        };
    },

    props: ["comment-data"],
    mounted() {
        this.newCommentText = this.commentData.text;
        this.oldText = this.commentData.text;
    },

    methods: {
        backText() {
            this.$refs.textArea.innerText = this.oldText;
            this.contentEditabled = false;
        },
        editMessage() {
            this.contentEditabled = true;
            this.selectText();
        },
        textChange() {
            this.newCommentText = this.$refs.textArea.innerText;
        },
        deleteComment() {
            if (confirm("Naozaj chcete vymazat komentar")) {
                axios.delete("/comments/" + this.commentData.id);
                this.$el.remove();
            }
            this.$root.$emit("flash", "Comment deleted! ");
        },
        editComment() {
            axios.patch("/comments/" + this.commentData.id, {
                text: this.newCommentText
            });
            this.$root.$emit("flash", "Your comment edit is successful ! ");
            this.contentEditabled = false;
            this.oldText = this.newCommentText;
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

<style lang="scss" scoped></style>
