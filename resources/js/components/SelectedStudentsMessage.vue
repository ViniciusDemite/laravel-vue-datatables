<template>
    <div class="col-md-10 mb-2">
        <div v-if="validation">
            You are currently selecting all
            <strong>{{ length }}</strong> items.
        </div>
        <div v-else>
            You have selected <strong>{{ length }}</strong> items,
            Do you want to Select All
            <strong>{{ total }}</strong
            >?
            <a 
                href="#"
                class="ml-2"
                @click.prevent="selectAll"
            >
                Select All
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SelectedStudentsMessage',

    props: {
        validation: {
            type: Boolean,
            required: true
        },
        length: {
            type: Number,
            required: true
        },
        total: {
            type: Number,
            required: true
        }
    },

    methods: {
        selectAll() {
            this.$emit('selectedAll')
        }
    }
}
</script>