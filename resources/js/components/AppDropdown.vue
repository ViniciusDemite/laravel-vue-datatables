<template>
  <div class="dropdown ml-4">
        <button
            class="btn btn-secondary dropdown-toggle"
            :data-toggle="toggle"
            :id="id"
            :aria-haspopup="haspopup"
            :aria-expanded="expanded"
        >
           {{ buttonLabel }}
           <span v-if="length">({{ length }})</span>
        </button>
        <div class="dropdown-menu" :aria-labelledby="labelledby">
            <a
                href="#"
                class="dropdown-item"
                type="button"
                onclick="confirm('Are you sure you wanna to delete the selected students?') || event.stopImmediatePropagation()"
                @click.prevent="deleteAction"
            >
                Delete
            </a>
            <a
                :href="url"
                class="dropdown-item"
                type="button"
            >
                Export
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AppDropdown',

    props: {
        toggle: {
            type: String,
            required: true
        },
        id: {
            type: String,
            required: true
        },
        haspopup: {
            type: Boolean,
            require: true
        },
        expanded: {
            type: Boolean,
            required: true
        },
        labelledby: {
            type: String,
            required: true
        },
        length: {
            type: Number
        },
        buttonLabel: {
            type: String,
            required: true,

        },
        url: {
            type: String,
            required: true
        },
    },

    methods: {
        deleteAction(value) {
            this.$emit('deleteAction')
        }
    },
}
</script>