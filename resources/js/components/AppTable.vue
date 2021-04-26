<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <slot name="head"></slot>
            </tr>
        </thead>
        <tbody>
            <slot name="body"></slot>
        </tbody>
        <tfoot>
            <slot name="foot"></slot>
        </tfoot>
    </table>
</template>

<script>
export default {
    name: 'AppTable',
}
</script>