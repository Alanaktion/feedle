<template>
    <div class="list-group pb-3">
        <div class="text-center" v-if="!posts.length">
            <svg class="octicon inline-block w-6 text-gray-500" viewBox="0 0 12 16" version="1.1" aria-hidden="true">
                <path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"></path>
            </svg>
            <p class="text-gray-700">No unread posts.</p>
        </div>

        <a :href="post.url" class="post" target="reader"
            v-for="post in posts" :key="post.id">
            {{ post.feed.name }}<br>
            <span class="post-title">{{ post.title }}</span><br>
            <span class="post-date">{{ post.created_at }}</span>
        </a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
        }
    },
    mounted() {
        // TODO: load posts
    }
}
</script>
