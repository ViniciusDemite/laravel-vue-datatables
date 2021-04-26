<template>
  <div class="d-flex align-items-center ml-4">
        <label for="paginate" class="text-nowrap mr-2 mb-0">{{ label }}</label>
        <select
            @input="handleInput($event.target.value)"
            class="form-control form-control-sm"
        >
            <slot></slot>
        </select>
    </div>
</template>

<script>
export default {
    name: 'AppSelect',

    props: {
        label: {
            type: String,
            required: true
        }
    },

    methods: {
        handleInput(value) {
            this.$emit('input', value)
        }
    }
}
</script>