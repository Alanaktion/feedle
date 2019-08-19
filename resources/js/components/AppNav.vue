<template>
    <nav class="navbar">
        <a href="/" class="navbar-brand">
            {{ appName }}
        </a>
        <div class="navbar-nav">
            <span class="navbar-link">{{ userName }}</span>
            <button @click="logout" type="button" class="navbar-link">Log out</button>
        </div>
    </nav>
</template>

<script>
export default {
    props: {
        appName: String,
        userName: String,
    },
    methods: {
        async logout() {
            await axios.post('/logout');
            self.location = '/';
        },
    }
}
</script>
