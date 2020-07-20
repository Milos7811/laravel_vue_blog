import moment from "moment";
export default {
    data() {
        return {
            data: [],
            search: "",
        };
    },
    computed: {
        filteredItems() {
            return this.data.filter((item) => {
                return item[this.searchColumn]
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
    },
    methods: {
        formatedDate(date) {
            return moment(date).subtract(10, "days").calendar();
        },
        shorten(text, len = 50) {
            return _.truncate(text, { length: len });
        },
    },
    mounted() {
        this.$root.$on("searchQueryValue", (data) => (this.search = data));
    },
};
