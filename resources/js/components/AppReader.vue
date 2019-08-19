<template>
    <div class="reader">
        <div class="reader-list">
            <div class="flex justify-between p-3">
                <div class="btn-group">
                    <button type="button" class="btn"
                        :class="{
                            'btn-primary': tab == 'posts',
                            'btn-secondary': tab != 'posts',
                        }" @click="tab = 'posts'">
                        Posts
                    </button>
                    <button type="button" class="btn"
                        :class="{
                            'btn-primary': tab == 'feeds',
                            'btn-secondary': tab != 'feeds',
                        }" @click="tab = 'feeds'">
                        Feeds
                    </button>
                </div>
                <button type="button" class="btn btn-secondary" title="Add Feed">
                    <svg class="octicon octicon-plus" viewBox="0 0 12 16" version="1.1" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 9H7v5H5V9H0V7h5V2h2v5h5z"></path>
                    </svg>
                </button>
            </div>
            <div class="tab-content">
                <tab-posts v-if="tab == 'posts'" />
                <tab-feeds v-if="tab == 'feeds'" />
            </div>
        </div>
        <div class="reader-content">
            <p class="text-gray-600 text-center mt-5" v-if="!article">
                Select a post on the left to start reading.
            </p>
            <iframe src="about:blank" frameborder="0" class="reader-iframe d-none" name="reader" ref="reader"></iframe>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: 'posts',
            article: null,
        }
    },
    methods: {
        //
    },
    mounted() {
        //
    }
}
</script>
