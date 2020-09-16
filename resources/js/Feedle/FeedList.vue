<template>
    <div class="p-2">
        <div class="p-2 rounded"
            :class="{
                'bg-indigo-500': sub.id === selected,
            }"
            v-for="sub in subscriptions"
            :key="sub.id"
            @click="selected = sub.id">
            <div
                :class="{
                    'text-gray-900': sub.id !== selected,
                    'text-white': sub.id === selected,
                }">
                {{ sub.feed.title }}
            </div>
            <div class="text-xs"
                :class="{
                    'text-gray-600': sub.id !== selected,
                    'text-indigo-200': sub.id === selected,
                }">
                Subscribed {{ dateFormat(sub.created_at) }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        loading: false,
        subscriptions: [],
        selected: null,
    }),
    methods: {
        dateFormat(date) {
            return (new Date(date)).toLocaleString();
        },
    },
    watch: {
        selected(newVal) {
            const subscription = _.find(this.subscriptions, p => p.id === newVal);
            this.$emit('select', subscription);
        },
    },
    mounted() {
        // TODO: handle pagination
        axios.get('/api/subscriptions').then(({ data }) => {
            this.subscriptions = data.data;
        });
    },
};
</script>
