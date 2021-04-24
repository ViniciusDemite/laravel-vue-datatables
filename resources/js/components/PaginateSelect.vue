<template>
    <div class="d-flex align-items-center ml-4">
        <label for="paginate" class="text-nowrap mr-2 mb-0">{{ label }}</label>
        <select
            class="form-control form-control-sm"
            @input="selectPaginate($event.target.value)"
        >
            <slot></slot>
        </select>
    </div>
</template>

<script>
export default {
    name: 'Paginate',

    props: {
        label: {
            type: String,
            required: true
        }
    },

    methods: {
        selectPaginate(value) {
            this.$emit('input', value)
        }
    }
}
</script>