<template>
    <div class="p-2">
        <a class="block p-2 rounded select-none"
            :class="{
                'bg-indigo-500': post.id === selected,
            }"
            :href="post.url"
            v-for="post in posts"
            :key="post.id"
            @click.exact.prevent="selected = post.id">
            <div
                :class="{
                    'text-gray-900': post.id !== selected,
                    'text-white': post.id === selected,
                }">
                {{ post.title }}
            </div>
            <div class="text-xs"
                :class="{
                    'text-gray-600': post.id !== selected,
                    'text-indigo-200': post.id === selected,
                }">
                {{ post.feed.title }}
                &middot;
                {{ dateFormat(post.created_at) }}
            </div>
        </a>
    </div>
</template>

<script>
export default {
    data: () => ({
        loading: false,
        posts: [],
        selected: null,
    }),
    methods: {
        dateFormat(date) {
            return (new Date(date)).toLocaleString();
        },
    },
    watch: {
        selected(newVal) {
            const post = _.find(this.posts, p => p.id === newVal);
            this.$emit('select', post);
            if (!post.is_read) {
                axios.post(`/api/posts/${post.id}`, {
                    is_read: 1,
                });
            }
        },
    },
    mounted() {
        // TODO: handle pagination
        axios.get('/api/posts').then(({ data }) => {
            this.posts = data.data;
        });
    },
};
</script>
