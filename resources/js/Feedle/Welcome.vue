<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl lg:text-3xl">
                Welcome
            </div>
            <div class="mb-6 text-gray-600 text-sm lg:text-base">
                Let's get started by adding a few feeds.
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" />
                    </svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Add your first feed</div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 mb-4 text-sm text-gray-500">
                        Get started following blogs, webcomics, and news by subscribing to an RSS or Atom feed.
                    </div>

                    <Button @click="$emit('add-feed')">
                        Add a Feed
                    </Button>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Import OPML</div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 mb-4 text-sm text-gray-500">
                        If you're coming from another feed aggregator, you can migrate easily by selecting an OPML export from your old aggregator.
                    </div>

                    <SecondaryButton @click="$emit('import-opml')">
                        Import OPML
                    </SecondaryButton>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Button from './../Jetstream/Button'
    import SecondaryButton from './../Jetstream/SecondaryButton'

    export default {
        components: {
            Button,
            SecondaryButton,
        },
    }
</script>
