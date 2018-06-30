<template>
    <button type="submit" class="btn btn-danger btn-block" v-on:click="confirmDeletion">
        {{ title }}
    </button>
</template>

<script>
    export default {
        props: {
            title: String,
            message: String,
        },
        methods: {
            confirmDeletion: function (event) {
                event.preventDefault()
                const confirmDelete = confirm(this.message)
                if (confirmDelete === true)
                    document.getElementById('delete_form').submit()
            }
        }
    }
</script>
