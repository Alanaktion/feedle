<template>
    <app-layout>
        <div class="flex flex-grow">
            <div class="flex flex-col items-stretch bg-white border-r border-gray-300" style="width: 24rem; height: calc(100vh - 4rem);">
                <div class="flex justify-between items-center p-4 border-b border-gray-200">
                    <div class="flex">
                        <button type="button" class="px-4 py-1 rounded font-medium"
                            :class="{
                                'shadow text-indigo-500 hover:text-indigo-600': view === 'posts',
                                'hover:bg-gray-100 text-gray-700': view !== 'posts',
                            }"
                            @click="view = 'posts'">
                            Posts
                        </button>
                        <button type="button" class="ml-1 px-4 py-1 rounded font-medium"
                            :class="{
                                'shadow text-indigo-500 hover:text-indigo-600': view === 'feeds',
                                'hover:bg-gray-100 text-gray-700': view !== 'feeds',
                            }"
                            @click="view = 'feeds'">
                            Feeds
                        </button>
                    </div>
                    <jet-secondary-button aria-label="Add Feed" data-tooltip="Add Feed" @click.native="addModalVisible = true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-5 w-5 -mx-2">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </jet-secondary-button>
                </div>
                <div class="flex-grow overflow-auto pt-4 bg-gray-50">
                    <!-- TODO: show posts/feeds here -->
                </div>
            </div>
            <!-- TODO: set z-index of this to -1 when menus are open (fixes click to dismiss): -->
            <div class="flex-1 relative" ref="content">
                <div class="py-12" v-if="showWelcome">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <Welcome @add-feed="addModalVisible = true" @import-opml="importOPML" />
                        </div>
                    </div>
                </div>
                <iframe src="about:blank" frameborder="0" class="absolute inset-0"
                    ref="content-frame"
                    v-else
                ></iframe>
            </div>
        </div>

        <add-feed-modal :show="addModalVisible" @close="addModalVisible = false" max-width="xl" />
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Feedle/Welcome'
    import JetSecondaryButton from './../Jetstream/SecondaryButton'
    import AddFeedModal from './../Feedle/AddFeedModal'

    export default {
        components: {
            AppLayout,
            Welcome,
            JetSecondaryButton,
            AddFeedModal,
        },
        data: () => ({
            view: 'posts',
            loading: true,
            hasSubscriptions: false,
            addModalVisible: false,
        }),
        computed: {
            showWelcome() {
                return !this.loading && !this.hasSubscriptions;
            },
        },
        methods: {
            importOPML() {
                // TODO: start OPML import
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
