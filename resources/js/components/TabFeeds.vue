<template>
    <div class="list-group pb-3">
        <div class="text-gray-600 text-center" v-if="!feeds.length">
            <p>You are not subscribed to any feeds yet.</p>
        </div>

        <div class="feed"
            v-for="feed in feeds" :key="feed.id">
            {{ feed.feed.name }}<br>
            <span class="feed-title">{{ feed.title }}</span><br>
            <span class="feed-date">{{ feed.created_at }}</span>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            feeds: [],
        }
    },
    mounted() {
        // TODO: load feeds
    }
}
</script>
