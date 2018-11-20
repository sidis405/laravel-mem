<template>
    <ul>
        <li v-for="category in categories">
            <a :href="category.link">{{ category.name }} ({{ category.posts_count }})</a>
        </li>
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                categories: null
            }
        },

        mounted() {
            axios.get('/categories').then((response) => {
                this.categories = response.data
            });
        }
    }
</script>
