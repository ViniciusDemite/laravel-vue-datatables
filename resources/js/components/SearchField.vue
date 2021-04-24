<template>
    <input
        @change="searchStudents($event.target.value)"
        type="search"
        class="form-control"
        placeholder="Search by name,email,phone,or address..."
    />
</template>

<script>
export default {
    name: 'SearchField',
    
    methods: {
        searchStudents(value) {
            this.$emit('input', value)
        }
    }
}
</script>