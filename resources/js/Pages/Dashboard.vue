<template>
    <app-layout>
        <div class="flex flex-grow">
            <div class="flex flex-col items-stretch bg-white shadow" style="width: 24rem; height: calc(100vh - 4rem);">
                <div class="flex justify-between items-center p-4">
                    <div class="flex gap-1">
                        <button type="button" class="px-4 py-1 rounded font-medium shadow text-indigo-500 hover:text-indigo-600">
                            Posts
                        </button>
                        <button type="button" class="px-4 py-1 rounded font-medium hover:bg-gray-100 text-gray-700">
                            Feeds
                        </button>
                    </div>
                    <SecondaryButton aria-label="Add Feed" data-tooltip="Add Feed">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-5 w-5 -mx-2">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </SecondaryButton>
                </div>
                <div class="flex-grow overflow-auto">
                    <!-- TODO: show posts/feeds here -->
                </div>
            </div>
            <div class="flex-1">
                <div class="py-12" v-if="showWelcome">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <Welcome @add-feed="showAddFeed" @import-opml="importOPML" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Feedle/Welcome'
    import SecondaryButton from './../Jetstream/SecondaryButton'

    export default {
        components: {
            AppLayout,
            Welcome,
            SecondaryButton,
        },
        data: () => ({
            loading: true,
            hasSubscriptions: false,
        }),
        computed: {
            showWelcome() {
                return !this.loading && !this.hasSubscriptions;
            },
        },
        methods: {
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
            axios.get('/api/user').then(({ data }) => {
                this.hasSubscriptions = data.subscriptions_count > 0;
                this.loading = false;
            });
        },
    }
</script>
