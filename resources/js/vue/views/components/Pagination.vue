<template>
    <ul class="pagination m-2">
        <li class="page-item" :class="{ 'disabled': !links.prev }">
            <a class="page-link" href="#" @click.prevent="changePage(links.prev)" tabindex="-1"
                aria-disabled="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M15 6l-6 6l6 6"></path>
                </svg>
            </a>
        </li>
        <li v-for="link in getLinks" :key="link.page" class="page-item"
            :class="{ 'active': link.active, 'disabled': !link.url }">
            <a class="page-link" href="#" @click="changePage(link.url)">{{ link.label }}</a>
        </li>
        <li class="page-item" :class="{ 'disabled': !links.next }">
            <a class="page-link" href="#" @click.prevent="changePage(links.next)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 6l6 6l-6 6"></path>
                </svg>
            </a>
        </li>
    </ul>
</template>

<script>
export default {
    name: "Pagination",
    data() {
        return {
        }
    },
    props: {
        meta: {
            type: Object,
            required: true
        },
        links: {
            type: Object,
            required: true
        }
    },
    methods: {
        changePage(page) {
            if (this.meta.current_page >= 1 && this.meta.current_page <= this.meta.last_page) {
                this.$emit('fetchFromUrl', page);
            }
        },
        
    },
    computed: {
        getLinks() {
            if (this.meta.links && this.meta.links.length > 2) {
                return this.meta.links.slice(1, this.meta.links.length - 1);
            }
        }
    }
}
</script>