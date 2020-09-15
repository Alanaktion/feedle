<template>
    <jet-action-section>
        <template #title>
            Export OPML
        </template>

        <template #description>
            Export your feed list as an OPML file.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                If you'd like to move to another feed reader, or just keep a backup of your feed data, you can export your feed list as an OPML file.
            </div>

            <div class="flex items-center mt-5">
                <jet-button @click="exportFeeds">
                    Export OPML
                </jet-button>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionMessage from './../Jetstream/ActionMessage'
    import JetActionSection from './../Jetstream/ActionSection'
    import JetButton from './../Jetstream/Button'

    export default {
        components: {
            JetActionMessage,
            JetActionSection,
            JetButton,
        },

        data() {
            return {
                //
            };
        },

        methods: {
            exportFeeds() {
                alert('Exporting OPML files is not yet supported.');
            },
        },
    }
</script>
