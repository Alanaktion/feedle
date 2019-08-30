<template>
    <div class="list-group pb-3">
        <div class="text-gray-600 text-center" v-if="!subscriptions.length">
            <p>You are not subscribed to any feeds yet.</p>
        </div>

        <div class="feed"
            v-for="subscription in subscriptions" :key="subscription.id">
            <div :title="subscription.feed.url">
                {{ subscription.feed.name }}
            </div>
            <div class="feed-meta" :title="subscription.created_at">
                Subscribed {{ dateDisplay(subscription.created_at) }}
            </div>
        </div>
    </div>
</template>

<script>
import { parse, distanceInWordsToNow } from 'date-fns';

export default {
    data() {
        return {
            subscriptions: [],
        };
    },
    methods: {
        async loadSubscriptions() {
            const response = await axios.get('/api/subscriptions');
            this.subscriptions = response.data.data;
        },
        dateDisplay(date) {
            return distanceInWordsToNow(parse(date)) + ' ago';
        },
    },
    mounted() {
        this.loadSubscriptions();
    }
}
</script>
