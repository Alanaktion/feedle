<template>
    <div class="list-group pb-3">
        <div class="text-center" v-if="!posts.length">
            <svg class="octicon inline-block w-6 text-gray-500" viewBox="0 0 12 16" version="1.1" aria-hidden="true">
                <path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"></path>
            </svg>
            <p class="text-gray-700">No unread posts.</p>
        </div>

        <a :href="post.url" class="post" target="reader"
            :class="{
                'is-read': post.is_read,
                'active': activePost && activePost.id == post.id
            }"
            v-for="post in posts" :key="post.id"
            @click="selectPost(post)">
            <div class="post-title">
                {{ post.title }}
            </div>
            <div class="post-meta">
                {{ post.feed.name }} &middot;
                <span :title="post.created_at">
                    {{ dateDisplay(post.created_at) }}
                </span>
            </div>
        </a>
    </div>
</template>

<script>
import { parse, distanceInWordsToNow } from 'date-fns';

export default {
    data() {
        return {
            posts: [],
            activePost: null,
        };
    },
    methods: {
        async loadPosts() {
            const response = await axios.get('/api/posts');
            this.posts = response.data.data;
        },
        async selectPost(post) {
            this.$emit('select', post);
            this.activePost = post;
            await axios.post(`/api/posts/${post.id}`, { is_read: true });
            post.is_read = true;
        },
        dateDisplay(date) {
            return distanceInWordsToNow(parse(date)) + ' ago';
        },
    },
    mounted() {
        this.loadPosts();
    }
}
</script>
