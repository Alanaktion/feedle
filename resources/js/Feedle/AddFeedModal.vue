<template>
    <jet-modal :show="show" @close="$emit('close')" :max-width="maxWidth">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-lg">Add Feed</div>
                <button type="button" aria-label="Close" title="Close" class="p-1"
                    @click="addModalVisible = false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-gray-600 hover:text-gray-800 focus:text-gray-800" aria-hidden="true">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="mt-4 pb-2">
                Enter a website or feed URL to begin.

                <div class="flex mt-4">
                    <jet-input type="text" class="block flex-1" placeholder="Feed/Website URL"
                        ref="searchUrl"
                        v-model="searchUrl"
                        @keyup.enter.native="searchFeeds" />

                    <!-- <jet-input-error :message="errors.searchUrl" class="mt-2" /> -->

                    <jet-button class="ml-2 whitespace-no-wrap" @click.native="searchFeeds" :class="{ 'opacity-25': searchLoading }" :disabled="searchLoading">
                        Search Feeds
                    </jet-button>
                </div>

                <div class="pt-2" v-if="searchResults.length">
                    <div class="flex items-center justify-between pt-4"
                        v-for="result in searchResults"
                        :key="result.url">
                        <div>
                            <div class="text-lg font-semibold">
                                {{ result.title }}
                            </div>
                            <div class="text-xs text-gray-600">
                                {{ result.url }}
                            </div>
                        </div>
                        <jet-secondary-button @click.native="addFeed(result.url)">
                            Subscribe
                        </jet-secondary-button>
                    </div>
                </div>
                <div class="pt-10 pb-4 text-gray-700 text-center" v-else-if="searchComplete">
                    No search results for this URL.
                </div>
            </div>
        </div>
    </jet-modal>
</template>

<script>
import JetButton from './../Jetstream/Button';
import JetSecondaryButton from './../Jetstream/SecondaryButton';
import JetModal from './../Jetstream/Modal';
import JetInput from './../Jetstream/Input';
// import JetInputError from './../Jetstream/InputError';

export default {
    components: {
        JetButton,
        JetSecondaryButton,
        JetModal,
        JetInput,
        // JetInputError,
    },
    props: {
        show: {
            default: false,
        },
        maxWidth: {
            default: '2xl',
        },
    },
    data: () => ({
        view: 'posts',
        loading: true,
        hasSubscriptions: false,
        addModalVisible: false,
        searchUrl: '',
        errors: {
            searchUrl: null,
        },
        searchLoading: false,
        searchComplete: false,
        searchResults: [],
    }),
    watch: {
        show(newVal) {
            if (newVal) {
                this.$nextTick(() => {
                    this.$refs.searchUrl.focus();
                });
            } else {
                setTimeout(() => {
                    this.searchResults = [];
                    this.searchComplete = false;
                }, 300);
            }
        },
    },
    methods: {
        searchFeeds() {
            this.searchLoading = true;
            axios.get('/api/feeds/search', {
                params: {
                    url: this.searchUrl,
                },
            }).then(response => {
                this.searchResults = response.data;
                this.searchLoading = false;
                this.searchComplete = true;
            });
        },
        addFeed(url) {
            axios.post('/api/subscriptions', {
                url,
            }).then(response => {
                this.$emit('close');
                // TODO: reload feed/post list
            });
        },
    },
};
</script>
