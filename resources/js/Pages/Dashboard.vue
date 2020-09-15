<template>
    <app-layout>
        <div class="py-12" v-if="showWelcome">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome @add-feed="showAddFeed" @import-opml="importOPML" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Feedle/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
        data: () => ({
            loading: false,
            subscriptions: [],
            subscriptionPage: null,
            subscriptionCount: null,
            posts: [],
            postPage: null,
            postCount: null,
        }),
        computed: {
            showWelcome() {
                return this.loading == false && this.subscriptions.length == 0;
            },
        },
        methods: {
            async loadData() {
                this.loading = true;
                {
                    const { data } = await axios.get('/api/subscriptions');
                    this.subscriptions = data.data;
                    this.subscriptionPage = data.current_page + 1;
                    this.subscriptionCount = data.total;
                }
                {
                    const { data } = await axios.get('/api/posts');
                    this.posts = data.data;
                    this.postPage = data.current_page + 1;
                    this.postCount = data.total;
                }
                this.loading = false;
            },
            showAddFeed() {
                // TODO: show modal to add a feed
            },
            importOPML() {
                // TODO: start OPML import
            },
            addFeed() {
                // TODO: subscribe to a feed and add it to the view model
            },
        },
        mounted() {
            this.loadData();
        },
    }
</script>
