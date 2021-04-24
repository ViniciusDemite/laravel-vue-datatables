<template>
    <input
        @change="searchStudents($event.target.value)"
        type="search"
        class="form-control"
        :placeholder="placeholder"
    />
</template>

<script>
export default {
    name: 'SearchField',
    
    props: {
        placeholder: {
            type: String
        }
    },

    methods: {
        searchStudents(value) {
            this.$emit('input', value)
        }
    }
}
</script>