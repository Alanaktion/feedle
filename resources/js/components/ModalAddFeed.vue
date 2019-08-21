<template>
    <div @keyup.esc="close">
        <div class="modal">
            <div class="modal-content">
                <div class="flex justify-between mb-3">
                    <div class="text-lg">Add Feed</div>
                    <button class="bg-transparent border-0 px-2 text-lg text-gray-600 hover:text-gray-900"
                        type="button" aria-label="Close" @click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="flex" @submit.prevent="search">
                    <input type="search" class="input" placeholder="Feed URL"
                        ref="input" v-model="url">
                    <button type="submit" class="btn btn-primary hidden sm:block sm:ml-2"
                        :class="{ 'is-loading': searching }"
                        aria-label="Search" required>
                        <svg class="octicon octicon-search" viewBox="0 0 16 16" version="1.1" aria-hidden="true">
                            <path fill-rule="evenodd" d="M15.7 13.3l-3.81-3.83A5.93 5.93 0 0 0 13 6c0-3.31-2.69-6-6-6S1 2.69 1 6s2.69 6 6 6c1.3 0 2.48-.41 3.47-1.11l3.83 3.81c.19.2.45.3.7.3.25 0 .52-.09.7-.3a.996.996 0 0 0 0-1.41v.01zM7 10.7c-2.59 0-4.7-2.11-4.7-4.7 0-2.59 2.11-4.7 4.7-4.7 2.59 0 4.7 2.11 4.7 4.7 0 2.59-2.11 4.7-4.7 4.7z"></path>
                        </svg>
                    </button>
                </form>
                <template v-if="results !== null">
                    <div class="flex justify-between mt-3"
                        v-for="feed in results" :key="feed.url">
                        <div>
                            <div class="font-bold mb-1">{{ feed.title }}</div>
                            <div class="text-xs">{{ feed.url }}</div>
                        </div>
                        <button class="btn btn-secondary btn-sm"
                            :class="{ 'is-loading': feed.adding }"
                            @click="add(feed)">
                            Add Feed
                        </button>
                    </div>
                    <p class="lead text-center" v-if="!results.length">
                        No feeds were found at this URL.
                    </p>
                </template>
            </div>
        </div>
        <div class="modal-backdrop" @click="close"></div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: '',
            searching: false,
            results: null,
        }
    },
    methods: {
        async search() {
            if (this.url) {
                this.searching = true
                const param = encodeURIComponent(this.url)
                const response = await axios.get('/api/feeds/search?url=' + param)
                this.results = response.data
                this.searching = false
            }
        },
        async add(feed) {
            feed.adding = true
            await axios.post('/api/subscriptions', {
                url: feed.url,
            })
            this.$emit('add-feed', feed)
            this.close()
        },
        close() {
            this.$destroy();
            this.$el.parentNode.removeChild(this.$el);
        },
    },
    mounted() {
        this.$nextTick(() => {
            this.$refs.input.focus()
        })
    }
}
</script>
